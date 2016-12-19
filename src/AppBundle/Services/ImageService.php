<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 11/12/16
 * Time: 11:42
 */

namespace AppBundle\Services;

use AppBundle\Base\DAO\IImageService;


/**
 * @autoload
 */
class ImageService implements IImageService
{
    /**
     * @autoload
     * @var \AppBundle\Base\DAO\IImageDAO
     */
    private $imgDAO;

    private $img_id;
    private $img_path;
    private $img_thumb;

    /**
     * @param int $id
     * @return string|null
     */
    public function getImageByID($id)
    {
        return $this->imgDAO->load($id);
    }

    /**
     * @param string $imgPath
     * @param string $thumbPath
     */
    public function saveImage($imgPath, $thumbPath)
    {
        $this->imgDAO->save($imgPath, $thumbPath);
    }

    /**
     * The array contains id, path and thumbnail path (in this order)
     * @param array $img
     */
    public function updateImage($img)
    {
        $this->img_id       = $img[0];
        $this->img_path     = $img[1];
        $this->img_thumb    = $img[2];
        $this->imgDAO->update($this->img_id, $this->img_path, $this->img_thumb);
    }

    /**
     * @param int $id
     */
    public function deleteImage($id)
    {
        $this->imgDAO->delete($id);
    }
}