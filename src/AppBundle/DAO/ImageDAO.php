<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 09/12/16
 * Time: 12:58
 */

namespace AppBundle\DAO;

use AppBundle\Base\DAO\IImageDAO;
use AppBundle\Scope;

class ImageDAO implements IImageDAO
{
    const TABLE = 'images';

    private $connector;

    public function __construct()
    {
        $this->connector = Scope::connector();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function load($id)
    {
        $select = $this->connector->select();
        $select->column()
            ->from(self::TABLE)
            ->byField('i_ID', $id);
        $result = $select->query();
        return $result;
    }

    /**
     * @param int $imgPath
     */
    public function save($imgPath)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }}