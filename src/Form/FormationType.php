<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Category;
use App\Entity\User;
use App\Form\SectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Formation title',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 75]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('sentence', TextType::class, [
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 255]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('instructor', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $instructor) {
                    return $instructor->getName() . ' ' . $instructor->getFirstname();
                },    
            ])
            ->add('isPublished', CheckboxType::class, [
                'required' => false
            ])
            ->add('sections', CollectionType::class, [
                'label' => false,
                'entry_type' => SectionType::class,
                'entry_options' => [
                    'label' => false
                ],
	            'allow_add' => true,
                'allow_delete' => true,
    	        'prototype' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
