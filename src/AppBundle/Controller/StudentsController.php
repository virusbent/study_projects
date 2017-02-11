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

use Aws\S3\S3Client;

class StudentsController extends Controller
{
    private $newStudent;

    private $studentsService;
    private $coursesService;
    private $courses_students;
    /** @var IImageService */
    private $imgsService;
    private $responseWithImgPath;

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
     * @Route("/uploadImageToAmazon/", name="uploadImageToAmazon")
     */
    public function uploadImageToAmazon(Request $request)
    {
        var_dump($_FILES);die;
        //TODO: put key and secret. Test it with ListObjects.
        // @see http://docs.aws.amazon.com/aws-sdk-php/v2/api/class-Aws.S3.S3Client.html
        /*$s3 = new S3Client([
            'key'     => 'AKIAIKFHT4D3YFILN5LQ',
            'secret'  => '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',
            'region'  => 'Global'
        ]);*/
        $test = $_FILES['student_img']['tmp_name'];
        //$path = $s3->listObjects($test);
        print_r(is_uploaded_file($test));die;
        return $response($path);
    }

    /**
     * @Route("/saveStudent/", name="saveStudent")
     */
    public function saveStudent(Request $request)
    {

        var_dump($_POST);
        var_dump($_FILES['img']['tmp_name']);
        die;

        $student_id     = $_POST['id'];
        $studentCourses = $_POST['courses'];

        // Array that contains :
        // In case of NEW student: [0]=>img path  |  [1]=>thumbnail
        // In case of student that BEING UPDATED: [0]=>img id  |  [1]=>img path  |  [2]=>thumbnail
        $studentImg     = $_FILES['img']['tmp_name'];

        $studentLight   = new Student();

        // when student comes WITH id, use studentsService->updateStudent
        // when NOT, use studentsService->saveStudent
        // TODO: finish the 'save/update images' of the student
        if (!$student_id || $student_id === "NaN")
        {
            // save img
            $img_id         = $this->imgsService->saveImage($studentImg[0], $studentImg[1]);

            // transform to Light Object
            $studentLight->fromArray([
                's_name'    => $studentData['name'],
                's_email'   => $studentData['email'],
                's_phone'   => $studentData['phone'],
                's_img'     => $img_id
            ]);

            // save the student
            $student_id     = $this->studentsService->saveStudent($studentLight);
            // save student's courses
            $this->studentsService->saveStudentCourses($student_id, $studentCourses);
        }
        else
        {
            $img_id         = $this->imgsService->updateImage($studentImg);
            $studentLight->fromArray([
                's_ID'      => $studentData['id'],
                's_name'    => $studentData['name'],
                's_email'   => $studentData['email'],
                's_phone'   => $studentData['phone'],
                's_img'     => $img_id
            ]);
            $student_id     = $studentLight->s_ID;
            $this->studentsService->updateStudent($studentLight);
            $this->studentsService->updateStudentCourses($student_id, $studentCourses);
        }



        $response       = new Response();
        $response->setContent($student_id);
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }


}
