<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Indisponibilite;
use App\Form\IndisponibiliteType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Medecin;

class IndisponibiliteController extends AbstractController
{
    /**
     * @Route("/creerIndisponibilite", name="creerIndisponibilite")
     */
    public function creerIndisponibilite(Request $request): Response
    {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$em=$this->getDoctrine()->getRepository(Indisponibilite::class);
		$indisponibilite = new Indisponibilite();
		$form= $this->createForm(IndisponibiliteType::class,$indisponibilite);
		$indisponibilite->setMedecin($user);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$indisponibilite=$form->getData();
			$em=$this->getDoctrine()->getManager();
			$em->persist($indisponibilite);
			$em->flush();
			return $this->redirectToRoute('accueil');
		}
		return $this->render('indisponibilite/creerIndisponibilite.html.twig',array(
			'form'=>$form->createView(),));
    }
	
	/**
     * @Route("/indisponibilites", name="indisponibilites")
     */
    public function indisponibilites(): Response
    {
		$repository=$this->getDoctrine()->getRepository(Indisponibilite::class);
		$rep2=$this->getDoctrine()->getRepository(Medecin::class);
		$lesIndisponibilites=$repository->findAll();
		$lesMedecins=$rep2->findAll();
		$medecins=array();
		foreach($lesMedecins as $unMedecin){
			array_push($medecins, $unMedecin->getEmail());
		}	
		
        return $this->render('indisponibilite/indisponibilites.html.twig', [
            'indisponibilites' => $lesIndisponibilites,
			'medecins' => $medecins,
		]);
    }
	
	/**
     * @Route("/indisponibilites/{email}", name="desindisponibilites")
     */
    public function indisponibilite($email): Response
    {
		$repository=$this->getDoctrine()->getRepository(Indisponibilite::class);
		$lesIndisponibilites=$repository->findAll();
		
        return $this->render('indisponibilite/desindisponibilites.html.twig', [
            'indisponibilites' => $lesIndisponibilites,
			'email' => $email,
        ]);
    }
}
