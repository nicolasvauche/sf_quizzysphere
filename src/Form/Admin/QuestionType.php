<?php

namespace App\Form\Admin;

use App\Entity\Question;
use App\Entity\Quizz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quizz', EntityType::class, [
                'required' => true,
                'label' => 'Quizz associé',
                'class' => Quizz::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('text', TextareaType::class, [
                'required' => true,
                'label' => 'Texte de la Question',
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                    'rows' => 5,
                ],
            ])
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Question Active',
                'attr' => [
                    'class' => 'form-checkbox',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
