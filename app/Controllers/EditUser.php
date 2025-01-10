<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
date_default_timezone_set('Asia/Jakarta');

class EditUser extends BaseController
{
    public function index()
    {
        $roleModel = new RoleModel();

        $model = new UserModel();
        $db = db_connect();
        $fields = $db->getFieldNames('userdata');
        $array = array();
        foreach ($fields as $field) {
            $array[$field] = NULL;
        }

        $id = $this->request->getPost("id");
        $data["user"] = $model->get_data($id);
        $data['row'] = $array;
        $data['roles'] = $roleModel->getAllData();
        $header['title'] = 'Dashboard';
        return view('edit_user', $data);
    }

    public function edit()
    {
        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->getAllData();
        $request = \Config\Services::request();
        foreach ($_POST as $key => $value) {
            ${$key} = $request->getPost($key);
        }

        if (isset($password)) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            if ($role == "super_admin") {
                $password_expiry = date('Y-m-d', strtotime("+60 days"));
            } else {
                $password_expiry = date('Y-m-d', strtotime("+90 days"));
            }

            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);

        }

        $userModel = new UserModel;

        if (isset($update) && ($update = "true")) {
            if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $data['message'] = "Your password must contain Upper case Lower case and number, minimum length 8 ";
          } else {
                $data["user"] = $userModel->get_data($id);
                $roleModel = new RoleModel();
                $data['roles'] = $roleModel->getAllData();
                $data['message'] = $userModel->update_user($id, $name, $email, $role, $username, $password_hashed, $password_expiry);
            }
        } elseif (isset($insert) && ($insert = "true")) {
            if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $data['message'] = "Your password must contain Upper case Lower case and number, minimum length 8 ";
            } else {

                $check = $userModel->check_user($username);
                if ($check == true) {
                    $data['message'] = "This username has been used. Please enter another username ";
					 $roleModel = new RoleModel();
                $data['roles'] = $roleModel->getAllData();
                } else {
                    $data['message'] = $userModel->insert_user($name, $email, $role, $username, $password_hashed, $password_expiry);
					 $roleModel = new RoleModel();
					$data['roles'] = $roleModel->getAllData();
                    $id = $userModel->get_id($username);

                }

            }
        } elseif (isset($delete) && ($delete = "true")) {

            $data['message'] = $userModel->delete_user($id, $name, $email, $role, $username);
            return redirect()->to(base_url('ShowUser'));
        }

        elseif(isset($reset) && ($reset = "true"))    
        {
            $userModel->reset_secret_key($username);
            $data['message'] ="The secret key has been successfully reset";    
			 $roleModel = new RoleModel();
                $data['roles'] = $roleModel->getAllData();
            $no = $userModel->get_no($username);
        }



        if (isset($id) && ($id != "")) {
            $data["user"] = $userModel->get_data($id);
            return view('edit_user', $data);
        } else {
            return redirect()->to('show_user');
        }
    }


    public function delete()
    {
        $model = new UserModel();
        $id = $this->request->getPost('id');

        // Delete user
        $model->delete($id);

        return redirect()->to('show_user');
    }
  

}