<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 05/12/16
 * Time: 21:20
 */

namespace AppBundle\Objects;


use Objection\LiteObject;
use Objection\LiteSetup;


/**
 * @property int    $s_ID
 * @property string $s_name
 * @property string $s_email
 * */
class Student extends LiteObject
{
    /**
     * @return array
     */
    protected function _setup()
    {
        return[
            's_ID'    => LiteSetup::createInt(null),
            's_name'  => LiteSetup::createString(),
            's_email' => LiteSetup::createString()
        ];
    }
}