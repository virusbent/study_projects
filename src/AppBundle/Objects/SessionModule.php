<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 01/04/17
 * Time: 19:15
 */

namespace AppBundle\Objects;

use Objection\TSingleton;
use Symfony\Component\HttpFoundation\Session\Session;


class SessionModule
{
    private $user = null;

    public function isLoggedIn()
    {
        return !((bool)$this->user);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function login()
    {
        $s = new Session();

        if (!$s->has('user_id'))
            return false;

         //$this->user = userDAO->load($s->get('user_id'));

        return $this->isLoggedIn();
    }

    public function logout()
    {
        $s = new Session();
        $s->clear();

        $this->user = null;
    }

    public function authorize($id)
    {
        $s = new Session();

        $s->set('user_id', $id);
        $this->login();
    }
}