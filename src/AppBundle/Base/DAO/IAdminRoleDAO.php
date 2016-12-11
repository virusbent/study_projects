<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 11/12/16
 * Time: 19:31
 */

namespace AppBundle\Base\DAO;


interface IAdminRoleDAO
{
    /**
     * @param int $id
     * @return string
     */
    public function getRole($id);
}