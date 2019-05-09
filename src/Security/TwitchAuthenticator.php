<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Security;

use App\Service\Twitch\TwitchAuthenticationService;
use App\Service\Twitch\TwitchUserService;
use App\Service\User\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class TwitchAuthenticator
 * @package App\Security
 */
class TwitchAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var TwitchAuthenticationService $twitchAuthenticationService
     */
    private $twitchAuthenticationService;

    /**
     * @var TwitchUserService $twitchUserService
     */
    private $twitchUserService;

    /**
     * @var UserService $userService
     */
    private $userService;

    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * @var RouterInterface $router
     */
    private $router;

    public function __construct(TwitchAuthenticationService $twitchAuthenticationService,
                                TwitchUserService $twitchUserService,
                                EntityManagerInterface $entityManager,
                                UserService $userService,
                                RouterInterface $router)
    {
        $this->twitchAuthenticationService = $twitchAuthenticationService;
        $this->twitchUserService = $twitchUserService;
        $this->em = $entityManager;
        $this->userService = $userService;
        $this->router = $router;
    }

    public function supports(Request $request)
    {
        if ($request->getPathInfo() == '/login-twitch' && $request->isMethod('GET'))
        {
            return $request->query->has('code');
        } else {
            return false;
        }
    }

    public function getCredentials(Request $request)
    {
        $code = $request->query->get('code');
        return $this->twitchAuthenticationService->getTokens($code);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if($credentials === null)
        {
            return;
        }

        $twitchUser = $this->twitchUserService->fetchUserByBearerToken($credentials['accessToken']);

        $user = $this->em->getRepository('App:User')
            ->findOneBy([
                'twitchId' => $twitchUser['twitchId']
            ]);

        if($user)
        {
            return $user;
        } else
        {
            return $this->userService->registerUser($twitchUser, $credentials);
        }
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new RedirectResponse($this->router->generate('main_home'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('main_home'));
    }

    public function supportsRememberMe()
    {
        return true;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('/login');
    }


}