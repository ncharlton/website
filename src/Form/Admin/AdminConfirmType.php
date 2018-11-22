<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminConfirmType
 * @package App\Form\Admin
 */
class AdminConfirmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('confirm', CheckboxType::class, [
               'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}