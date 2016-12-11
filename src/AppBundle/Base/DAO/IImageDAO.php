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
     * @param int $id
     * @return string|null
     */
    public function load($id);

    /**
     * @param string $imgPath
     */
    public function save($imgPath);

    /**
     * @param int $id
     */
    public function delete($id);

    /**
     * @param string|int $id
     * @param string $path
     */
    public function update($id, $path);
}