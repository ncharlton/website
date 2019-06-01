<?php
/**
 * @author Nicolas Charlotn
 */

namespace App\Form\Admin;

use App\Entity\Map;
use App\Entity\MapPack;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminMapPackType
 * @package App\Form\Admin
 */
class AdminMapPackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('published', CheckboxType::class, [
                'required' => false,
            ])
            ->add('title', TextType::class, [])
            ->add('description', CKEditorType::class, [])
            ->add('maps', EntityType::class, [
                'class' => Map::class,
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'choice_label' => 'title'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MapPack::class
        ));
    }

}