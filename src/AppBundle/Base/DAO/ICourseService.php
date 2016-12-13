<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 13/12/16
 * Time: 21:57
 */

namespace AppBundle\Base\DAO;


use AppBundle\Objects\Course;

interface ICourseService
{
    /**
     * @param int $id
     * @return Course|null
     */
    public function getCourseByID($id);

    /**
     * @param int $id
     * @return array|null
     */
    public function getCourseStudents($id);

    /**
     * @param Course $course
     */
    public function save(Course $course);

    /**
     * @param Course $course
     */
    public function update(Course $course);

    /**
     * @param int $id
     */
    public function delete($id);
}