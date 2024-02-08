<?php

namespace App\Form\Admin;

use App\Entity\QuizzCategory;
use App\Repository\QuizzCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class QuizzCategoryType extends AbstractType
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
            ->add('parent', EntityType::class, [
                'required' => false,
                'label' => 'Catégorie parente',
                'class' => QuizzCategory::class,
                'attr' => [
                    'class' => 'form-control text-left',
                ],
                'choices' => $hierarchicalCategories,
                'choice_label' => function(QuizzCategory $category) {
                    return html_entity_decode(str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $category->getTemporaryDepth()) . ' ' . $category->getName());
                },
                'placeholder' => '(Pas de parent)',
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom de la catégorie',
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
            ])
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Catégorie active',
                'attr' => [
                    'class' => 'form-checkbox',
                ],
            ])
            ->add('cover', FileType::class, [
                'label' => 'Image de la Catégorie',
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
            'data_class' => QuizzCategory::class,
        ]);
    }
}
