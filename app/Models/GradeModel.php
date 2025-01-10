<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table      = 'grades';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user', 'score','total_question'];

    protected $returnType     = 'array';
    protected $useTimestamps  = true;
}
