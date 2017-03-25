<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 09/12/16
 * Time: 12:54
 */

namespace AppBundle\Base\DAO;


interface IImageDAO
{
    /**
     * @return array $allImages
     */
    public function loadAll();

    /**
     * @param int $id
     * @return string|null
     */
    public function load($id);

    /**
     * @param string $imgPath
     * @param string $thumbPath
     */
    public function save($imgPath, $thumbPath);

    /**
     * @param int $id
     * @return $delete
     */
    public function delete($id);

    /**
     * @param string|int $id
     * @param string $path
     * @param string $thumbPath
     */
    public function update($id, $path, $thumbPath);
}