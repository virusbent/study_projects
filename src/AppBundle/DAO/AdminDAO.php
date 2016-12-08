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
                ->setTable(self::TABLE)
                ->setDomain(Admin::class)
                ->setIdField('a_ID');
    }

    /**
     * @param int $id
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

    /**
     * @param int $id
     */
    public function delete($id)
    {
        $this->connector->delete($id);
    }

    public function getRole($id)
    {
        // TODO: Implement getRole() method.
    }
}