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
use AppBundle\Objects\Student;
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
     * @return array|null
     */
    public function getAllCourses()
    {
        return $this->courseDAO->loadAll();
    }

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
        return $course->c_ID;
    }

    /**
     * $students is an array of student ids.
     * @param int   $id
     * @param array $students
     */
    public function saveCourseStudents($id, $students)
    {
        $this->studentsOfCourseDAO->saveStudentsOfCourse($id, $students);
    }

    /**
     * @param Course $course
     */
    public function update(Course $course)
    {
        $this->courseDAO->update($course);
    }

    /**
     * @param $id
     * @param $newStudents
     */
    public function updateCourseStudents($id, $newStudents)
    {
        $oldStudents     = $this->studentsOfCourseDAO->getAllCoursesOfStudent($id);
        //$oldStudents     = Student::allToArray($oldStudents);
        $studentsToSave  = array_diff($newStudents, $oldStudents);
        $studentsToDelete = array_diff($oldStudents, $newStudents);

        if ($studentsToSave)
            $this->studentsOfCourseDAO->saveStudentsOfCourse($id, $studentsToSave);
        if ($studentsToDelete){
            // deleteCoursesOfStudent = deleteStudentsOfCourse      !!! same function !!!
            $this->studentsOfCourseDAO->deleteCoursesOfStudent($id, $studentsToDelete);
        }
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        $this->courseDAO->delete($id);
    }
}