<?php

namespace App\Controller;
use App\Entity\Visiteur;
use App\Form\VisiteurType;
use App\Entity\FicheFrais;
use App\Form\FicheFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class VisiteurController extends AbstractController
{
    /**
     * @Route("/visiteur", name="visiteur")
     */
    public function index()
    {
        return $this->render('visiteur/index.html.twig', [
            'controller_name' => 'VisiteurController',
        ]);
    }
    
    /**
     * @Route("/loginVisiteur", name="visiteur_connect")
     */
    
    public function connectionViisiteur(Request $query, Session $session)
    {
        $visiteur = new Visiteur;
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($query);
    if ($form->isSubmitted() && $form->isValid()) {
       
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();      
           
            $login = $form['login']->getData();
            $password = $form['mdp']->getData();
           
            $v = $em->getRepository(Visiteur::class)->seConnecter($login,$password); //on envoie les données reçus pour tester

            foreach ($v as $result){
            if($v[0]->getLogin()==$login){ 
            
               
               $session ->set('nom', $v[0]->getNom());
               $session ->set('prenom', $v[0]->getPrenom());
               $login = $session->set('login', $login);
                
               return $this->redirectToRoute('session_v');            
            }    
            }
    
    }
    return $this->render('visiteur/loginVisiteur.html.twig',array('form'=>$form->createView()));
}
   /** 
     * @Route("/loginV", name="session_v")
     */
    
    public function testerSessionVisiteur(){
        return $this->render('visiteur/menuVisiteur.html.twig');
    }
      


    
    /**
     * @Route("/saisirFF", name="add_fichefrais")
    */ 
    
    public function SaisirFicheFrais(Request $query, Session $session) {
        //$fichefrais = new FicheFrais();
        //$form = $this->createForm(FicheFraisType::class, $fichefrais);
        //$form->handleRequest($query);
       $em = $this->getDoctrine()->getManager();
       $ficheFrais = $em->getRepository(FicheFrais::class)->findAll();
        
        /*if ($form->isSubmitted() && $form->isValid()) {
           
           $em->persist($fichefrais);
           $em->flush();  
           
        
          $query->getSession()
              ->getFlashBag()
              ->add('success','fiche saisir');
        }*/
        
        
        
        
        return $this->render('visiteur/saisirFF.html.twig', array('fichefrais' => $ficheFrais));
}}


/**
     * @Route("/CalsaisirFF", name="add_ffMontant")
    */ 