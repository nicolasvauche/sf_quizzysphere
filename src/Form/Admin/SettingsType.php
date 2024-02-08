<?php

namespace App\Form\Admin;

use App\Entity\Settings;
use App\Entity\UserGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('defaultUserGroup', EntityType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Groupe Utilisateurs par défaut',
                'class' => UserGroup::class,
                'choice_label' => 'name',
                'placeholder' => 'Aucun Groupe par défaut',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('quizzQuestionsMax', NumberType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Questions maximum par Quizz',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                ],
            ])
            ->add('quizzAnswersMax', NumberType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Réponses maximum par Question',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Settings::class,
        ]);
    }
}
