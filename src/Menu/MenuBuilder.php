<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Menu;

use App\Entity\User;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class MenuBuilder
 * @package App\Menu
 */
class MenuBuilder
{
    /** @var FactoryInterface $factory */
    private $factory;

    /** @var TokenStorageInterface $token */
    private $token;

    /**
     * MenuBuilder constructor.
     *
     * @param FactoryInterface $factory
     * @param TokenStorageInterface $token
     */
    public function __construct(FactoryInterface $factory, TokenStorageInterface $token)
    {
        $this->factory = $factory;
        $this->token = $token;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root')->setAttribute('class', 'test-nav');

        /** @var \Symfony\Component\Security\Core\User\User $user */
        $user = $this->token->getToken()->getUser();


        # Home
        $menu->addChild('Home', ['route' => 'main_home']);

        # news
        $menu->addChild('News', ['route' => 'main_news_list']);

        # videos
        $menu->addChild('Videos', ['route' => 'main_video_list']);

        # clips
        $menu->addChild('Clips', ['route' => 'main_clip_list']);

        # events
        $menu->addChild('Events', ['route' => 'main_event_list']);

        # if logged in
        if($user instanceof User) {
            # if admin
            if($user->isAdmin()) {
                # admin
                $menu->addChild('Admin', ['route' => 'admin_main_home']);
            }
            # logout
            $menu->addChild('Logout', ['route' => 'main_logout']);

        } else {
            # login
            $menu->addChild('Login', ['route' => 'main_authentication_login']);
        }




        return $menu;
    }
}