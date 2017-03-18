<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 08/12/16
 * Time: 15:06
 */

namespace AppBundle\Base\DAO;


interface ICourses_StudentsDAO
{
    /**
     * Pass the Student ID
     * @param int $id
     * @return array|null
     */
    public function getAllCoursesOfStudent($id);

    /**
     * Pass the Course ID
     * @param int $id
     * @return array|null
     */
    public function getAllStudentsOfCourse($id);

    /**
     * @param int $student_id
     * @param array $courses
     */
    public function saveCoursesOfStudent($student_id, $courses);

    /**
     * @param int $courses_id
     * @param array $students
     */
    public function saveStudentsOfCourse($courses_id, $students);

    /**
     * @param       $student_id
     * @param array $course_ids
     */
    public function deleteCoursesOfStudent($student_id, array $course_ids);
}