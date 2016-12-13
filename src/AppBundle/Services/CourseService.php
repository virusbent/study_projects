<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 13/12/16
 * Time: 22:10
 */

namespace AppBundle\Services;

use AppBundle\Base\DAO\ICourseDAO;
use AppBundle\Base\DAO\ICourses_StudentsDAO;
use AppBundle\Base\DAO\ICourseService;
use AppBundle\Objects\Course;
use AppBundle\Scope;

/**
 * @autoload
 */
class CourseService implements ICourseService
{
    /**
     * @autoload
     * @var \AppBundle\Base\DAO\ICourseDAO
     */
    private $courseDAO;

    /**
     * @autoload
     * @var \AppBundle\Base\DAO\ICourses_StudentsDAO
     */
    private $studentsOfCourseDAO;

    /**
     * @param int $id
     * @return Course|null
     */
    public function getCourseByID($id)
    {
        return $this->courseDAO->load($id);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getCourseStudents($id)
    {
        return $this->studentsOfCourseDAO->getAllStudentsOfCourse($id);
    }

    /**
     * @param Course $course
     */
    public function save(Course $course)
    {
        $this->courseDAO->save($course);
    }

    /**
     * @param Course $course
     */
    public function update(Course $course)
    {
        $this->courseDAO->update($course);
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}