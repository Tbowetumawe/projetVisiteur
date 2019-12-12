<?php

namespace App\Controller;

use App\Entity\FicheFrais;
use App\Entity\Visiteur;
use App\Entity\Etat;
use App\Form\EtatType;
use App\Form\FicheFraisType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class FichefraisController extends AbstractController
{
    /**
     * @Route("/fichefrais", name="fichefrais")
     */
    public function index()
    {
        return $this->render('fichefrais/index.html.twig', [
            'controller_name' => 'FichefraisController',
        ]);
    }
    
     /**
     * @Route("/adfiche", name="adfiche")
     */
    
    public function addFicheFrais(Request $request, Session $session) {
        
        $fichefrais = new FicheFrais();
        
        $form = $this->createForm(FicheFraisType::class, $fichefrais);
        
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            $id = $session->get('visiteur');
            $ff = $this->getDoctrine()->getManager()->getRepository(FicheFrais::class)->getByMois($fichefrais->getMois(), $id);
            if($ff == null){
                if($form->isValid()){
                    $em = $this->getDoctrine()->getManager();

                    $visiteur = $this->getDoctrine()->getManager()->getRepository(Visiteur::class)->getLeVisiteur($id);
                    $etat = $this->getDoctrine()->getManager()->getRepository(Etat::class)->getLetat($id);
                    $fichefrais->setVisiteur($visiteur);
                    $fichefrais->setEtat($etat);
                    $em->persist($fichefrais);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('notice', 'Visiteur bien enregistre.');
                    return $this->redirectToRoute('affichage');
                }
            }
        

        
    
    }
    return $this->render('fichefrais/saisir_fichefrais.html.twig', array('form' =>$form->createView()));
    }
                
    /**
        * @Route("/register", name="affichage")
     * 
     */
    public function register(){
        return $this->render('fichefrais/add.html.twig');
    }
   
    

    
    
    /**
        * @Route("/afficherFF", name="affi")
        
    public function AfficherFF(){
        $em = $this->getDoctrine()->getManager();
 
        $ficheFrais = $em->getRepository(Bien::class)->findAll();
        
        return $this->render('bien/afficherBien.html.twig', array('bien' => $Bien));
        
    }*/    

    }

