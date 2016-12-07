<?php
namespace AppBundle\Base\DAO;
/**
 * @var \Skeleton\Base\IBoneConstructor $this
 */

use AppBundle\DAO\CourseDAO;
use AppBundle\DAO\StudentDAO;
use AppBundle\Objects\Admin;

$this->set(IStudentDAO::class,  StudentDAO::class);
$this->set(ICourseDAO::class,   CourseDao::class);
$this->set(IAdminDAO::class,    Admin::class);