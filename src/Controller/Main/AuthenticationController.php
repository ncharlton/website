<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Service\Twitch\TwitchAuthenticationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticationController extends AbstractController
{
    /**
     * @Route("/login", name="main_authentication_login")
     */
    public function loginAction(TwitchAuthenticationService $authenticationService) {
        return $this->render('main/authentication/login.html.twig', [
            'loginUrl' => $authenticationService->authorizeUrl()
        ]);
    }

    /**
     * @Route("/login-twitch", name="main_authentication_twitch_login")
     */
    public function twitchLoginAction() {
        return $this->render('main/authentication/twitch_login.html.twig');
    }

    /**
     * @Route("/logout", name="main_logout")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logoutAction() {
        return $this->redirectToRoute('main_home');
    }
}