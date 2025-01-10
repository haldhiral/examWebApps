<?php

namespace App\Controllers;

use App\Models\ExamModel;
use CodeIgniter\RESTful\ResourceController;

class ApiExam extends ResourceController
{
    protected $modelName = 'App\Models\ExamModel'; // Use the ExamModel
    protected $format    = 'json'; // Define the response format as JSON

    // POST method to retrieve all exam data
    public function index()
    {
        // Fetch all exam data from the database
        $examModel = new ExamModel();
        $examData = $examModel->findAll();

        if ($examData) {
            // Prepare an array to hold the response data
            $responseData = [];

            // Loop through each exam and format the response
            foreach ($examData as $exam) {
                // Decode the answers JSON string to an array
                $answers = json_decode($exam['answer'], true);

                // Format each exam's data
                $responseData[] = [
                    'question' => $exam['question'],
                    'answers' => $answers,
                    'correct' => (int) $exam['correct']  // Ensure the correct answer is an integer
                ];
            }

            // Return the response as JSON
            return $this->respond($responseData);
        } else {
            // If no exams are found
            return $this->failNotFound('No exams found.');
        }
    }
}
