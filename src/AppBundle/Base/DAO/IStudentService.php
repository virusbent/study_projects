<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 10/12/16
 * Time: 18:24
 */

namespace AppBundle\Base\DAO;

use AppBundle\Objects\Student;

interface IStudentService
{
    /**
     * Returns the total amount of Students.
     * @return int|null
     */
    public function getNumberOfStudents();

    /**
     * @return array|null
     */
    public function getAllStudents();

    /**
     * @param   int          $id
     * @return  Student|null
     */
    public function getStudentByID($id);

    /**
     * Returns an array of Courses that THE Student is registered to.
     * @param   int          $id
     * @return  array|null
     */
    public function getStudentCourses($id);

    /**
     * @param Student $student
     */
    public function saveStudent(Student $student);

    /**
     * @param int $id
     */
    public function deleteStudent($id);

    /**
     * @param Student $student
     */
    public function updateStudent(Student $student);
}