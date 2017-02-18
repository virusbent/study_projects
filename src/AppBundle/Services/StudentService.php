<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 10/12/16
 * Time: 18:37
 */

namespace AppBundle\Services;

use AppBundle\Base\DAO\ICourses_StudentsDAO;
use AppBundle\Base\DAO\IStudentDAO;
use AppBundle\Base\DAO\ICourseDAO;
use AppBundle\Objects\Course;
use AppBundle\Scope;
use AppBundle\Base\DAO\IStudentService;
use AppBundle\Objects\Student;

/**
 * @autoload
 */
class StudentService implements IStudentService
{
    /**
     * @autoload
     * @var \AppBundle\Base\DAO\IStudentDAO
     */
    private $studentDAO;

    /**
     * @autoload
     * @var \AppBundle\Base\DAO\ICourseDAO
     */
    private $courseDAO;

    /**
     * @autoload
     * @var \AppBundle\Base\DAO\ICourses_StudentsDAO
     */
    private $coursesOfStudentDAO;

    /**
     * Returns the total amount of Students.
     * @return int|null
     */
    public function getNumberOfStudents()
    {
        return $this->studentDAO->countAll();
    }

    /**
     * @param   int $id
     * @return  Student|null
     */
    public function getStudentByID($id)
    {
        return $this->studentDAO->load($id);
    }

    /**
     * Returns an array of Course_id's that THE Student is registered to.
     * @param   int $id
     * @return  array|null
     */
    public function getStudentCourses($id)
    {
        return $this->coursesOfStudentDAO->getAllCoursesOfStudent($id);

    }

    /**
     * Saves new Student and return generated id by mysql
     * @param Student $student
     * return int $s_id
     */
    public function saveStudent(Student $newStudent)
    {
        return $this->studentDAO->save($newStudent);
    }

    /**
     * @param int $id
     */
    public function deleteStudent($id)
    {
        $this->studentDAO->delete($id);
    }

    /**
     * @param Student $student
     */
    public function updateStudent(Student $student)
    {
        $this->studentDAO->update($student);
    }

    /**
     * @return array|null
     */
    public function getAllStudents()
    {
        return $this->studentDAO->loadAll();
    }

    /**
     * $courses is an array of courses ids.
     * @param int   $id
     * @param array $courses
     */
    public function saveStudentCourses($id, $courses)
    {
        foreach ($courses as $key => $course_id){
            $this->coursesOfStudentDAO->saveCoursesOfStudent($id, $course_id);
        }
    }

    /**
     * @param $id
     * @param $newCourses
     */
    public function updateStudentCourses($id, $newCourses)
    {
        $oldCourses     = $this->coursesOfStudentDAO->getAllCoursesOfStudent($id);
        $oldCourses     = Course::allToArray($oldCourses);
        $coursesToSave  = array_diff($newCourses, $oldCourses);
        $this->coursesOfStudentDAO->saveCoursesOfStudent($id, $newCourses);
    }
}