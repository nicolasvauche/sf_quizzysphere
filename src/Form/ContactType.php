<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Votre Adresse e-mail',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Votre Nom complet',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('subject', TextType::class, [
                'required' => true,
                'label' => 'Sujet de votre Message',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => 'Votre Message',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
