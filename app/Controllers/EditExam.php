<?php

namespace App\Controllers;

use App\Models\ExamModel;

date_default_timezone_set('Asia/Jakarta');

class EditExam extends BaseController
{
    public function index()
    {
        $session = session();


        if (!session()->get('isloggedin')) {
            $session->setFlashdata('error', 'Please login first!');
            return redirect()->to('login');
        }

        $id = $this->request->getPost("id"); 

        $data = [];

        if (!empty($id)) {
          
            $examModel = new ExamModel();
            $examData = $examModel->find($id);

            if ($examData) {
              
                $examData['answers'] = json_decode($examData['answer'], true);

               
                $data['exam'] = $examData;
            } else {
              
                $session->setFlashdata('error', 'Exam not found!');
                return redirect()->to('exam');
            }
        } else {
         
            $data['exam'] = [
                'id' => '',
                'question' => '',
                'answer' => '',  
                'answers' => ['', '', '', ''],  
                'correct' => ''
            ];
        }

      
        return view('edit_exam', $data);
    }


    public function save()
    {
    $examModel = new ExamModel();

    $id = $this->request->getPost('id');
    $data = [
        'question' => $this->request->getPost('question'),
        'answer'  => json_encode($this->request->getPost('answers')),
        'correct'  => $this->request->getPost('correct'),
    ];

    // var_dump($data);
    // die();

    if (!empty($id)) {
        $examModel->update($id, $data);
        session()->setFlashdata('success', 'Exam updated successfully!');
    } else {
        $examModel->insert($data);
        session()->setFlashdata('success', 'Exam created successfully!');
    }

    return redirect()->to('exam');
}
}
