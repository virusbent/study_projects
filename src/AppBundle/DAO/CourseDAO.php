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

class CourseDao implements ICourseDAO
{
    const TABLE = 'courses';

    /**
     * @var MySqlAutoIncrementConnector
     */
    private $connector;

    public function __construct()
    {
        $this->connector = new MySqlAutoIncrementConnector();
        $this->connector
                ->setConnector(Scope::connector())
                ->setDomain(Course::class)
                ->setIdField('c_ID')
                ->setTable(self::TABLE);
    }

    /**
     * @param $id
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
}