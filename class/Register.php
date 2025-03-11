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
        $username = $this->format->validation($data['username']);
        $phone  = $this->format->validation($data['phone']);
        $email  = $this->format->validation($data['email']);
        $password  = $this->format->validation($data['password']);
        $v_token = md5(rand());



        if (empty($phone)  || empty($email) || empty($username) || empty($password)) {
            $error = "field must not be empty";
            return $error;
        } else {
            $email_query = "SELECT * FROM users WHERE email = '$email'";
            $check_email = $this->db->select($email_query);

            if ($check_email > 0) {
                $error = 'email already exists';
                return $error;
                header("location:register.php");
            } else {
                $insert_query = "INSERT INTO users(username,phone,email,password,v_token) VALUES('$username','$phone','$email','$password','$v_token')";

                $insert_row = $this->db->insert($insert_query);

                if ($insert_row) {
                    //   $email_verify($username, $email, $v_token);
                    $success = "registration complete. Please check your email to verify your account";
                    return $success;
                } else {
                    $error = "registration failed";
                    return $error;
                }
            }
        }
    }
}
