<?php

namespace App\Form\Admin;

use App\Entity\User;
use App\Entity\UserGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('members', EntityType::class, [
                'required' => false,
                'label' => 'Membres du groupe',
                'class' => User::class,
                'choice_label' => 'fullname',
                'multiple' => true,
                'autocomplete' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom du groupe',
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
            ])
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Groupe actif',
                'attr' => [
                    'class' => 'form-checkbox',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserGroup::class,
            'members' => [],
            'mode' => 'add',
        ]);
    }
}
