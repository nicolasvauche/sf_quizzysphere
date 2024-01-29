<?php

namespace App\Form\Admin;

use App\Entity\Course;
use App\Entity\QuizzCategory;
use App\Entity\UserGroup;
use App\Repository\QuizzCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CourseType extends AbstractType
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
                'required' => false,
                'label' => 'Catégories',
                'class' => QuizzCategory::class,
                'choices' => $hierarchicalCategories,
                'choice_label' => function(QuizzCategory $category) {
                    return html_entity_decode(str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $category->getTemporaryDepth()) . ' ' . $category->getName());
                },
                'autocomplete' => true,
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('userGroups', EntityType::class, [
                'required' => false,
                'label' => 'Groupes',
                'class' => UserGroup::class,
                'choice_label' => 'name',
                'autocomplete' => true,
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom du Parcours',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Parcours actif',
                'attr' => [
                    'class' => 'form-checkbox',
                ],
            ])
            ->add('cover', FileType::class, [
                'label' => 'Image du Parcours',
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
