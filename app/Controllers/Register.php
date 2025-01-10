<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function Index()
    {
        return view('register');
    }

    public function regist()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|valid_email',
                'username' => 'required',
                'password' => 'required',
                'password2' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $model = new UserModel();
                $email = $this->request->getPost('email');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $authority = 0;
                $enable = 0;
                $model->regist($username, $username, $password, $email, $authority, $enable);
                return redirect()->to('login');
            } else {
                $data['error'] = $this->validator->getErrors();
            }
            return view('register', $data);
        }
    }


}