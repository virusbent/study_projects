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
     * @return array|null
     */
    public function loadAll();

    /**
     * @param Admin $admin
     * @return boolean
     */
    public function save(Admin $admin);

    /**
     * @param Admin $admin
     */
    public function update(Admin $admin);

    /**
     * @param int $id
     */
    public function delete($id);

    /**
     * @return integer $adminCount
     */
    public function count();

    /**
     * @param int $role_id
     *
     * @return string|null
     */
    public function getRole($role_id);

    /**
     * @param integer $target_id
     * @param string $role
     * @return boolean
     */
    public function updateRole($target_id, $role);
}