<?php

namespace App\Form\Admin;

use App\Entity\Quizz;
use App\Entity\QuizzCategory;
use App\Repository\QuizzCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class QuizzType extends AbstractType
{
    private QuizzCategoryRepository $categoryRepository;

    public function __construct(QuizzCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $hierarchicalCategories = $this->categoryRepository->getHierarchicalCategories();

        $builder
            ->add('quizzCategories', EntityType::class, [
                'required' => true,
                'label' => 'Catégories',
                'class' => QuizzCategory::class,
                'attr' => [
                    'class' => 'form-control text-left',
                ],
                'choices' => $hierarchicalCategories,
                'choice_label' => function(QuizzCategory $category) {
                    return html_entity_decode(str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $category->getTemporaryDepth()) . ' ' . $category->getName());
                },
                'autocomplete' => true,
                'multiple' => true,
                'placeholder' => 'Choisissez dans la liste',
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom du Quizz',
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
            ])
            ->add('cover', FileType::class, [
                'label' => 'Image du Quizz',
                'mapped' => false,
                'required' => false,
                'attr' =>
                    [
                        'class' => 'form-file',
                    ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir une image JPG, PNG ou WebP',
                    ]),
                ],
            ])
            ->add('level', ChoiceType::class, [
                'required' => true,
                'label' => 'Niveau du Quizz',
                'choices' => [
                    'Débutant' => '1 - Débutant',
                    'Intermédiaire' => '2 - Intermédiaire',
                    'Avancé' => '3 - Avancé',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('timer', NumberType::class, [
                'required' => false,
                'label' => 'Temps de réponse (en secondes)',
                'attr' => [
                    'class' => 'form-control text-center',
                    'min' => 0,
                ],
            ])
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Quizz actif',
                'attr' => [
                    'class' => 'form-checkbox',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quizz::class,
        ]);
    }
}
