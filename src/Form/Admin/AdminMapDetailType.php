<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\MapDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminMapDetailType
 * @package App\Form\Admin
 */
class AdminMapDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', ChoiceType::class, [
                'choices' => MapDetail::START,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('scout', ChoiceType::class, [
                'choices' => MapDetail::SCOUT,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('type', ChoiceType::class, [
                'choices' => MapDetail::TYPE,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('base', ChoiceType::class, [
                'choices' => MapDetail::BASE,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('shoreFish', ChoiceType::class, [
                'choices' => MapDetail::SHORE_FISH,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('deepFish', ChoiceType::class, [
                'choices' => MapDetail::DEEP_FISH,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('wood', ChoiceType::class, [
                'choices' => MapDetail::WOOD,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('gold', ChoiceType::class, [
                'choices' => MapDetail::GOLD,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('stone', ChoiceType::class, [
                'choices' => MapDetail::STONE,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('food', ChoiceType::class, [
                'choices' => MapDetail::FOOD,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('hunt', ChoiceType::class, [
                'choices' => MapDetail::HUNT,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('berries', ChoiceType::class, [
                'choices' => MapDetail::BERRIES,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('relics', ChoiceType::class, [
                'choices' => MapDetail::RELICS,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('hills', ChoiceType::class, [
                'choices' => MapDetail::HILLS,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('cliffs', ChoiceType::class, [
                'choices' => MapDetail::CLIFFS,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('terrain', ChoiceType::class, [
                'choices' => MapDetail::TERRAIN,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
            ->add('wallable', ChoiceType::class, [
                'choices' => MapDetail::WALLABLE,
                'choice_label' => function($choice, $key, $value) {return $value;}
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MapDetail::class
        ));
    }

}