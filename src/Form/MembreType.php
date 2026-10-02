<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mel')
            ->add('mdp', PasswordType::class, [
                'mapped'   => false,
                'required' => false,
                'label'    => 'Nouveau mot de passe',
                'help'     => 'Laisser vide pour conserver le mot de passe actuel',
            ])
            ->add('Pseudo')
            ->add('photoProfil')
            ->add('date_creation_compte')
            ->add('utilisateur_role')
            ->add('return')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
