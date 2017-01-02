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
use AppBundle\DAO\AdminRoleDAO;

// Services
use AppBundle\Services\AdminService;
use AppBundle\Services\CourseService;
use AppBundle\Services\ImageService;
use AppBundle\Services\StudentService;


$this->set(IStudentDAO::class,             StudentDAO::class);
$this->set(ICourseDAO::class,              CourseDAO::class);
$this->set(IAdminDAO::class,               AdminDAO::class);
$this->set(ICourses_StudentsDAO::class,    Courses_StudentsDAO::class);
$this->set(IImageDAO::class,               ImageDAO::class);
$this->set(IAdminRoleDAO::class,           AdminRoleDAO::class);

// Services
$this->set(IImageService::class,           ImageService::class);
$this->set(IStudentService::class,         StudentService::class);
$this->set(ICourseService::class,          CourseService::class);
$this->set(IAdminService::class,           AdminService::class);