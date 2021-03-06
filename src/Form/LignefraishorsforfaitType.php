<?php

namespace App\Form;
use App\Entity\LigneFraisHorsForfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class LignefraishorsforfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class, array('label'=>'Libelle:','attr'=>array('class'=>'form-control', 'placeholder'=>'Libelle')))
            ->add('date',DateType::class, array('label'=>'dateModif:','attr'=>array('class'=>'form-control', 'placeholder'=>'dateModif')))
            ->add('montant',NumberType::class, array('label'=>'montant:','attr'=>array('class'=>'form-control', 'placeholder'=>'montant')))
            //->add('visiteur',EntityType::class, array('label'=>'visiteur:','attr'=>array('class'=>'form-control', 'placeholder'=>'visiteur')))
            //->add('mois', EntityType::class, array('label'=>'mois:','attr'=>array('class'=>'form-control', 'placeholder'=>'mois')))
            ->add('Valider',SubmitType::class, array('label'=>'Valider','attr'=>array('class'=>'btn btn-primary btn-block')))   
            ->add('annuler',ResetType::class, array('label'=>'Quitter','attr'=>array('class'=>'btn btn-primary btn-block')))  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneFraisHorsForfait::class,
        ]);
    }
}
