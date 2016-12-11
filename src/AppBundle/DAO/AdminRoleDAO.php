<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 11/12/16
 * Time: 19:34
 */

namespace AppBundle\DAO;

use AppBundle\Base\DAO\IAdminRoleDAO;
use AppBundle\Scope;

class AdminRoleDAO implements IAdminRoleDAO
{
    const TABLE = 'roles';

    private $connector;

    public function __construct()
    {
        $this->connector = Scope::connector();
    }

    /**
     * @param int $id
     * @return string
     */
    public function getRole($id)
    {
        //TODO: fix this. the query is probably wrong.
        $select = $this->connector->select();
        $select->column()
                ->from(self::TABLE)
                ->byField('r_ID', $id);
        $response = $select->queryRow();
        $role     = $response[1];
        return $role;
    }
}