<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 05/12/16
 * Time: 22:15
 */

namespace AppBundle\DAO;

use AppBundle\Base\DAO\IStudentDAO;
use AppBundle\Objects\Student;
use AppBundle\Scope;
use Squid\MySql\Impl\Connectors\MySqlAutoIncrementConnector;

class StudentDAO implements IStudentDAO
{
    const TABLE = 'students';

    /** @var  MySqlAutoIncrementConnector */
    private $connector;

    private $mysql;

    public function __construct()
    {
        $this->mysql     = Scope::connector();
        $this->connector = new MySqlAutoIncrementConnector();
        $this->connector
             ->setConnector(Scope::connector())
             ->setTable(self::TABLE)
             ->setDomain(Student::class)
             ->setIdField('s_ID');
    }

    /**
     * @param  int $id
     * @return Student|null
     */
    public function load($id)
    {
        return $this->connector->load($id);
    }

    /**
     * @param Student $student
     */
    public function save(Student $student)
    {
        $this->connector->save($student);
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        $this->connector->delete($id);
    }

    /**
     * @return int
     */
    public function countAll()
    {
        $select = $this->mysql->select();
        $select->column('s_ID')
                ->from(self::TABLE);
        $result = $select->queryCount();
        return $result;
    }

    /**
     * @param Student $modifiedStudent
     */
    public function update(Student $modifiedStudent)
    {
        $this->connector->update($modifiedStudent);
    }

    /**
     * @return array|null
     */
    public function loadAll()
    {
        $select = $this->mysql->select();
        return $select->from(self::TABLE)->queryAll(true);
    }
}