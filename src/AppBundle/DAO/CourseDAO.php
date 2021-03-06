<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 06/12/16
 * Time: 15:12
 */

namespace AppBundle\DAO;


use AppBundle\Base\DAO\ICourseDAO;
use AppBundle\Objects\Course;
use AppBundle\Scope;
use Squid\MySql\Impl\Connectors\MySqlAutoIncrementConnector;

class CourseDAO implements ICourseDAO
{
    const TABLE = 'courses';

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
                ->setDomain(Course::class)
                ->setIdField('c_ID')
                ->setTable(self::TABLE);
    }

    /**
     * @param int $id
     *
     * @return Course|null
     */
    public function load($id)
    {
        return $this->connector->load($id);
    }

    /**
     * @param Course $course
     */
    public function save(Course $course)
    {
        $this->connector->save($course);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->connector->delete($id);
    }

    /**
     * @param Course $course
     */
    public function update(Course $course)
    {
        $this->connector->update($course);
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