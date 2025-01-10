<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class CreateUser extends BaseController
{

    public function index()
    {
        $roleModel = new RoleModel();
        $roles = $roleModel->getAllData();
        

        if ($this->request->getMethod() === 'post') {
            // Validate the form data
            $validationRules = [
                'name' => 'required',
                'email' => 'required|valid_email',
                'username' => 'required',
                'role' => 'required'
            ];

            if ($this->validate($validationRules)) {
             
                $default_pass = "Default_1";
                $password_expiry = date('Y-m-d', strtotime("+90 days"));
                // Create a new user record
                $userModel = new \App\Models\UserModel();
                $userModel->createUser(
                    $this->request->getPost('name'),
                    $this->request->getPost('email'),
                    $this->request->getPost('username'),
                    $this->request->getPost('role'),
                    password_hash($default_pass, PASSWORD_DEFAULT),
                    0,
                    $password_expiry,
                    $this->request->getPost('remarks')
                );

                return redirect()->to('ShowUser');
            }
        }

   

        return view('create_user', ['roles' => $roles]);

    }

  


}