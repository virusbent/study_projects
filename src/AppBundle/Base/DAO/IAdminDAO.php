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
 * Interface IAdminDAO
 * @package AppBundle\Base\DAO
 */
interface IAdminDAO
{
    /**
     * @param $id
     *
     * @return Admin|null
     */
    public function load($id);

    /**
     * @param $admin
     *
     */
    public function save(Admin $admin);
}