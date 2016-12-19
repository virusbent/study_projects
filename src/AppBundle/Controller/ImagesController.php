<?php

namespace AppBundle\Controller;

use AppBundle\Scope;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Base\DAO\IImageService;


class ImagesController extends Controller
{
    /**
     * @Route("/getStudentImgs/{studentImgId}", name="get_student_imgs")
     */
    public function getStudentImgs($studentImgId)
    {
        var_dump($studentImgId);

        $imgService      = Scope::skeleton()->get(IImageService::class);

        $imgs            = $imgService->getImageByID($studentImgId);

        $response        = json_encode($imgs);
        var_dump($response);

        return new Response($response);
    }


}
