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
     */
    public function saveImage($imgPath);

    /**
     * @param string $imgPath
     */
    public function updateImage($imgPath);

    /**
     * @param int $id
     */
    public function deleteImage($id);
}