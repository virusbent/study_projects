<?php
namespace AppBundle\Base\DAO;
/**
 * @var \Skeleton\Base\IBoneConstructor $this
 */

use AppBundle\DAO\AdminDAO;
use AppBundle\DAO\CourseDAO;
use AppBundle\DAO\StudentDAO;
use AppBundle\DAO\Courses_StudentsDAO;
use AppBundle\DAO\ImageDAO;
use AppBundle\DAO\StudentService; //TODO: move this file from DAO to Services.

$this->set(IStudentDAO::class,             StudentDAO::class);
$this->set(ICourseDAO::class,              CourseDao::class);
$this->set(IAdminDAO::class,               AdminDAO::class);
$this->set(ICourses_StudentsDAO::class,    Courses_StudentsDAO::class);
$this->set(IImageDAO::class,               ImageDAO::class);
$this->set(IStudentService::class,         StudentService::class);