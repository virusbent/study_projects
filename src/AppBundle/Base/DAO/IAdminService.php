<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 11/12/16
 * Time: 22:17
 */

namespace AppBundle\Base\DAO;


use AppBundle\Objects\Admin;

interface IAdminService
{
    /**
     * Returns the total amount of Administrators.
     * @return int|null
     */
    public function countAllAdmins();

    /**
     * @param int $id
     * @return Admin|null
     */
    public function getAdminByID($id);

    /**
     * @param integer $role_id
     * @return string|null
     */
    public function getAdminRole($role_id);

    /**
     * @param Admin $admin
     */
    public function save(Admin $admin);

    /**
     * @param Admin $admin
     */
    public function update(Admin $admin);

    /**
     * @param string $role
     * @return boolean
     */
    public function updateRole($role);

    /**
     * @param int $id
     */
    public function delete($id);
}