<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


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


        if (!$this->db) {
            die("Database connection failed!");
        }
    }

    public function addUser($data)
    {
        echo "Function addUser() is running...<br>";

        $username = $this->format->validation($data['username']);
        $phone  = $this->format->validation($data['phone']);
        $email  = $this->format->validation($data['email']);
        $password  = $this->format->validation($data['password']);
        $v_token = md5(rand());

        if (empty($phone) || empty($email) || empty($username) || empty($password)) {
            die("Field must not be empty"); // 👈 Debugging line
        }

        echo "Validation passed...<br>";

        $email_query = "SELECT * FROM users WHERE email = '$email'";
        $check_email = $this->db->select($email_query);

        if ($check_email && mysqli_num_rows($check_email) > 0) {
            die("Email already exists"); // 👈 Debugging line
        }

        echo "Inserting user...<br>";

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users(username, phone, email, password, v_token)
                     VALUES('$username', '$phone', '$email', '$hashed_password', '$v_token')";

        $insert_row = $this->db->insert($insert_query);

        if ($insert_row) {
            die("User added successfully!"); // 👈 Debugging line
        } else {
            die("Registration failed"); // 👈 Debugging line
        }
    }
}
