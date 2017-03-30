<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 31/03/17
 * Time: 01:22
 */

namespace AppBundle\Controller;

use AppBundle\Objects\Admin;
use AppBundle\Scope;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Base\DAO\IAdminService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    private $newAdmin;
    private $adminService;

    public function __construct()
    {
        $this->studentsService  = Scope::skeleton()->get(IAdminService::class);
    }

    private function checkUserRole(){
        $user = $this->getUser();

        if (isset($user->a_role))
            $role = $this->adminService->getAdminRole($user->a_role);
        else
            $role = null;

        return $role;
    }

    /**
     * @Route("/getAllAdmins", name="getAllAdmins")
     */
    public function getAllStudents(Request $request)
    {

        $qResult         = $this->adminService->getAllAdmins();
        $response        = json_encode($qResult);

        return new Response($response);
    }
}