<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\Page;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminPageType
 * @package App\Form\Admin
 */
class AdminPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seoTitle', TextType::class, [
                'required' => false,
                'label' => 'Seo title',
            ])
            ->add('seoDescription', TextType::class, [
                'required' => false,
                'label' => 'Seo description',
            ])
            ->add('seoKeywords', TextType::class, [
                'required' => false,
                'label' => 'Seo keywords',
            ])
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Page title',
            ])
            ->add('content', CKEditorType::class, [
                'required' => false,
                'label' => 'Page content',
            ])
            ->add('published', CheckboxType::class, [
                'required' => false,
                'label' => 'Published',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}

