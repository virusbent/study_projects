<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 05/12/16
 * Time: 21:31
 */

namespace AppBundle\Base\DAO;
use AppBundle\Objects\Student;

/**
 * @skeleton
 */
interface IStudentDAO
{
    /**
     * @param  int $id
     * @return Student|null
     */
    public function load($id);

    /**
     * @param Student $student
     */
    public function save(Student $student);

    /**
     * @param int $id
     */
    public function delete($id);
}