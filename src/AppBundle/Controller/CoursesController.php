<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 05/01/17
 * Time: 15:37
 */

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


class CoursesController extends Controller
{
    private $studentsService;
    private $coursesService;
    private $imgsService;

    public function __construct()
    {
        $this->studentsService  = Scope::skeleton()->get(IStudentService::class);
        $this->coursesService   = Scope::skeleton()->get(ICourseService::class);
        $this->imgsService      = Scope::skeleton()->get(IImageService::class);
    }

    /**
     * @Route("/getAllCourses", name="getAllCourses")
     */
    public function getAllCourses(Request $request)
    {
        $allCourses = $this->coursesService->getAllCourses();
        return new JsonResponse($allCourses);
        /*var_dump($allCourses);
        die;*/
    }

    /**
     * @Route("/getCourseImgsAndStudents/{courseId}", name="getCourseImgsAndStudents")
     */
    public function getCourseImgsAndStudents($courseId)
    {
        $studentsLight   = array();
        $students        = array();
        $response        = array();

        $studentIdsOfThisCourse = $this->coursesService->getCourseStudents($courseId);

        foreach ($studentIdsOfThisCourse as $studentId){
            $singleStudentLight  = $this->studentsService->getStudentByID($studentId);
            array_push($studentsLight, $singleStudentLight);
        }
        $courseImgsId     = $this->coursesService->getCourseByID($courseId)->c_img;
        $imgs             = $this->imgsService->getImageByID($courseImgsId);
        $students         = Student::allToArray($studentsLight);

        array_push($response, $imgs, $students);
        return new JsonResponse($response);

        /*var_dump($response);
        die;*/
    }
}