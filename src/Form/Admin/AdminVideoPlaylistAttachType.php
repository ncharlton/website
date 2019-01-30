<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\VideoPlaylist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class AdminVideoPlaylistAttachType
 * @package App\Form\Admin
 */
class AdminVideoPlaylistAttachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('playlist', EntityType::class, [
                'class' => VideoPlaylist::class,
                'choice_label' => 'title',
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'No playlist'
            ]);
    }
}