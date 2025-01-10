<?php

namespace App\Controllers;

use App\Models\LoginModel;

class ShowUser extends BaseController
{
    public function index()
    {
        $session = session();
        if (!session()->isloggedin) {
            $session->setFlashdata('error', 'Please Login First!');
            return redirect()->to('login');

        }
        $loginModel = new LoginModel();

        $role = $session->role;
        $region = $session->remarks;

        if($role == "roc"){
            $users = $loginModel->where("remarks", $region)->findAll();
        }
        if($role == "finance_super_admin"){
            $users = $loginModel->where("role", "finance")->findAll();
        }
        else{
            $users = $loginModel->findAll();
        }

        // var_dump($users);
      


        $data = [
            'users' => $users
        ];

        return view('show_users', $data);
    }




}