<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Main;

use App\Validator\Constraints\ValidClipUrl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

/**
 * Class ClipNewType
 * @package App\Form\Main
 */
class ClipNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Url(),
                    new ValidClipUrl()
                ]
            ])
            ->add('title', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(array('min' => 10, 'max' => '100'))
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}