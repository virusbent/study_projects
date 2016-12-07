<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 06/12/16
 * Time: 20:45
 */

namespace AppBundle\Objects;


use Objection\LiteObject;
use Objection\LiteSetup;

/**
 * Class Admin
 *
 * @property int    $a_ID
 * @property string $a_name
 * @property string $a_email
 * @property string $a_phone
 * @property string $a_password
 * @property int    $a_role
 */
class Admin extends LiteObject
{

    /**
     * @return array
     */
    protected function _setup()
    {
        return[
            '$a_ID'        => LiteSetup::createInt(null),
            '$a_name'      => LiteSetup::createString(),
            '$a_email'     => LiteSetup::createString(),
            '$a_phone'     => LiteSetup::createString(),
            '$a_password'  => LiteSetup::createString(),
            '$a_role'      => LiteSetup::createInt(null)
        ];
    }
}