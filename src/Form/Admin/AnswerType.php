<?php

namespace App\Form\Admin;

use App\Entity\Answer;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', EntityType::class, [
                'required' => true,
                'label' => 'Question associée',
                'class' => Question::class,
                'choice_label' => 'text',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('text', TextareaType::class, [
                'required' => true,
                'label' => 'Texte de la Réponse',
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                    'rows' => 5,
                ],
            ])
            ->add('help', TextareaType::class, [
                'required' => true,
                'label' => "Correction de la Réponse",
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 7,
                ],
            ])
            ->add('correct', CheckboxType::class, [
                'required' => false,
                'label' => 'Réponse correcte',
                'attr' => [
                    'class' => 'form-checkbox',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
        ]);
    }
}
