<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Listener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


/**
 * Class UserActivityListener
 * @package App\Listener
 */
class UserActivityListener
{
    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * @var TokenStorage $token
     */
    private $token;

    public function __construct(EntityManagerInterface $entityManager, TokenStorage $token)
    {
        $this->em = $entityManager;
        $this->token = $token;
    }

    public function onCoreController(FilterControllerEvent $event)
    {
        // Check that the current request is a "MASTER_REQUEST"
        if($event->getRequestType() !== HttpKernel::MASTER_REQUEST)
            return;

        // Check token authentication availability
        if($this->token->getToken()) {
            $user = $this->token->getToken()->getUser();
            if($user instanceof User && !($user->isActiveNow())) {
                $user->setLastActive(new \DateTime());
                $this->em->persist($user);
                $this->em->flush();
            }
        }
    }
}