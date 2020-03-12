<?php

namespace App\Controller;
use App\Entity\Visiteur;
use App\Entity\Etat;
use App\Entity\LigneFraisForfait;
use App\Entity\LigneFraisHorsForfait;
use App\Form\VisiteurType;
use App\Entity\FicheFrais;
use App\Form\FicheFraisType;
use App\Form\EtatType;
use Psr\Log\LoggerInterface;
use App\Form\FraisforfaitType;
use App\Repository\VisiteurRepository;
use App\Repository\LigneFraisForfaitRepository;
use App\Form\LignefraisforfaitType;
use App\Form\LignefraishorsforfaitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\FraisForfait;
 
class VisiteurController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('comptable/accueil.html.twig');
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

            if($v != null){ 

               $session ->set('nom', $v->getNom());
               $session ->set('prenom', $v->getPrenom());
               $login = $session->set('login', $login);
               $_SESSION['v'] = $v;

               return $this->redirectToRoute('session_v');            
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
     * @Route("/saissirFF", name="saissirFF")
    */ 
    
    public function addFicheFrais(Request $request, Session $session ) {
        
        $mois = null;
        if(date('j') > 15 ){
            $mois = date("m")-1; 
        }
        else{
            $mois = date('m');
        }
        $monthyear = array($mois,date('Y'));
        $id = $_SESSION['v']->getId();
        
        $ff = new FicheFrais();
        $form = $this->createForm(FicheFraisType::class, $ff);
                
        /*$repas->$request->get('repas');
        $nuitee->$request->get('nuitees');
        $etape->$request->get('etape');
        $km->$request->get('km');*/
 
        $ligneff = $this->getDoctrine()->getManager()->getRepository(LigneFraisForfait::class)->findAll();  
                
        if(sizeof($ligneff) < 1  ){   
             $em= $this->getDoctrine()->getManager();
            
           // $fichef = $em->getrepository(FicheFrais::class)->getByMois($mois, $id);
            $fraisForfait = $em->getRepository(LigneFraisForfait::class)->findIdfff($id);
            foreach($fraisForfait as $lff){
              
                $lignfraisf = new LigneFraisForfait();
                $lff->setFichefrais($fichef);
                $lff->setFraisForfait($lff);
                $lff->setMois($mois);
                $lff->setQuantite(0);  
                $em->persist($lignfraisf);
                $em->flush();

                $lignfraisf = null;
                
                $request->getSession()->getFlashBag()->add('notice', 'lfraisforfait bien enregistre.');                              
                
            }
            
        }  
        
    return $this->render('visiteur/saisirFF.html.twig', ['monthY'=> $monthyear, 'l' => $ligneff ,'id' => $id  ]);//return $this->redirect('session_v');
 }  
    
    
 
 
 
 
    /** 
     * @Route("/lfhf", name="lfhf")
     */
    
    public function LFHF(Request $request, Session $session){
        $mois = null;
        if(date('j') > 15 ){
            $mois = date("F", strtotime("+1 month", strtotime(date("F") . "1")) ); 
        }
        else{
            $mois = date('F');
        }
        $monthyear = array($mois,date('Y'));
        $lfhf = new LigneFraisHorsForfait();
        $form = $this->createForm(LignefraishorsforfaitType::class, $lfhf);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $ff = $em->getRepository(FicheFrais::classs)->getByMoisr($mois, $id);
                $lignefhf = $em->getRepository(LigneFraisHorsForfait::class)->getIdlfhf($id);
                if($ligneff == null){
                    if($form->isValid()){
                        $lignehorsff = new LigneFraisHorsForfait();
                            $lignehorsff->setsetFichefrais($ff);
                            $lignehorsff->setLibelle();
                            $lignehorsff->setDate($monthyear);
                            $lignehorsff->setMontant();
                             

                                $em->persist($lignehorsff);

                                $em->flush();

                                $lff = null;

                                $request->getSession()->getFlashBag()->add('notice', 'lfraishorsforfait bien enregistre.'); 
                    }
                }               
                    }
        return $this->render('visiteur/saisirFF', ['month'=> $monthyear, 'lfhf'=> $lignefhf]);
    }
 
 
 
 
 
 
 
 
    
    
      /*public function functionName(Request $request, Session $session){
      
            $etat = $this->getDoctrine()->getRepository(Etat::class)->findAll();
                $FicheFrais = new FicheFrais();
                    $FicheFrais->setDateModif(new \DateTime());
                    $FicheFrais->setVisiteur($visiteur);
                    $FicheFrais->setMois($mois);
                    $FicheFrais->setMontantValide(0);
                    $FicheFrais->setNbJustificatifs(0);
                    $FicheFrais->setEtat($etat);
                    $entityManager->persist($FicheFrais);
                    $entityManager->flush();                  
            }
        $ligneHF=$this->getDoctrine()->getREpository(LigneFraisHorsForfait::class)->getIdVMois($mois, $id);
        
        $lfhf = new LigneFraisHorsForfait();
        $fom = $this->createForm(\App\Entity\LigneFraisHorsForfait::class, $lfhf);
        $form->handleRequest($query);
            if ($form->isSubmitted() && $form->isValid()) {
                $lfhf->setMois($mois);
                $lfhf->setIdVisiteur($visiteur);
                $em = $this->getDoctrine()->getManager();
                $em->persist($lfhf);
                $em->flush();
            }
        
        
        
        return $this->render('visiteur/saisirFF.html.twig', array('form' =>$form->createView()));
 }  
}*/
    /*
    
    public function register(){
    
        return $this->render('fichefrais/add.html.twig');
    }
        
      */  
       
        
   



}