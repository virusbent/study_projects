<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 06/12/16
 * Time: 15:00
 */

namespace AppBundle\Objects;


use Objection\LiteObject;
use Objection\LiteSetup;

/**
 * Class Course
 *
 * @property int    $c_ID
 * @property string $c_name
 * @property string $c_description
 * @property int    $c_img
 */
class Course extends LiteObject
{

    /**
     * @return array
     */
    protected function _setup()
    {
        return [
            'c_ID'          => LiteSetup::createInt(null),
            'c_name'        => LiteSetup::createString(),
            'c_description' => LiteSetup::createString(),
            'c_img'         => LiteSetup::createInt(null)
        ];
    }
}