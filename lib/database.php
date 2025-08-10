<?php

include_once '../config/config.php';

class Database
{
    private $host;
    private $user;
    private $password;
    private $database;
    public $link;

    public $error;

    public function __construct()
    {
        $this->host = HOST;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->database = DATABASE;

        $this->dbConnect();
    }

    public function dbConnect()
    {
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        // if (!$this->link) {
        //     $this->error = 'Database connection failed: ' . mysqli_connect_error();
        //     return false;
        // } else {
        //     return true;
        // }

        if (!$this->link) {
            die("Database connection failed: " . mysqli_connect_error());
        } else {
            echo "Database connected successfully!<br>";
        }
    }


    // select query
    public function select($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // insert query
    public function insert($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // update query
    public function update($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // delete query
    public function delete($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}
