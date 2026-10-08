<?php

class User
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM students WHERE email = :email LIMIT 1";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":email", $email);

        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {

            return $user;

        }

        return false;
    }


    public function getUserById($id)
    {
        $sql = "SELECT * FROM students WHERE id = :id LIMIT 1";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id", $id);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    public function updateProfilePicture($id, $filename)
    {
        $sql = "UPDATE students
                SET profile_picture = :filename
                WHERE id = :id";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":filename", $filename);

        $statement->bindParam(":id", $id);

        return $statement->execute();
    }
}

?>