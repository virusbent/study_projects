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
        $imgService      = Scope::skeleton()->get(IImageService::class);

        $qResult         = $studentsService->getAllStudents();

        //$allStudents     = Student::allFromArray($qResult);

        /*foreach ($qResult as $student){
            $imgData         = $imgService->getImageByID($student->s_img);
            $student->s_img  = $imgData[2];

            //$student->s_img = $thumbnail;
        };*/

        $response        = json_encode($qResult);

        return new Response($response);
    }


}
