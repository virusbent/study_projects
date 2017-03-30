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
use Symfony\Component\Security\Core\Role\Role;

class AdminDAO implements IAdminDAO
{
    const TABLE   = 'admins';
    const ROLES   = 'roles';

    /**
     * @var MySqlAutoIncrementConnector
     */
    private $connector;

    private $mysql;

    public function __construct()
    {
        $this->mysql     = Scope::connector();
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
        //TODO: fix this. the query is probably wrong.
        $select = $this->connector->select();
        $select->column()
            ->select('r_name')
            ->from(self::ROLES)
            ->byField('r_ID', $id);
        $response = $select->execute();
        return $response;
    }

    /**
     * @param Admin $admin
     */
    public function update(Admin $admin)
    {
        $this->connector->update($admin);
    }

    /**
     * @return array|null
     */
    public function loadAll()
    {
        $select = $this->mysql->select();
        return $select->from(self::TABLE)->queryAll(true);
    }

    /**
     * @return integer $adminCount
     */
    public function count()
    {
        $select = $this->mysql->select();
        $select->column('a_ID')
            ->from(self::TABLE);

        $result = $select->queryCount();
        return $result;
    }

    /**
     * @param $target
     * @param string $role
     * @return boolean
     */
    public function updateRole($target, $role)
    {

    }
}