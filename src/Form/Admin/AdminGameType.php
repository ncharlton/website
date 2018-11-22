<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminGameForm
 * @package App\Form\Admin
 */
class AdminGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('image', TextType::class)
            ->add('buyLink', TextType::class)
            ->add('website', TextType::class)
            ->add('developer', TextType::class)
            ->add('publisher', TextType::class)
            ->add('genre', TextType::class)
            ->add('summary', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'App\Entity\Game',
        ]);
    }

}