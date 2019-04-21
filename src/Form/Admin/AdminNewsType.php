<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\Event;
use App\Entity\Tag;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('cover', FileType::class, [
                'label' => 'Cover image (images only)',
                'required' => false,
            ])
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
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'multiple' => false,
                'required' => false,
                'placeholder' => 'no event',
                'choice_label' => 'title'
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'placeholder' => 'Tags',
                'choice_label' => 'tag'
            ])
            ->add('content', CKEditorType::class, [
                'config_name' => 'news'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver
           ->setDefaults([
               'data_class' => "App\Entity\News"
           ]);
    }
}