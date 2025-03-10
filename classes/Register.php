<?php

include_once '../lib/database.php';
include_once '../helpers/Format.php';

class Register
{
    public $db;
    public $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function addUser($data)
    {
        $name = $this->format->validation($data['name']);
        $phone  = $this->format->validation($data['phone']);
        $email  = $this->format->validation($data['email']);
        $password  = $this->format->validation($data['password']);
        $v_token = md5(rand());

        // $email_query = "select * from users where email = '$email'";
        // $check_email = $this->db->query($email_query);

        // if ($check_email > 0) {
        //     $error = 'email already exists';
        //     return $error;
        //     header("location:register.php");
        // }

        if (empty($password)  || empty($email) || empty($name) || empty($password)) {
            $error = "field must not be empty";
            return $error;
        }
    }
}
