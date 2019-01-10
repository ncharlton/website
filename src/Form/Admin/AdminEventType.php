<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\Event;
use App\Entity\Game;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminEventType
 * @package App\Form\Admin
 */
class AdminEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('published', CheckboxType::class, [
                'required' => false
            ])
            ->add('game', EntityType::class, [
                'placeholder' => 'Game',
                'class' => Game::class,
                'required' => false,
                'choice_label' => 'name'
            ])
            ->add('title', TextType::class, [

            ])
            ->add('description', CKEditorType::class, [

            ])
            ->add('startAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('endAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Event'
        ]);
    }

}