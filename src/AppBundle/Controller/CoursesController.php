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

use Aws\S3\S3Client;


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
    }

    /**
     * @Route("/saveCourse/", name="saveCourse")
     */
    public function saveCourse(Request $request)
    {
        //var_dump($request);die;
        $course_id     = $_POST['id'];
        $courseStudents = explode(",", $_POST['students']);
        // contains file path
        if(isset($_FILES['img']))
            $courseImg     = $_FILES['img']['tmp_name'];

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
        if (isset($_FILES['img']))
            $key = uniqid("", true). $_FILES['img']['name'];

        $courseLight   = new Course();

        // when course comes WITHOUT id, use save
        // when WITH, use update
        if (!isset($course_id) || $course_id === "NaN" || empty($course_id))
        {
            //s3 upload image to amazon
            $doUploadImage = $s3->putObject([
                'Bucket'     => 'evg-college-app',
                'Key'        => $key,
                'SourceFile' => $courseImg
            ]);
            /* Upload img and return url of the img */
            $imgUrl = $doUploadImage["ObjectURL"];
            /* Create url for resized img */
            $imgUrlThumb = str_replace('evg-college-app/', 'evg-college-appresized/resized-', $imgUrl);
            /* Save img to DB return id */
            $savedImgId = $this->imgsService->saveImage($imgUrl, $imgUrlThumb);

            // transform to Light Object
            $courseLight->fromArray([
                'c_name'            => $_POST['name'],
                'c_description'     => $_POST['description'],
                'c_img'             => $savedImgId
            ]);

            // save the course
            $course_id     = $this->coursesService->save($courseLight);
            // save course's students
            $this->coursesService->saveCourseStudents($course_id, $courseStudents);
        }
        else
        {
            if (isset($courseImg)){
                $img_id = $this->imgsService->updateImage($courseImg);
                $courseLight->fromArray([
                    'c_ID'              => $_POST['id'],
                    'c_name'            => $_POST['name'],
                    'c_description'     => $_POST['description'],
                    'c_img'             => $img_id
                ]);
            }
            else{
                $course = $this->coursesService->getCourseByID($course_id);
                $courseLight->fromArray([
                    'c_ID'              => $_POST['id'],
                    'c_name'            => $_POST['name'],
                    'c_description'     => $_POST['description'],
                    'c_img'             => $course->c_img
                ]);
            }
            $course_id     = $courseLight->c_ID;
            $this->coursesService->update($courseLight);
            $this->coursesService->updateCourseStudents($course_id, $courseStudents);
        }



        $response       = new Response();
        $response->setContent($course_id);
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }
}