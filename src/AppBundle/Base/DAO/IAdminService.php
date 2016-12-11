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
     * @param int $id
     * @return Admin|null
     */
    public function getAdminByID($id);

    /**
     * @param int $id
     * @return string|null
     */
    public function getAdminRole($id);

    /**
     * @param Admin $admin
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
}