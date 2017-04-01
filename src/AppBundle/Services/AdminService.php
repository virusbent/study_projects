<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 11/12/16
 * Time: 22:16
 */

namespace AppBundle\Services;

use AppBundle\Base\DAO\IAdminDAO;
use AppBundle\Base\DAO\IAdminRoleDAO;
use AppBundle\Base\DAO\IAdminService;
use AppBundle\Objects\Admin;

/**
 * @autoload
 */
class AdminService implements IAdminService
{
    /**
     * @autoload
     * @var \AppBundle\Base\DAO\IAdminDAO
     */
    private $adminDAO;


    /**
     * @param int $id
     * @return Admin|null
     */
    public function getAdminByID($id)
    {
        return $this->adminDAO->load($id);
    }

    /**
     * @param int $role_id
     * @return string|null
     */
    public function getAdminRole($role_id)
    {
        return $this->adminDAO->getRole($role_id);
    }

    /**
     * @param Admin $admin
     * @return boolean
     */
    public function save(Admin $admin)
    {
        return $this->adminDAO->save($admin);
    }

    /**
     * @param Admin $admin
     */
    public function update(Admin $admin)
    {
        $this->adminDAO->update($admin);
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        $this->adminDAO->delete($id);
    }

    /**
     * Returns the total amount of Administrators.
     * @return int|null
     */
    public function countAllAdmins()
    {
        return $this->adminDAO->count();
    }

    /**
     * Only "owner" can update Roles
     * @param string $role
     * @return boolean
     */
    public function updateRole($role)
    {
        //TODO: find a way to implement this function in a right way.
    }

    /**
     * @return array|null
     */
    public function getAllAdmins()
    {
        return $this->adminDAO->loadAll();
    }
}