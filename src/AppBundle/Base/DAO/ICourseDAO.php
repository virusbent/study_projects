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
     * @return array|null
     */
    public function loadAll();

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
     * @return bool
     */
    public function delete($id);
}