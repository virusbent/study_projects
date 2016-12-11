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
    private $img_id;

    public function __construct()
    {
        $this->connector = Scope::connector();
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function load($id)
    {
        $select = $this->connector->select();
        $select->column()
            ->from(self::TABLE)
            ->byField('i_ID', $id);
        $result = $select->queryRow();
        return $result;
    }

    /**
     * @param string $imgPath
     */
    public function save($imgPath)
    {
        $save = $this->connector->insert();
        $save->into(self::TABLE, ['i_path'])
                ->values($imgPath)->execute();
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        $delete = $this->connector->delete();
        $delete->from(self::TABLE)
                ->byField('i_ID', $id)
                ->execute();
    }

    /**
     * @param int|string $id
     * @param string     $path
     */
    public function update($id, $path)
    {
        // TODO: Implement update() method.
        $update = $this->connector->update();
        $update->table(self::TABLE)
                ->byField('i_ID', $id)
                ->set('i_path', $path)
                ->execute();
    }
}