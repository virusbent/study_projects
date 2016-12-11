<?php
require_once 'vendor/autoload.php';

use \AppBundle\Scope;
use \AppBundle\Base\DAO\IStudentDAO;
use \AppBundle\Base\DAO\ICourseDAO;
use \AppBundle\Base\DAO\IAdminDAO;
use \AppBundle\DAO\Courses_StudentsDAO;
use \AppBundle\Base\DAO\IStudentService;
use \AppBundle\Base\DAO\IImageDAO;
use \AppBundle\Base\DAO\IImageService;

use \AppBundle\Objects\Course;
use \AppBundle\Objects\Student;
use \AppBundle\Objects\Admin;

/** @var IStudentDAO $StudentDAO */
//$studentDAO = Scope::skeleton()->get(IStudentDAO::class);
/** @var ICourseDAO $CourseDAO */
$courseDAO = Scope::skeleton()->get(ICourseDAO::class);
/** @var IAdminDAO $AdminDAO */
$adminDAO = Scope::skeleton()->get(IAdminDAO::class);

$imgDAO = Scope::skeleton()->get(IImageDAO::class);

//works - saving Student to DB (generated)from array.
/*$newStudent = new Student();
$newStudent->fromArray([
    's_name'      => 'Haruz',
    's_email'     => 'haruz@gmail.com',
    's_phone'     => '0528864232',
    's_img'       => 2
]);
$studentDAO->save($newStudent);*/

//works
/*$data = [
    'c_name'        => 'Course_A',
    'c_description' => 'some description',
    'c_img'         => 0];
$newCourse = new Course();
$newCourse->fromArray($data);

$courseDAO->save($newCourse);*/

//works - saving Admin to DB (generated)from array.
/*$newadmin = new Admin();
$newadmin->fromArray([
    'a_name'      => 'Evgeniy',
    'a_email'     => 'evgen@gmail.com',
    'a_phone'     => '0528864255',
    'a_password'  => '123',
    'a_role'      => 1
]);
$adminDAO->save($newadmin);*/


/*$select = Scope::connector()->select();
$select->from('students')->where('s_ID=?', 3);
$result = $select->queryRow();
var_dump($result);*/

// works - pull all the Students that registered in course: Java.
/*$allStudentsOfJava = new Courses_StudentsDAO();
$result = $allStudentsOfJava->getAllStudentsOfCourse(3);
var_dump($result);
foreach ($result as $javaStudentID)
{
    $javaStudent = $studentDAO->load($javaStudentID);
    var_dump($javaStudent);
}*/

// works - pull all Courses that some Student is registered to.
/*$allCoursesOfStudent = new Courses_StudentsDAO();
$result = $allCoursesOfStudent->getAllCoursesOfStudent(3);
var_dump($result);
foreach ($result as $courseID)
{
    $course = $courseDAO->load($courseID);
    var_dump($course);
}*/

$service = Scope::skeleton()->get(IStudentService::class);
$count   = $service->getNumberOfStudents();
$student = $service->getStudentByID(3);
var_dump($student);

$imgService = Scope::skeleton()->get(IImageService::class);
$img = $imgService->getImageByID(5);

$newImg = 'student_profile3.jpeg';
$imgService->saveImage($newImg);


//TODO: write Services to Courses and Admins.
