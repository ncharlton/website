<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 22.11.2018
 * Time: 16:30
 */

namespace App\Tests\Service;


use App\Service\Twitch\TwitchClipService;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TwitchClipServiceTest extends WebTestCase
{
    public function testClipFetch() {
        self::bootKernel();
        $container = self::$container;

        $clipService = $container->get('app.twitch_clip');

        $clipService->fetchClipById();
    }
}