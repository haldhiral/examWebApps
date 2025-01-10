<?php

namespace App\Controllers;

use App\Models\ExamModel;

class Exam extends BaseController
{
    public function index()
    {
        $session = session();
        if (!session()->get('isloggedin')) {
            $session->setFlashdata('error', 'Please Login First!');
            return redirect()->to('login');
        }

        
        $examModel = new ExamModel();

    
        $data['exams'] = $examModel->findAll();

      
        return view('exam', $data);
    }
}
