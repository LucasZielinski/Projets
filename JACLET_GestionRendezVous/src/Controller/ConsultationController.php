<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Consultation;
use App\Form\ConsultationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ConsultationController extends AbstractController
{
    /**
     * @Route("/consultations/{ladate}", name="consultations")
     */
    public function consultations($ladate): Response
    {
		$leMedecin = $this->get('security.token_storage')->getToken()->getUser();
		$repository=$this->getDoctrine()->getRepository(Consultation::class);
		$lesConsultations=$repository->findAll();
		$consultations = $repository->rdvMedecin($ladate,$leMedecin)/*array()*/;
		$lesDates = array();
		/*foreach($lesConsultations as $laConsultation){
			if(!in_array($laConsultation->getDateHeure()->format('Y-m-d'),$lesDates)){
				array_push($lesDates, $laConsultation->getDateHeure()->format('Y-m-d'));
			}
			if($laConsultation->getDateHeure()->format('Y-m-d')==($ladate)){
				array_push($consultations,$laConsultation);
			}
		}*/
        return $this->render('consultation/consultations.html.twig', [
            'consultations' => $consultations,
			'lesDates' => $lesDates,
        ]);
    }
	
	/**
     * @Route("/creerConsultation", name="creerConsultation")
     */
    public function creerConsultation(Request $request): Response
    {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$em=$this->getDoctrine()->getRepository(Consultation::class);
		$consultation = new Consultation();
		$form= $this->createForm(ConsultationType::class,$consultation);
		$consultation->setEtat('En cours');
		$consultation->setPatient($user);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$consultation=$form->getData();
			$em=$this->getDoctrine()->getManager();
			$em->persist($consultation);
			$em->flush();
			return $this->redirectToRoute('consultations');
		}
		return $this->render('consultation/creerConsultation.html.twig',array(
			'form'=>$form->createView(),));
    }
	
	/**
     * @Route("/modifConsultation/{id}", name="modifConsultation")
     */
	 public function modifConsultation($id, Request $request){
		$em=$this->getDoctrine()->getManager();
		$repository=$this->getDoctrine()->getRepository(Consultation::class);
		$consultation=$repository->find($id);
		$form=$this->createForm(ConsultationType::class,$consultation)
				   ->add('etat',ChoiceType::class, ['choices'  => [
					'En cours' => 'En cours',
					'Validee' => 'Validee',
					'Realisee' => 'Realisee',
					'Annulee' => 'Annulee',]]);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$consultation=$form->getData();
			$em=$this->getDoctrine()->getManager();
			$em->persist($consultation);
			$em->flush();
			return $this->redirectToRoute('consultations');
		}	
		return $this->render('consultation/modifConsultation.html.twig', array(
            'form' => $form->createView(),
        ));
	 }
	
	/**
     * @Route("/validation", name="validation")
     */
    public function validation(): Response
    {
		$repository=$this->getDoctrine()->getRepository(Consultation::class);
		$lesConsultations=$repository->findAll();
		
        return $this->render('consultation/validation.html.twig', [
            'consultations' => $lesConsultations,
        ]);
    }
	
	/**
     * @Route("/annulerConsultation/{id}", name="annulerConsultation")
     */
	 public function annulerConsultation($id){
		$em=$this->getDoctrine()->getManager();
		$repository=$this->getDoctrine()->getRepository(Consultation::class);
		$lesConsultations=$repository->findAll();
		$consultation=$repository->find($id);
		$consultation->setEtat('Annulee');
		$em->persist($consultation);
		$em->flush();
		return $this->render('consultation/validation.html.twig', [
            'consultations' => $lesConsultations,
        ]);
	 }
	 
	 /**
     * @Route("/validerConsultation/{id}", name="validerConsultation")
     */
	 public function validerConsultation($id){
		$em=$this->getDoctrine()->getManager();
		$repository=$this->getDoctrine()->getRepository(Consultation::class);
		$lesConsultations=$repository->findAll();
		$consultation=$repository->find($id);
		$consultation->setEtat('Validee');
		$em->persist($consultation);
		$em->flush();
		return $this->render('consultation/validation.html.twig', [
            'consultations' => $lesConsultations,
        ]);
	 }
	 
	 /**
     * @Route("/realiserConsultation/{id}", name="realiserConsultation")
     */
	 public function realiserConsultation($id){
		$em=$this->getDoctrine()->getManager();
		$repository=$this->getDoctrine()->getRepository(Consultation::class);
		$lesConsultations=$repository->findAll();
		$consultation=$repository->find($id);
		$consultation->setEtat('Realisee');
		$em->persist($consultation);
		$em->flush();
		return $this->render('consultation/validation.html.twig', [
            'consultations' => $lesConsultations,
        ]);
	 }
}
