<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 06/12/16
 * Time: 14:56
 */

namespace AppBundle\Base\DAO;

use AppBundle\Objects\Course;

/**
 * Interface ICourseDAO
 * @package AppBundle\Base\DAO
 * @skeleton
 */
interface ICourseDAO
{
    /**
     * @param int $id
     *
     * @return Course|null
     */
    public function load($id);

    /**
     * @param Course $course
     */
    public function save(Course $course);

    /**
     * @param int $id
     */
    public function delete($id);
}