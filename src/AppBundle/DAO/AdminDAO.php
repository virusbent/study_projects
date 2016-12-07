<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 06/12/16
 * Time: 21:01
 */

namespace AppBundle\DAO;


use AppBundle\Base\DAO\IAdminDAO;
use AppBundle\Objects\Admin;
use AppBundle\Scope;
use Squid\MySql\Impl\Connectors\MySqlAutoIncrementConnector;

class AdminDAO implements IAdminDAO
{
    const TABLE = 'admins';

    /**
     * @var MySqlAutoIncrementConnector
     */
    private $connector;

    public function __construct()
    {
        $this->connector = new MySqlAutoIncrementConnector();
        $this->connector
                ->setConnector(Scope::connector())
                ->setDomain(Admin::class)
                ->setTable(self::TABLE)
                ->setIdField('a_ID');
    }

    /**
     * @param $id
     *
     * @return Admin|null
     */
    public function load($id)
    {
        return $this->connector->load($id);
    }

    /**
     * @param Admin $admin
     *
     */
    public function save(Admin $admin)
    {
        $this->connector->save($admin);
    }
}