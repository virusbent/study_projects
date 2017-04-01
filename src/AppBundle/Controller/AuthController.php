<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Base\DAO\IAdminService;
use AppBundle\Scope;
use AppBundle\Objects\Admin;

class AuthController extends Controller
{
    /**
     * @Route("/login", name="authpage")
     */
    public function login(Request $request)
    {
        return $this->render('login/login.html.twig');

    }

    /**
     * @Route("/loginAction", name="login")
     */
    public function loginAction(Request $request){
        $email      = $request->get('email');
        $password   = $request->get('password');

        $adminService  = Scope::skeleton()->get(IAdminService::class);

        $admin = $adminService->get();
    }

    /**
     * @Route("/logoutAction", name="logout")
     */
    public function logoutAction()
    {
        /*\SessionModule::instance()->logout();*/
    }
}
