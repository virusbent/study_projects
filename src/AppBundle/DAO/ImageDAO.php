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
     * @return int $i_id
     */
    public function save($imgPath, $thumbPath)
    {
        $imgData = array($imgPath, $thumbPath);
        $save = $this->connector->insert();
        $save->into(self::TABLE, ['i_path', 'i_thumb'])
                ->values($imgData)->execute();
        $i_id = $this->connector->controller()->lastId();
        return $i_id;
    }

    /**
     * @param int $id
     * @return $delete
     */
    public function delete($id)
    {
        $delete = $this->connector->delete();
        $delete->from(self::TABLE)
                ->byField('i_ID', $id)
                ->execute();
        return $delete;
    }

    /**
     * @param int|string $id
     * @param string $path
     */
    public function update($id, $path, $thumbPath)
    {
        // TODO: Implement update() method.
        $update = $this->connector->update();
        $update->table(self::TABLE)
                ->byField('i_ID', $id)
                ->set('i_path', $path)
                ->set('i_thumb', $thumbPath)
                ->execute();
    }
}