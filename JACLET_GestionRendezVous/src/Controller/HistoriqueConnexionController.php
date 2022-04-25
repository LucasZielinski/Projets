<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\HistoriqueConnexion;

class HistoriqueConnexionController extends AbstractController
{
    /**
     * @Route("/historiqueConnexion", name="historiqueConnexion")
     */
    public function historiqueConnexion(): Response
    {
		$ladate = date_create("now",new \DateTimeZone('Europe/Paris'));
        $user = $this->get('security.token_storage')->getToken()->getUser();
		$histo = new HistoriqueConnexion();
		$histo->setDateHeure($ladate);
		$histo->setUtilisateur($user);
		$em=$this->getDoctrine()->getManager();
		$em->persist($histo);
		$em->flush();
		return $this->redirectToRoute('accueil');
    }
}
