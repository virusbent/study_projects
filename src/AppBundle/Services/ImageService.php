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
     */
    public function saveImage($imgPath)
    {
        $this->imgDAO->save($imgPath);
    }

    /**
     * @param array $imgPath
     */
    public function updateImage($imgPath)
    {
        $this->img_id   = $imgPath[0];
        $this->img_path = $imgPath[1];
        $this->imgDAO->update($this->img_id, $this->img_path);
    }

    /**
     * @param int $id
     */
    public function deleteImage($id)
    {
        $this->imgDAO->delete($id);
    }
}