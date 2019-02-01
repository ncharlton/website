<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Api;

use App\Service\Twitch\TwitchStreamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiTwitchController
 * @package App\Controller\Api
 */
class ApiTwitchController extends AbstractController
{
    /**
     * @Route("/api/twitch/stream/status")
     */
    public function isStreamerLive(TwitchStreamService $streamService) {
        $result = $streamService->isStreamerLive();

        if($result) {
            return new JsonResponse($result, 200);
        } else {
            return new JsonResponse(false, 200);
        }

    }
}