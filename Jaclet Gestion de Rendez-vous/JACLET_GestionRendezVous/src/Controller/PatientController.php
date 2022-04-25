<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Patient;
use App\Entity\Consultation;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ConsultationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PatientController extends AbstractController
{
	
	/**
     * @Route("/patient", name="patient")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $id = $user->getInfo();        ;
        $repository=$this->getDoctrine()->getRepository(Patient::class);
        $lePatient=$repository->find($id); 
        return $this->render('patient/index.html.twig', ['patient' => $lePatient, 'id' => $id
        ]);
    }
	
    /**
     * @Route("/rendezvous/{id}", name="rendezvous")
     */
    public function rendezvous($id): Response
    {
        $repository=$this->getDoctrine()->getRepository(Consultation::class);
        $leRdv=$repository->find($id); 
        return $this->render('patient/rendezvous.html.twig', ['rendezvous' => $leRdv,]);
    }

    /**
     * @Route("/removeConsultation/{id}", name="removeConsultation")
     */
     public function removeConsultation($id, Request $request){
            
            $repository=$this->getDoctrine()->getRepository(Consultation::Class);
            $rdv=$repository->find($id);           
            $em=$this->getDoctrine()->getManager();         
            $em->remove($rdv);
            $em->flush();
            return $this->redirectToRoute('patient');
     }

     /**
     * @Route("/modifConsultation/{id}", name="modifConsultation")
     */
     public function modifConsultation($id, Request $request){
        $em=$this->getDoctrine()->getManager();
        $repository=$this->getDoctrine()->getRepository(Consultation::class);
        $consultation=$repository->find($id);
        $form=$this->createForm(ConsultationType::class,$consultation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $consultation=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($consultation);
            $em->flush();
            return $this->redirectToRoute('accueil');
        }   
        return $this->render('patient/modifConsultation.html.twig', array(
            'form' => $form->createView(),
        ));
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


	
}
