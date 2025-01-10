<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\LogbookModel;

class ResetPassword extends BaseController
{
    public function index()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $new_password1 = $this->request->getPost('new_password1');
            $new_password2 = $this->request->getPost('new_password2');
			
            if ($new_password1 == $new_password2) {
                if ($new_password1 != $password) {

                    $uppercase = preg_match('@[A-Z]@', $new_password1);
                    $lowercase = preg_match('@[a-z]@', $new_password1);
                    $number = preg_match('@[0-9]@', $new_password1);
                    if (!$uppercase || !$lowercase || !$number || strlen($new_password1) < 8) {
                        session()->setFlashdata('error', 'Your new password must contain Upper case Lower case and number, minimum length 8 ');
                    } else {
                        //password sama
                        $loginModel = new LoginModel();

                        $rows = $loginModel->where('username', $username)->findAll();

                        if (!empty($rows)) {
                            $row = $rows[0];
                            $password_old = $row["password"];
                            $role = $row["role"];
                            $email = $row["email"];
                            $name = $row["name"];
                            $failed_attempt = $row["failed_attempt"];
                            $password_expiry = strtotime($row["password_expiry"]);
                            $today = strtotime('today');


                            if ($failed_attempt < 3) {
                                if (password_verify($password, $password_old)) {
                                    $result = $loginModel->renew($username, $new_password1);
                                    session()->setFlashdata('error', $result);
                                    $activity = 'Password Changed Success';
                                  

                                    return redirect()->to('welcome');
                                } else {
                                    $failed_attempt = $failed_attempt + 1;
                                    $loginModel->set_failed_attempt($username, $failed_attempt);
                                    $activity = 'Password Changed Failed, Wrong password';
                                  

                                    session()->setFlashdata('error', 'Password Changed Failed, Wrong password');
                                }
                            } else {
                                $activity = 'Password Changed Failed, Max attemps reached';
                              

                                session()->setFlashdata('error', "your account is locked due to maximum attempts wrong password, contact Admin to recover access.");
                            }

                        } else {
                            session()->setFlashdata('error', "your account is not registered, contact admin for registration");

                        }

                    }
                } else {
                    session()->setFlashdata('error', 'your new password should be different compared to your current password');

                }
            } else {

                session()->setFlashdata('error', 'your retyped new password did not match , please reenter new password');
            }

            return redirect()->to('ResetPassword');
        }
        return view('reset_password');
    }
}