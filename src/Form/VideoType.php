<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Membre;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, ['required' => false])
            ->add('duree', TextType::class, [
                'required' => false,
                'label' => 'Durée (en minutes)',
            ])
            ->add('taille')
            ->add('nb_vues', null, ['label' => 'Nombre de vues'])
            ->add('nb_like', null, ['label' => 'Nombre de likes'])
            ->add('live', null, [
                'label' => 'En direct',
                'required' => false,
            ])
            ->add('id_membre', EntityType::class, [
                'class' => Membre::class,
                'choice_label' => 'pseudo',
                'label' => 'Membre ayant déposé la vidéo',
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Catégories',
                'by_reference' => false,
                'attr' => ['class' => 'd-flex gap-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}