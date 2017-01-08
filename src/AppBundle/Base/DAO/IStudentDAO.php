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
     * @return array|null
     */
    public function loadAll();

    /**
     * @param Student $student
     * return int $s_id
     */
    public function save(Student $student);

    /**
     * @param int $id
     */
    public function delete($id);

    /**
     * @param Student $modifiedStudent
     */
    public function update(Student $modifiedStudent);

    /**
     * @return int
     */
    public function countAll();
}