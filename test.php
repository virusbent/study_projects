<?php
require_once 'vendor/autoload.php';

use \AppBundle\Scope;
use \AppBundle\Base\DAO\IStudentDAO;
use \AppBundle\Base\DAO\ICourseDAO;
use \AppBundle\Base\DAO\IAdminDAO;

use \AppBundle\Objects\Course;
use \AppBundle\Objects\Student;
use \AppBundle\Objects\Admin;

/** @var IStudentDAO $StudentDAO */
$studentDAO = Scope::skeleton()->get(IStudentDAO::class);
/** @var ICourseDAO $CourseDAO */
$courseDAO = Scope::skeleton()->get(ICourseDAO::class);
/** @var IAdminDAO $AdminDAO */
$adminDAO = Scope::skeleton()->get(IAdminDAO::class);

//work
/*$newStudent = new Student();
$newStudent->fromArray([
    's_name'      => 'Haruz',
    's_email'     => 'haruz@gmail.com',
    's_phone'     => '0528864232',
    's_img'       => 2
]);
$studentDAO->save($newStudent);*/

//var_dump(Scope::skeleton()->get(ICourseDAO::class)); // works

//works
/*$data = [
    'c_name'        => 'Course_A',
    'c_description' => 'some description',
    'c_img'         => 0];
$newCourse = new Course();
$newCourse->fromArray($data);

$courseDAO->save($newCourse);*/

//works
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



