<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 08/12/16
 * Time: 15:12
 */

namespace AppBundle\DAO;
use AppBundle\Base\DAO\ICourses_StudentsDAO;
use AppBundle\Scope;
//use Doctrine\DBAL\Schema\Table; // <- delete this

class Courses_StudentsDAO implements ICourses_StudentsDAO
{
    const TABLE = 'courses_students';

    private $connector;

    public function __construct()
    {
        $this->connector = Scope::connector();
    }

    /**
     * Pass the Student ID
     * @param int $id
     * @return array|null
     */
    public function getAllCoursesOfStudent($id)
    {
        $select = $this->connector->select();
        $select->column('cs_course_ID')
            ->from(self::TABLE)
            ->byField('cs_student_ID', $id);
        $result = $select->queryColumn();
        return $result;
    }

    /**
     * Pass the Course ID
     * @param int $id
     * @return array|null
     */
    public function getAllStudentsOfCourse($id)
    {
        $select = $this->connector->select();
        $select->column('cs_student_ID')
                ->from(self::TABLE)
                ->byField('cs_course_ID', $id);
        $result = $select->queryColumn();
        return $result;
    }

    /**
     * @param int   $student_id
     * @param array $courses
     */
    public function saveCoursesOfStudent($student_id, $course_id)
    {
        $row    = array($course_id, $student_id);
        $save   = $this->connector->insert();
        $save->into(self::TABLE, ['cs_course_ID', 'cs_student_ID'])
             ->values($row)->execute();
    }

    /**
     * @param int   $courses_id
     * @param array $students
     */
    public function saveStudentsOfCourse($courses_id, $students)
    {
        // TODO: Implement saveStudentsOfCourse() method.
    }
}