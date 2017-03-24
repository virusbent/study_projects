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
     * @param int $student_id
     * @param int $course_id
     */
    public function saveCoursesOfStudent($student_id, $course_ids)
    {
        foreach ($course_ids as $course_id){
            $row    = array($course_id, $student_id);
            $save   = $this->connector->insert();
            $save->into(self::TABLE, ['cs_course_ID', 'cs_student_ID'])
                ->values($row)->execute();
        }
    }

    /**
     * @param int $course_id
     * @param int $student_id
     */
    public function saveStudentsOfCourse($course_id, $student_ids)
    {
        foreach ($student_ids as $student_id){
            $row    = array($course_id, $student_id);
            $save   = $this->connector->insert();
            $save->into(self::TABLE, ['cs_course_ID', 'cs_student_ID'])->ignore()
                ->values($row)->execute();
        }
    }

    /**
     * @param       $student_id
     * @param array $course_ids
     */
    public function deleteCoursesOfStudent($student_id, array $course_ids)
    {
        return $this->connector->delete()
                    ->from(self::TABLE)
                    ->byField("cs_student_ID", $student_id)
                    ->byField("cs_course_ID", $course_ids)
                    ->executeDml();
    }
}