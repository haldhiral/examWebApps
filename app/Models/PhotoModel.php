<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id'; 

    
    protected $allowedFields = ['id', 'student_name', 'username', 'photo'];

    protected $returnType     = 'array';

    public function upsertPhotoByUsername(string $username, array $data): bool
    {
      
        $record = $this->where('username', $username)->first();

        if ($record) {
            
            return $this->where('username', $username)->set($data)->update();
        } else {
           
            return $this->insert($data);
        }
    }
  
}
