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

    public function __construct()
    {
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
}