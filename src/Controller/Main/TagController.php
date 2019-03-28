<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagController
 * @package App\Controller\Main
 */
class TagController extends AbstractController
{
    /**
     * @Route("/tag/{slug}", name="main_tag_view")
     * @ParamConverter("tag", options={"mapping": {"slug":"slug"}})
     *
     * @param Tag $tag
     * @return Response
     */
    public function viewAction(Tag $tag) {
        dump($tag);
        return $this->render('main/tag/view.html.twig', [
            'tag' => $tag
        ]);
    }
}