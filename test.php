<?php
require_once 'vendor/autoload.php';

$test = new \AppBundle\Objects\Student();

use \AppBundle\Scope;
use \AppBundle\Base\DAO\IStudentDAO;
use \AppBundle\Base\DAO\ICourseDAO;
use \AppBundle\Objects\Course;
use \AppBundle\Objects\Admin;
use \AppBundle\Base\DAO\IAdminDAO;

/** @var IStudentDAO $StudentDAO */
//$studentDAO = Scope::skeleton()->get(IStudentDAO::class);

//works
/*$student = $studentDAO->load(1);
$student->s_email = 'Moshik@gmail.com';
$studentDAO->save($student);*/

//var_dump(Scope::skeleton()->get(ICourseDAO::class)); // works

//works
/*$courseDAO = Scope::skeleton()->get(ICourseDAO::class);
$data = [
    'c_name'        => 'Course_A',
    'c_description' => 'some description',
    'c_img'         => 0];
$newCourse = new Course();
$newCourse->fromArray($data);

$courseDAO->save($newCourse);*/



/**
 * @var IAdminDAO $AdminDAO
 */
$adminDAO = Scope::skeleton()->get(IAdminDAO::class);

$admin = new Admin();
$admin->fromArray([
    '$a_name'      => 'Evgeniy',
    '$a_email'     => 'evgen@gmail.com',
    '$a_phone'     => '0528864255',
    '$a_password'  => '123',
    '$a_role'      => 1
]);
var_dump($admin);

$adminDAO->save($admin);

