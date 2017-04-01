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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AdminController extends Controller
{
    private $newAdmin;

    /** @var IAdminService */
    private $adminService;

    public function __construct()
    {
        /*if (!\SessionModule::instance()->isLoggedIn())
        {
            echo ""; die;
        }*/

        $this->adminService  = Scope::skeleton()->get(IAdminService::class);
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
    public function getAllAdmins(Request $request)
    {
        $qResult = $this->adminService->getAllAdmins();

        return new JsonResponse($qResult);
    }

    /**
     * @Route("/getAdminRole/{role_id}", name="admin_role")
     */
    public function getAdminRole($role_id)
    {

        $role = $this->adminService->getAdminRole($role_id);
        return new Response($role);
    }

    /**
     * @Route("/createAdmin", name="create_admin")
     */
    public function createAdmin(Request $request)
    {
        /* old_pass = password
         * new_pass = confirm password
         */
        $password = $request->get('old_pass');

        $admin = new Admin();

        $admin->a_name = $request->get('name');
        $admin->a_email= $request->get('email');
        $admin->a_phone= $request->get('phone');
        $admin->a_role = $request->get('role');


        if ($password === $request->get('new_pass'))
            $admin->a_password = password_hash($password, PASSWORD_BCRYPT);
        else
            return new JsonResponse("password_mismatch");


        $isSaved = $this->adminService->save($admin);

        return new JsonResponse($isSaved);

    }

    /**
     * @Route("/updateAdmin", name="update_admin")
     */
    public function updateAdmin(Request $request)
    {

        $admin    = $this->adminService->getAdminByID($request->get('id'));
        $adminArr = $admin->toArray();

        $password       = $request->get('old_pass');
        $new_password   = $request->get('new_pass');

        /* if new password was entered then insert it instead of the old password */
        if(!empty($new_password)){

            if (password_verify($password, $admin->a_password)){

                $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
            }
            else{
                return new JsonResponse(null);
            }
        }

        /* if new password was hashed successfully save it */
        if(isset($new_password_hash))
            $passwordReady = $new_password_hash;
        else if(!empty($password))
            $passwordReady = $password;
        else
            $passwordReady = $admin->a_password;


        /* Prepare Admin for update */
            $updatedAdmin = [
            'a_ID'       => $request->get('id'),
            'a_name'     => $request->get('name'),
            'a_email'    => $request->get('email'),
            'a_phone'    => $request->get('phone'),
            'a_password' => $passwordReady,
            'a_role'     => $request->get('role')
        ];

        /* check if there is differences between the data */
        $diff     = array_diff($updatedAdmin, $adminArr);

        /* if changes were made - update the admin */
        if(count($diff) > 0){
            $adminLight = new Admin();

            $adminLight->fromArray($updatedAdmin);
            $this->adminService->update($adminLight);

            return new JsonResponse($updatedAdmin);
        }
        else{
            return new JsonResponse("update_not_needed");
        }




    }


}