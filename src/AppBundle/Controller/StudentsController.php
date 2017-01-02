<?php

namespace AppBundle\Controller;

use AppBundle\Objects\Course;
use AppBundle\Objects\Student;
use AppBundle\Scope;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use \AppBundle\Base\DAO\IStudentService;
use AppBundle\Base\DAO\ICourseService;
use AppBundle\Base\DAO\IImageService;

class StudentsController extends Controller
{
    private $studentsService;
    private $coursesService;

    public function __construct()
    {
        $this->studentsService  = Scope::skeleton()->get(IStudentService::class);
        $this->coursesService   = Scope::skeleton()->get(ICourseService::class);
    }

    /**
     * @Route("/getAllStudents", name="getAllStudents")
     */
    public function getAllStudents(Request $request)
    {

        $qResult         = $this->studentsService->getAllStudents();
        $response        = json_encode($qResult);

        /*var_dump($qResult);
        die();*/

        return new Response($response);
    }

    /**
     * @Route("/getThisStudentCourses/{studentId}", name="getStudentCourses")
     */
    public function getStudentCourses($studentId)
    {
        $coursesLight   = array();
        $courses        = array();

        $coursesIdsOfThisStudent = $this->studentsService->getStudentCourses($studentId);

        foreach ($coursesIdsOfThisStudent as $courseId){
            $singleCourseLight  = $this->coursesService->getCourseByID($courseId);
            array_push($coursesLight, $singleCourseLight);
        }

        $courses    = Course::allToArray($coursesLight);
        /*var_dump($response);
        die();*/
        return new JsonResponse($courses);

    }


}
