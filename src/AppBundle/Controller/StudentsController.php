<?php

namespace AppBundle\Controller;

use AppBundle\Base\DAO\IStudentDAO;
use AppBundle\Objects\Course;
use AppBundle\Objects\Student;
use AppBundle\Scope;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use \AppBundle\Base\DAO\IStudentService;
use AppBundle\Base\DAO\ICourseService;
use AppBundle\Base\DAO\IImageService;

class StudentsController extends Controller
{
    private $newStudent;

    private $studentsService;
    private $coursesService;
    private $courses_students;
    private $imgsService;

    public function __construct()
    {
        $this->studentsService  = Scope::skeleton()->get(IStudentService::class);
        $this->coursesService   = Scope::skeleton()->get(ICourseService::class);
        $this->imgsService      = Scope::skeleton()->get(IImageService::class);
    }

    /**
     * @Route("/getAllStudents", name="getAllStudents")
     */
    public function getAllStudents(Request $request)
    {

        $qResult         = $this->studentsService->getAllStudents();
        $response        = json_encode($qResult);

        return new Response($response);
    }

    /**
     * IMPORTANT! - may be replaced
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
        return new JsonResponse($courses);

    }

    /**
     * TESTING - may replace getStudentCourses
     * @Route("/getStudentImgsAndCourses/{studentId}", name="getStudentInfo")
     */
    public function getStudentImgsAndCourses($studentId)
    {
        $coursesLight   = array();
        $courses        = array();
        $response       = array();

        $coursesIdsOfThisStudent = $this->studentsService->getStudentCourses($studentId);

        foreach ($coursesIdsOfThisStudent as $courseId){
            $singleCourseLight  = $this->coursesService->getCourseByID($courseId);
            array_push($coursesLight, $singleCourseLight);
        }
        $studentImgsId  = $this->studentsService->getStudentByID($studentId)->s_img;
        $imgs           = $this->imgsService->getImageByID($studentImgsId);
        $courses        = Course::allToArray($coursesLight);

        array_push($response, $imgs, $courses);
        /*var_dump($response);
        die;*/
        return new JsonResponse($response);

    }

    /**
     * @Route("/saveStudent", name="saveStudent")
     * @Method("POST")
     */
    //TODO: additional functionality is needed - save student images
    public function saveStudent(){
        $studentData    = $_POST;
        $studentCourses = $studentData['courses'];
        $studentLight   = new Student();

        $studentLight->fromArray([
            's_name'    => $studentData['name'],
            's_email'   => $studentData['email'],
            's_phone'   => $studentData['phone']
        ]);
        $student_id     = $this->studentsService->saveStudent($studentLight);
        $this->studentsService->saveStudentCourses($student_id, $studentCourses);

        $response       = new Response();
        $response->setContent($student_id);
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }


}
