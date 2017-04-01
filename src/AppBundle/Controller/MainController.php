<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Objects\SessionModule;

class MainController extends Controller
{
    public function __construct()
    {
        /*if (!\SessionModule::instance()->isLoggedIn())
        {
            echo ""; die;
        }*/
        /*if (!SessionModule::instance()->isLoggedIn())
        {
            echo ""; die;
        }*/
    }

    /**
     * @Route("/school", name="school_page")
     */
    public function mainAction(Request $request)
    {
        return $this->render('school/school.html.twig');
    }

    /**
     * @Route("/admin", name="admin_page")
     */
    public function AdminRoute(Request $request)
    {
        return $this->render('administration/administration.html.twig');
    }


}
