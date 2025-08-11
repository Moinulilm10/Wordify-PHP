<?php

include_once '../lib/Database.php';
include_once '../helpers/Format.php';

// Load dotenv before using $_ENV
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

include_once '../lib/PHPmailer/PHPMailer.php';
include_once '../lib/PHPmailer/Exception.php';
include_once '../lib/PHPmailer/SMTP.php';

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
        function sendmail_verify($name, $email, $v_token)
        {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->SMTPAuth = true;

                $mail->Host       = $_ENV['MAIL_HOST'];
                $mail->Username   = $_ENV['MAIL_USERNAME'];
                $mail->Password   = $_ENV['MAIL_PASSWORD'];

                // Ensure correct encryption type
                if (strtolower($_ENV['MAIL_ENCRYPTION']) === 'tls') {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                } elseif (strtolower($_ENV['MAIL_ENCRYPTION']) === 'ssl') {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                }

                $mail->Port       = (int)$_ENV['MAIL_PORT'];
                $mail->setFrom($_ENV['MAIL_FROM'], 'Wordify');

                $mail->addAddress($email, $name);

                $mail->isHTML(true);
                $mail->Subject = 'Email Verification From Wordify';
                $mail->Body = "
                    <h2>You have registered with Wordify</h2>
                    <h5>Verify your email address to login by clicking the link below</h5>
                    <a href='{$_ENV['APP_URL']}/admin/verifi-email.php?token=$v_token'>Click Here</a>
                ";

                $mail->send();
                echo "Email has been sent";
            } catch (Exception $e) {
                echo "Email sending failed: {$mail->ErrorInfo}";
            }
        }

        $name = $this->fr->validation($name);
        $phone = $this->fr->validation($phone);
        $email = $this->fr->validation($email);
        $password = $this->fr->validation(md5($password));
        $v_token = md5(rand());

        if (empty($name) || empty($phone) || empty($email) || empty($password)) {
            return "Field Must Not Be Empty";
        } else {
            $e_query = "SELECT * FROM users WHERE email='$email'";
            $check_email = $this->db->select($e_query);

            if ($check_email > '0') {
                return "This Email Is Already Exist";
            } else {
                $insert_query = "INSERT INTO users(username, email, phone, password, v_token) VALUES('$name', '$email', '$phone', '$password', '$v_token')";
                $insert_row = $this->db->insert($insert_query);

                if ($insert_row) {
                    sendmail_verify($name, $email, $v_token);
                    return "Registration Successful. Please check your email inbox for verification email";
                } else {
                    return "Registration Failed";
                }
            }
        }
    }
}
