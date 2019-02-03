<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminNewsType
 * @package App\Form\Admin
 */
class AdminNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('seoTitle', TextType::class, [
                'required' => false
            ])
            ->add('seoKeywords', TextType::class, [
                'required' => false,
            ])
            ->add('seoDescription', TextareaType::class, [
                'required' => false
            ])
            ->add('published', CheckboxType::class, [
                'required' => false
            ])
            ->add('content', CKEditorType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver
           ->setDefaults([
               'data_class' => "App\Entity\News"
           ]);
    }

}