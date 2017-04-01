<?php
namespace AppBundle\DAO;


use AppBundle\Base\DAO\IAdminDAO;
use AppBundle\Objects\Admin;
use AppBundle\Scope;
use Squid\MySql\Impl\Connectors\MySqlAutoIncrementConnector;


class AdminDAO implements IAdminDAO
{
    const TABLE   = 'admins';
    const ROLES   = 'roles';

    /** @var MySqlAutoIncrementConnector */
    private $connector;

    /** @var \Squid\MySql|\Squid\MySql\IMySqlConnector */
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
     * @return boolean
     */
    public function save(Admin $admin)
    {
        return $this->connector->save($admin);
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
        $role = $this->mysql->select();

        return $role
            ->from(self::ROLES)
            ->column('r_name')
            ->byField('r_ID', $id)
            ->queryScalar();
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
        $select->from(self::TABLE);
        return $select->queryCount();
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