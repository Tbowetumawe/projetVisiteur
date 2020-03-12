<?php

namespace App\Controller;
use App\Entity\Comptable;
use App\Entity\FraisForfait;
use App\Entity\LigneFraisForfait;
use App\Entity\LigneFraisHorsForfait;
use App\Entity\Visiteur;
use App\Entity\FicheFrais;
use App\Form\FicheFraisType;
use App\Form\ComptableType;
use Par\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\Query\AST\Join;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class ComptableController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('comptable/accueil.html.twig');
    }
       
    /**
     * @Route("/comptableS", name="compta_session")
     */
public function creerFormConnexionAction(Request $query) {
        $comptable = new Comptable();
        $form = $this->createForm(ComptableType::class, $comptable);
        $form->handleRequest($query);
        
    if ($form->isSubmitted() && $form->isValid()) {
        
        $em = $this->getDoctrine()->getManager();
        $data = $form->getData();
        $login = $form['login']->getData();
        $password = $form['mdp']->getData();
        $compta = $em->getRepository(Comptable::class)->seConnecter($login,$password); //on envoie les données reçus pour tester
        $session = new Session();

        foreach ($compta as $result){
        if($compta[0]->getLogin()==$login){ 
           $session ->set('nom', $compta[0]->getNom());
           $session ->set('prenom', $compta[0]->getPrenom());
           $login = $session->set('login', $login);


            return $this->redirectToRoute('_session');            
        }  
        }        
    }
    return $this->render('comptable/Login.html.twig',array('form'=>$form->createView(),));
        
    } 
    
   /** 
     * @Route("/loginCompta", name="_session")
    */ 
    public function testerSession(){
        $session = new Session();
        return $this->render('comptable/ménu.html.twig');
    }
    
    /** 
     * @Route("/validerFF", name="Vff")
    */ 
    public function selectV(Request $query, Session $session){
        
        $em = $this->getDoctrine()->getManager();
        $visit = $em->getRepository(Visiteur::class)->findAll();
        $visiteur= new Visiteur();
        /*$listeVisiteurs=array();
        foreach ($listeVisiteurs as $unVisiteur){ 
            array_push($listeVisiteurs, $unVisiteur)  ; 
            return $this->redirectToRoute('VisiteurInfo'); 
        }*/
        $mois = null;
        if(date('j') > 15 ){
            $mois = date("m")-1; 
        }
        else{
            $mois = date('m');
        }
        $monthyear = array($mois,date('Y'));
        
        $visiteur = $session->set('visiteur', $visit);
       
        return $this->render('comptable/validerFF.html.twig', array('visiteur' => $visit, 'mois_annee' => $monthyear));        
    }
    
    
    /** 
     * @Route("/afficheInfo", name="VisiteurInfo")
    */ 
    
    public function Valider(Request $query, Session $session){
         
        $em = $this->getDoctrine()->getManager();

        $v = $em->getRepository(Visiteur::class)->findAll();

        $fichef = $em->getRepository(FicheFrais::class)->findAll();
        $fraisf = $em->getRepository(FraisForfait::class)->findAll();
     
        $idf = $fichef[0]->getId();
        //$idv = $v[0]->getId();
        $idff = $fraisf[0]->getId();
        
        $LigneFF = $em->getRepository(LigneFraisForfait::class)->getLff($idf, $idff);
        
        $lignefHf = $em->getRepository(LigneFraisHorsForfait::class)->findAll();
        
        return $this->render('fraisforfait/FFdeVisiteur.html.twig', array('fichef' => $fichef, 'ligneff' => $LigneFF, 'horsforfait' => $lignefHf, 'visiteur' => $v ));
        
    }
    
    
    
    /** 
     * @Route("/modif", name="modif")
    */ 
    public function horsfait(Request $query, Session $session){
        /*$hf = new LigneFraisHorsForfait();
        
        $form = $this->createForm(\App\Form\LignefraishorsforfaitType::class, $hf); 
        if ($form->isSubmitted() && $form->isValid()) {*/
        
            $em = $this->getDoctrine()->getManager();
            //$data = $form->getData();
        $lignefHf = $em->getRepository(LigneFraisHorsForfait::class)->findAll();
        $FraisFF = $em->getRepository(FraisForfait::class)->findAll();
        
        return $this->render('fraisforfait/FFdeVisiteur.html.twig', array('horsforfait' => $lignefHf));
        
    }
      
      
    
}

