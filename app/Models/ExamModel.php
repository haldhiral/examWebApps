<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamModel extends Model
{
    protected $table = 'exam';           
    protected $primaryKey = 'id';        

    protected $useAutoIncrement = true;  
    protected $allowedFields = [        
        'question',
        'answer',
        'correct'
    ];


}
