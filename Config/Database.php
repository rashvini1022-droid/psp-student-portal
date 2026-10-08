<?php

class Database
{
    private $host = "localhost";
    private $database = "psp_student_portal";
    private $username = "root";
    private $password = "";

    public function connect()
    {
        try {

            $connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database,
                $this->username,
                $this->password
            );

            $connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $connection;

        } catch (PDOException $e) {

            die("Database connection failed: " . $e->getMessage());

        }
    }
}