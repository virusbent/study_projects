<?php

namespace AppBundle\Controller;

use AppBundle\Objects\Student;
use AppBundle\Scope;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use \AppBundle\Base\DAO\IStudentService;
use AppBundle\Base\DAO\IImageService;

class StudentsController extends Controller
{
    /**
     * @Route("/getAllStudents", name="getAllStudents")
     */
    public function getAllStudents(Request $request)
    {
        // services
        $studentsService = Scope::skeleton()->get(IStudentService::class);

        $qResult         = $studentsService->getAllStudents();
        $response        = json_encode($qResult);

        return new Response($response);
    }


}
