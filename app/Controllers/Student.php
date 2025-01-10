<?php

namespace App\Controllers;

class Student extends BaseController
{


    public function index()
    {
        $session = session();
        if (!session()->isloggedin) {
            $session->setFlashdata('error', 'Please Login First!');
            return redirect()->to('login');

        }


        return view('student');
    }
}