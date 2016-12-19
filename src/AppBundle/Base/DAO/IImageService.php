<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 11/12/16
 * Time: 11:46
 */

namespace AppBundle\Base\DAO;


interface IImageService
{
    /**
     * @param int $id
     * @return string|null
     */
    public function getImageByID($id);

    /**
     * @param string $imgPath
     * @param string $thumbPath
     */
    public function saveImage($imgPath, $thumbPath);

    /**
     * The array contains id, path and thumbnail path (in this order)
     * @param array $img
     */
    public function updateImage($img);

    /**
     * @param int $id
     */
    public function deleteImage($id);
}