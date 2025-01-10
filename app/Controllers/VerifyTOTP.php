<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\LogbookModel;

class Verify_totp extends BaseController
{
    public function index()
    {
		// var_dump(session()->get('remarks'));
        if(session()->get('username') && session()->get('role') && session()->get('email') && session()->get('name') && session()->get('loggedin_time'))
        {
            $user_name = session()->get('username');
            $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
            $loginModel = new LoginModel();
            $rows = $loginModel->where('username', $user_name)->findAll();
            // echo '<pre>' . var_export($rows, true) . '</pre>';

            $data['email_address'] = session()->get('email'); 
            $data['web_app'] = 'debitnote';

            if($rows[0]['secret_key'] == "" || $rows[0]['secret_key'] == NULL || $rows[0]['is_confirm'] == 0){
                helper('text');
                //Generate secret key exclude 8/9 string because invalid character on google authenticator
                $data['secret_key'] = strtoupper(random_string('alnum', 16));
                while(str_contains($data['secret_key'], '8') || str_contains($data['secret_key'], '9')){
                    $data['secret_key'] = strtoupper(random_string('alnum', 16));
                }
                $data['link'] = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($data['email_address'], $data['secret_key'], $data['web_app']);
                $loginModel -> update_secret_key($data['secret_key'], $user_name);
            }

            return view('verify_totp', $data);  
        }
    }

    public function Submit_totp()
    {
        if(isset($_POST['totp']))
        {
            $logbookModel = new LogbookModel();
            $role1 = session()->get('role');
            $username1 =  session()->get('username');
            $email1 =  session()->get('email');
            $activity = "TOTP Entry" ;
            $logbookModel->log($username1, $role1, $email1, $activity);

            $request = \Config\Services::request();
            foreach($_POST as $key => $value)
            {					
                ${$key} = $request->getPost($key);					
            }

            $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
            $loginModel = new LoginModel();
            $secret_key = $loginModel -> get_secret_key($username1);
            if ($g->checkCode($secret_key[0]['secret_key'], $totp)) {
                $loginModel -> update_is_confirm($username1);
                
                session()->set('isloggedin', true);             
                $role = session()->get('role');
                $username =  session()->get('username');
                $email =  session()->get('email');
				$remarks = session()->get('remarks');
                $activity = "Login success";
                $logbookModel->log($username, $role, $email, $activity);
                return redirect()->to('welcome');
            } else {
                $user_name = session()->get('username');
                $loginModel = new LoginModel();
                session()->setFlashdata('alert', 'Login Failed, Wrong TOTP');
                return redirect()->to('/verify_totp');
            }
        }
    }
}
