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
     * @param Student $student
     */
    public function saveStudent(Student $newStudent)
    {
        $this->studentDAO->save($newStudent);
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
}