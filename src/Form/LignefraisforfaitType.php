<?php

namespace App\Form;

use App\Entity\LigneFraisForfait;
use App\Entity\FicheFrais;
use App\Entity\FraisForfait;       
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

class LignefraisforfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mois',TextType::class, array('label'=>'mois:','attr'=>array('class'=>'form-control', 'placeholder'=>'mois')))
            ->add('quantite', NumberType::class, array('label'=>'quantite:','attr'=>array('class'=>'form-control', 'placeholder'=>'quantite')))
            ->add('fichefrais', EntityType::class, array('class' => FicheFrais::class , 'choice_label' => 'fichefrais', 'label' => "Visiteur"))
            ->add('fraisforfait',EntityType::class, array('class'=> FraisForfait::class, 'label'=>'fraisforfait', 'choice_label'=>'fraisforfait'))
            ->add('Valider',SubmitType::class, array('label'=>'Valider','attr'=>array('class'=>'btn btn-primary btn-block')))   
            //->add('annuler',ResetType::class, array('label'=>'Quitter','attr'=>array('class'=>'btn btn-primary btn-block')))     
             
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneFraisForfait::class,
        ]);
    }
}
