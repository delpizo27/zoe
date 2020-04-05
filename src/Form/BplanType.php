<?php

namespace App\Form;

use App\Entity\Bplan;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BplanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['required' => false])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('picture', FileType::class, [
                'required' => false,
                'data_class' => null

            ])


            ->add('price', NumberType::class, ['required' => false]) 
            ->add('file', FileType::class, [
                'required' => false,
                'data_class' => null

            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bplan::class,
        ]);
    }
}
