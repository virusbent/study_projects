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
use Doctrine\DBAL\Schema\Table;

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
        // TODO: Implement getAllCoursesOfStudent() method.
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
                ->from(Table::class)
                ->where('cs_course_ID=', $id);
        return $select->queryAll();
    }
}