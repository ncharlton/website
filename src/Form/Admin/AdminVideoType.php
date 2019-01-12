<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminVideoType
 * @package App\Form\Admin
 */
class AdminVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true
            ])
            ->add('description', CKEditorType::class, [
                'required' => true
            ])
            ->add('youtube', TextType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'Youtube ID'
            ])
            ->add('published', CheckboxType::class, [
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Video'
        ]);
    }

}