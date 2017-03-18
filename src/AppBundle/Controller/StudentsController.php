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

        return new JsonResponse($response);

    }

    /**
     * @Route("/saveStudent/", name="saveStudent")
     */
    public function saveStudent(Request $request)
    {
        //var_dump($_POST);die;
        $student_id     = $_POST['id'];
        $studentCourses = explode(",", $_POST['courses']);

        // contains file path
        if(isset($_FILES['img'])){
            $studentImg     = $_FILES['img']['tmp_name'];
        }
        /*else{
            $curr_student   = $this->studentsService->getStudentByID($student_id);
            $studentImg     = $this->imgsService->getImageByID($curr_student->s_img);
        }*/


        /* --------- amazon s3 config --------- */
        $s3 = new S3Client([
            'credentials' =>
            [
                'key'     => 'AKIAIKFHT4D3YFILN5LQ',
                'secret'  => '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'
            ],
            'region'  => 'us-east-1',
            'version' => 'latest'
        ]);
        if(isset($_FILES['img']['name']))
            $key = uniqid("", true). $_FILES['img']['name'];

        $studentLight   = new Student();

        // when student comes WITH id, use studentsService->updateStudent
        // when NOT, use studentsService->saveStudent
        if (!isset($student_id) || $student_id === "NaN" || empty($student_id))
        {
            //s3 upload image to amazon
            $doUploadImage = $s3->putObject([
                'Bucket'     => 'evg-college-app',
                'Key'        => $key,
                'SourceFile' => $studentImg
            ]);
            /* Upload img and return url of the img */
            $imgUrl = $doUploadImage["ObjectURL"];
            /* Create url for resized img */
            $imgUrlThumb = str_replace('evg-college-app/', 'evg-college-appresized/resized-', $imgUrl);
            /* Save img to DB return id */
            $savedImgId = $this->imgsService->saveImage($imgUrl, $imgUrlThumb);

            // transform to Light Object
            $studentLight->fromArray([
                's_name'    => $_POST['name'],
                's_email'   => $_POST['email'],
                's_phone'   => $_POST['phone'],
                's_img'     => $savedImgId
            ]);

            // save the student
            $student_id     = $this->studentsService->saveStudent($studentLight);
            // save student's courses
            $this->studentsService->saveStudentCourses($student_id, $studentCourses);
        }
        else
        {
            if (isset($studentImg)){
                $img_id = $this->imgsService->updateImage($studentImg);
                $studentLight->fromArray([
                    's_ID'      => $_POST['id'],
                    's_name'    => $_POST['name'],
                    's_email'   => $_POST['email'],
                    's_phone'   => $_POST['phone'],
                    's_img'     => $img_id
                ]);
            }
            else{
                $student = $this->studentsService->getStudentByID($student_id);
                $studentLight->fromArray([
                    's_ID'      => $_POST['id'],
                    's_name'    => $_POST['name'],
                    's_email'   => $_POST['email'],
                    's_phone'   => $_POST['phone'],
                    's_img'     => $student->s_img
                ]);
            }
            $student_id     = $studentLight->s_ID;
            $this->studentsService->updateStudent($studentLight);
            $this->studentsService->updateStudentCourses($student_id, $studentCourses);
        }



        $response       = new Response();
        $response->setContent($student_id);
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }


    /* ************************************ */
    /* ***********______________*********** */
    /* ***********| DEPRECATED |*********** */
    /* ************************************ */

    /**
     * @Route("/uploadImageToAmazon/", name="uploadImageToAmazon")
     */
//    public function uploadImageToAmazon(Request $request)
//    {
//        var_dump($_FILES);die;
//        // @see http://docs.aws.amazon.com/aws-sdk-php/v2/api/class-Aws.S3.S3Client.html
//        /*$s3 = new S3Client([
//            'key'     => 'AKIAIKFHT4D3YFILN5LQ',
//            'secret'  => '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',
//            'region'  => 'Global'
//        ]);*/
//        $test = $_FILES['student_img']['tmp_name'];
//        //$path = $s3->listObjects($test);
//        print_r(is_uploaded_file($test));die;
//        return $response($path);
//    }

    /**
     * @Route("/getThisStudentCourses/{studentId}", name="getStudentCourses")
     */
//    public function getStudentCourses($studentId)
//    {
//        $coursesLight   = array();
//        $courses        = array();
//
//        $coursesIdsOfThisStudent = $this->studentsService->getStudentCourses($studentId);
//
//        foreach ($coursesIdsOfThisStudent as $courseId){
//            $singleCourseLight  = $this->coursesService->getCourseByID($courseId);
//            array_push($coursesLight, $singleCourseLight);
//        }
//
//        $courses    = Course::allToArray($coursesLight);
//
//        return new JsonResponse($courses);
//
//    }

}
