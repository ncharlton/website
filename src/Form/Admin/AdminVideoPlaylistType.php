<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\Event;
use App\Entity\VideoPlaylist;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdminVideoPlaylistType
 * @package App\Form\Admin
 */
class AdminVideoPlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('published', CheckboxType::class, [
                'required' => false
            ])
            ->add('orderNumber', IntegerType::class, [
                'required' => false
            ])
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'multiple' => false,
                'required' => false,
                'placeholder' => 'no event',
                'choice_label' => 'title'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => VideoPlaylist::class
            ]);
    }

}