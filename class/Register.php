<?php

include_once '../lib/Database.php';
include_once '../helpers/Format.php';

// include_once '../PHPmailer/PHPMailer.php';
// include_once '../PHPmailer/SMTP.php';
// include_once '../PHPmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register
{

    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }


    public function AddUser($name, $phone, $email, $password)
    {

        function send_email_verify($name, $email, $v_token)
        {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
            $mail->Port = $_ENV['MAIL_PORT'];

            $mail->setFrom($_ENV['MAIL_FROM'], $name);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification From Web Master';

            $email_template = "
        <h2>You have registered with Web Master</h2>
        <h5>Verify your email address to login. Please click the link below:</h5>
        <a href='{$_ENV['APP_URL']}/verify-email.php?token=$v_token'>Click Here</a> ";

            $mail->Body = $email_template;
            $mail->send();
            echo "Email has ben sent";
        }

        $name = $this->fr->validation($name);
        $phone = $this->fr->validation($phone);
        $email = $this->fr->validation($email);
        $password = $this->fr->validation(md5($password));
        $v_token = md5(rand());


        if (empty($name) || empty($phone) || empty($email) || empty($password)) {
            $error = "Field Must Not Be Empty";
            return $error;
        } else {
            $e_query = "SELECT * FROM tbl_user WHERE email='$email'";
            $check_email = $this->db->select($e_query);

            if ($check_email > '0') {
                $error = "This Email Is Already Exist";
                return $error;
                header("location:register.php");
            } else {
                $insert_query = "INSERT INTO tbl_user(username, email, phone, password, v_token) VALUES('$name', '$email', '$phone', '$password', '$v_token')";

                $insert_row = $this->db->insert($insert_query);

                if ($insert_row) {
                    send_email_verify($name, $email, $v_token);
                    $success = "Registration Successful. Please check your email inbox for verify email";
                    return $success;
                } else {
                    $error = "Registration Failed";
                    return $error;
                }
            }
        }
    }
}
