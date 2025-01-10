<?php

namespace App\Controllers;

use App\Models\GradeModel;
use CodeIgniter\API\ResponseTrait;

class Grade extends BaseController
{
    use ResponseTrait;  

    public function index()
    {
        $session = session();
        if (!session()->get('isloggedin')) {
            $session->setFlashdata('error', 'Please Login First!');
            return redirect()->to('login');
        }

        
        $gradeModel = new GradeModel();

        
        $data['grades'] = $gradeModel->findAll();

        var_dump($data);
      
        return view('grade', $data);
    }

    public function store()
    {
       
        $data = $this->request->getJSON();  

        if (!isset($data->user) || !isset($data->score) || !isset($data->total_question)) {
            return $this->failValidationErrors("User and score are required.");
        }

     
        $gradeModel = new GradeModel();
        $insertData = [
            'user'  => $data->user,
            'score' => $data->score,
            'total_question' => $data->total_question
        ];

        $gradeModel->insert($insertData);

     
        return $this->respondCreated([
            'message' => 'Grade successfully inserted!',
            'data' => $insertData
        ]);
    }
}
