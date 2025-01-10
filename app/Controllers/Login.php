<?php

namespace App\Controllers;

use App\Models\LoginModel;


class Login extends BaseController
{
    public function index()
    {
        $data = [];
        if ($this->request->getMethod() === 'post') {
            // Validate the form data
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if ($this->validate($rules)) {

                $model = new LoginModel();

                $username = $this->request->getPost('username');
                $user_pass = $this->request->getPost('password');
                $rows = $model->where('username', $username)->findAll();
                $request = \Config\Services::request();

                $activity = "attempt login from IP = ".$request->getIPAddress();
                // echo $activity;
         
              
                $session = session();
                if (!empty($rows)) {
                    $row = $rows[0];
                    $password = $row["password"];
                    $role = $row["role"];
                    $name = $row["name"];
                    $email = $row["email"];
                    $failed_attempt = $row["failed_attempt"];
                    $password_expiry = strtotime($row["password_expiry"]);
                
                    $today = strtotime('today');

                    if ($failed_attempt < 3) {

                        if (password_verify($user_pass, $password)) {


                            if ($user_pass == "Default_1") {
								  $user = $model->login($username, $password);
                                $activity = "Login Failed, Password Expire by ".$row["password_expiry"];
                             
    
                                $session->setFlashdata('error', 'Your password has been reset to standard Password, Please change to new password now!');
                                return redirect()->to('ResetPassword');

                            } else {

                                $user = $model->login($username, $password);
                                

                                if ($user) {
                                    $use_otp = false;

                                    if($use_otp == true)
                                    {
                                        //use-otp
                                        $userdata = [
                                
                                            'username'  =>$user['username'],
                                            'email'     => $email,
                                            'role'     => $role,
                                            'name'     => $name,
											'remarks' => $user['remarks'],
                                            'loggedin_time' => time()
                                        ];

                                        $session->set($userdata); 
                
                                        return redirect()->to('/verify_totp');
                                    }
                                    else
                                    {
                                        $activity = "Login success";
                                    
                                      
                                            $session->set('username', $user['username']);
                                            $session->set('name', $user['name']);
                                            $session->set('password', $user['password']);
                                            $session->set('role', $user['role']);
                                            $session->set('remarks', $user['remarks']);

                                            $session->set('isloggedin', true);
                                            return redirect()->to('welcome');
                                        
                                    }
                                   

                                } else {
                                    $session->setFlashdata('error', 'Invalid Username and Password');
                                }
                            }

                        } else {

                            $failed_attempt = $failed_attempt + 1;
                            $remain_attempt = 3 - $failed_attempt;
                            $model->set_failed_attempt($username, $failed_attempt);

                            $activity = 'Login Failed, Wrong Password , '.$remain_attempt.' remaining attempts';
                            $session->setFlashdata('error', 'Login Failed, Wrong Password , you have ' . $remain_attempt . ' remaining attempts');
                            return redirect()->to('login');
                        }

                    } else {
                        $activity = 'Login Failed, reach maximum login attemps';	

                        $session->setFlashdata('error', 'You have reach maximum login attemps, your account is locked, contact Admin to recover access');
                        return redirect()->to('login');
                    }

                } else {
                    $session->setFlashdata('error', 'Login Failed, User not found');
                    return redirect()->to('login');
                }

            } else {
                $data['error'] = $this->validator->getErrors();
            }


        }

        return view('login', $data);
    }

    public function getLogout()
    {
        $role = session()->get('role');
		$username = session()->get('username');
		$email =  session()->get('email');
		$activity = "Logout";

        session()->destroy();

        return redirect()->to('login');

    }
}