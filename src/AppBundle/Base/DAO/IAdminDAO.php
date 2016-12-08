<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 06/12/16
 * Time: 20:41
 */

namespace AppBundle\Base\DAO;
use AppBundle\Objects\Admin;

/**
 * @skeleton
 */
interface IAdminDAO
{
    /**
     * @param int $id
     *
     * @return Admin|null
     */
    public function load($id);

    /**
     * @param Admin $admin
     */
    public function save(Admin $admin);

    /**
     * @param int $id
     */
    public function delete($id);

    /**
     * @param int $id
     *
     * @return string|null
     */
    public function getRole($id);
}