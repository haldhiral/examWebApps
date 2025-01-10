<?php

namespace App\Models;

use CodeIgniter\Model;
date_default_timezone_set('Asia/Jakarta');
class LoginModel extends Model
{
    protected $table = 'userdata';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'email', 'username', 'password', 'failed_attempt', 'password_expiry', 'telegram_id', 'remarks'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $db;

    public function login($username, $password)
    {
        // Perform the necessary logic to check username and password against the user table
        // and return the user object if authenticated, or false otherwise

        // Example logic:
        $user = $this->where('username', $username)
            ->where('password', $password)
            ->first();

        return $user;
    }
    public function set_failed_attempt($username, $failed_attempt)
    {
        $data = array(
            'failed_attempt' => $failed_attempt
        );

        $this->where('username', $username)
            ->set($data)
            ->update();

        return $this->affectedRows();
    }
    public function renew($username, $new_password1)
    {
        $password_hashed = password_hash($new_password1, PASSWORD_DEFAULT);
        $password_expiry_new = date('Y-m-d', strtotime("+90 days"));
        $data = array(
            'password' => $password_hashed,
            'failed_attempt' => 0,
            'password_expiry' => $password_expiry_new
        );
        $this->db->table($this->table)->update(
            $data,
            array(
                "username" => $username,
            )
        );
        return "password has been changed, Please login with your new password";


    }

    public function update_secret_key($secret_key, $user_name)
	{
        $builder = $this->db->table('userdata');
        $builder->set('is_confirm', 0);
        $builder->set('secret_key', $secret_key);
        $builder->where('username', $user_name);
        $builder->update();
    }

    public function update_is_confirm($user_name)
	{
        $builder = $this->db->table('userdata');
        $builder->set('is_confirm', 1);
        $builder->where('username', $user_name);
        $builder->update();
    }

    public function get_secret_key($user_name)
	{
        $builder = $this->db->table('userdata');
        $builder->select('username, secret_key');
        $builder->where('username', $user_name);
        $result = $builder->get()->getResultArray();

        return $result;
    }



}