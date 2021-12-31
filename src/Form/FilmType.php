<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Realisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de votre film',
                'attr' => [
                    'placeholder' => 'Entrez un titre'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un titre.'
                    ]),
                ],
            ])
            ->add('resume', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Entrez le resume de votre film'
                ],
            ])
            ->add('duree', TextType::class, [
                'label' => 'Duree de votre film',
                'attr' => [
                    'placeholder' => 'Entrez une duree'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une duree.'
                    ]),
                ],
            ])
            ->add('annee_sortie', TextType::class, [
                'label' => 'Année de sortie de votre film',
                'attr' => [
                    'placeholder' => 'Entrez une année de sortie'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une année de sortie.'
                    ]),
                ],
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix de votre film',
                'attr' => [
                    'placeholder' => 'Entrez un prix'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un prix'
                    ]),
                ],
            ])
            ->add('realisateurId', EntityType::class, [
                'label' => 'Nom du réalisateur',
                'class' => Realisateur::class,
                'choice_label' => function ($realisateur) {
                    return $realisateur->getNom();
                },
                'attr' => [
                    'placeholder' => 'Sélectionner un réalisateur'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'd-block col-3 mx-auto btn btn-primary'
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
