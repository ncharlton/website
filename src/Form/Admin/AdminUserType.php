<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Form\Admin;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AdminUserType
 * @package App\Form\Admin
 */
class AdminUserType extends AbstractType
{
    private $token;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [
            'mod' => 'ROLE_MOD',
            //'Super admin' => 'ROLE_SUPER_ADMIN',
        ];

        if($this->token->getToken()) {
            /** @var User $user */
            $user = $this->token->getToken()->getUser();

            if($user->isSuperAdmin()) {
                $choices = [
                    'Super admin' => 'ROLE_SUPER_ADMIN',
                    'admin' => 'ROLE_ADMIN',
                    'mod' => 'ROLE_MOD'
                ];
            }
        }

        $builder
            ->add("username", TextType::class)
            ->add("email", EmailType::class)
            ->add("roles", ChoiceType::class, [
                'choices' => $choices,
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}