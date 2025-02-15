<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('title', TextType::class, [
            'label' => 'Titre du projet',
            'attr' => ['placeholder' => 'Entrez le titre du projet']
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
            'required' => false,
            'attr' => ['placeholder' => 'Décrivez le projet']
        ])
        ->add('url', UrlType::class, [
            'label' => 'Lien du projet',
            'required' => false,
            'attr' => ['placeholder' => 'Lien vers le projet (facultatif)']
        ])
        ->add('createdAt', DateTimeType::class, [
            'label' => 'Date de création',
            'widget' => 'single_text', // Affiche un champ de saisie unique (format HTML5)
            'attr' => ['placeholder' => 'Sélectionnez une date']
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Ajouter le projet',
            'attr' => ['class' => 'btn btn-primary']
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
