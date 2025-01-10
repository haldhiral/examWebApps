<?php

namespace App\Controllers;

class Home extends BaseController
{


    public function index()
    {
        $session = session();
        if (!session()->isloggedin) {
            $session->setFlashdata('error', 'Please Login First!');
            return redirect()->to('login');

        }


        return view('welcome');
    }
}