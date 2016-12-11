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
     * @autoload
     * @var \AppBundle\Base\DAO\IAdminRoleDAO
     */
    private $roleDAO;

    /**
     * @param int $id
     * @return Admin|null
     */
    public function getAdminByID($id)
    {
        return $this->adminDAO->load($id);
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function getAdminRole($id)
    {
        $role_id = $this->getAdminByID($id)->a_role;
        return $this->roleDAO->getRole($role_id);
    }

    /**
     * @param Admin $admin
     */
    public function save(Admin $admin)
    {
        $this->adminDAO->save($admin);
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
}