<?php
namespace AppBundle\Base\DAO;
/**
 * @var \Skeleton\Base\IBoneConstructor $this
 */

use AppBundle\DAO\AdminDAO;
use AppBundle\DAO\CourseDAO;
use AppBundle\DAO\StudentDAO;

$this->set(IStudentDAO::class,             StudentDAO::class);
$this->set(ICourseDAO::class,              CourseDao::class);
$this->set(IAdminDAO::class,               AdminDAO::class);
//$this->set(ICourses_StudentsDAO::class,    Courses_StudentsDAO::class);