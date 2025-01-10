<?php

namespace App\Models;

use CodeIgniter\Model;
date_default_timezone_set('Asia/Jakarta');
class UserModel extends Model
{
    protected $table = 'userdata';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'name', 'email', 'role', 'username', 'password', 'failed_attempt', 'password_expiry', 'remarks'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $db;


    public function get_all_data()
    {
        $builder = $this->db->table('userdata');
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function createUser($name, $email, $username, $role, $password, $failed_attempt, $password_expiry, $remarks)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'username' => $username,
            'password' => $password,
            'remarks' => $remarks,
            'failed_attempt' => $failed_attempt,
            'password_expiry' => $password_expiry
        ];

        $builder = $this->db->table('userdata');
        $builder->insert($data);



        return $this->db->insertID(); // Return the ID of the inserted user.
    }
	
	  public function get_no($username)
    {
        $builder = $this->db->table('userdata');  
        $builder->where('username', $username) ;
        $result = $builder->get()->getResultArray();
        return $result[0]["id"];
    }

    public function get_data($id)
    {
        $builder = $this->db->table('userdata');
        $builder->where('id', $id);
        $result = $builder->get()->getResultArray();
        return $result[0];
    }


    public function get_id($username)
    {
        $builder = $this->db->table('userdata');
        $builder->where('username', $username);
        $result = $builder->get()->getResultArray();
        return $result[0]["id"];
    }

    public function update_user($id, $name, $email, $role, $username, $password_hashed, $password_expiry)
    {
        $array = array(

            'name' => $name,
            'email' => $email,
            'role' => $role,
            'username' => $username,
            'password' => $password_hashed,
            'failed_attempt' => 0,
            'password_expiry' => $password_expiry,
        );
        $builder = $this->db->table('userdata');
        $builder->where('id', $id);
        $builder->update($array);

      
        $role1 = session()->get('role');
        $username1 =  session()->get('username');
        $email1 =  session()->get('email');

        return "update success";
    }

    public function insert_user($name, $email, $role, $username, $password_hashed, $password_expiry)
    {
        $array = array(
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'username' => $username,
            'password' => $password_hashed,
            'failed_attempt' => 0,
            'password_expiry' => $password_expiry,
            'telegram_id' => $telegram_id
        );
        $builder = $this->db->table('userdata');
        $builder->insert($array);

        $role1 = session()->get('role');
        $username1 =  session()->get('username');
        $email1 =  session()->get('email');



        return "insert success";

    }

    public function delete_user($id, $name, $email, $role, $username)
    {
        $builder = $this->db->table('userdata');
        $builder->where('id', $id);
        $builder->delete();

      
        $role1 = session()->get('role');
        $username1 =  session()->get('username');
        $email1 =  session()->get('email');




        return "delete success";
    }




    public function getUserById($id)
    {
        return $this->find($id, ['id', 'name', 'email', 'role', 'username']);
    }
    public function check_user($username)
    {

        $builder = $this->db->table('userdata');
        $builder->where('username', $username);
        $result = $builder->get()->getResultArray();
        if (count($result) > 0) {
            return "true";
        } else {
            return NULL;
        }
    }

    public function reset_secret_key($username)
    {
        $builder = $this->db->table('userdata');  
        $builder->set('secret_key', '');
        $builder->set('is_confirm', 0);
        $builder->where('username', $username) ;
        $builder->update();
    }
}