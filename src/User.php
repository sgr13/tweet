<?php

require_once 'connection.php';

class User
{
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct()
    {
        $this->id = -1;
        $this->email = '';
        $this->username = '';
        $this->password = '';
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    public function setHash($hash)
    {
        $this->password = $hash;
    }

    function getUsername()
    {
        return $this->username;
    }

    public function save(mysqli $connection)
    {
        if (-1 === $this->id) {
            $sql = sprintf("INSERT INTO `user` (`email`, `username`, `password`) VALUES ('%s', '%s', '%s')",
                $this->email,
                $this->username,
                $this->password
            );

            $result = $connection->query($sql);
            if ($result) {
                $this->id = $connection->insert_id;
            } else {
                die("Error: user not saved: " . $connection->error);
            }
        } else {
            $username = $this->username;
            $password = $this->password;
            $id = $this->id;
            $id = intval($id);

            $sql = "UPDATE user SET username ='$username', password='$password' WHERE id=$id";
            $result = $connection->query($sql);

            if ($result == true) {
                return true;
            }
            return false;
        }
    }

    public static function loadUserByUsername(mysqli $conn, $username)
    {
        $username = $conn->real_escape_string($username);
        $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
        $result = $conn->query($sql);

        if (!$result) {
            die("ERROR" . $conn->connect_errno);
        }

        if ($result->num_rows == 1) {
            $userArray = $result->fetch_assoc();
            $user = new User();
            $user->setId($userArray['id']);
            $user->setEmail($userArray['email']);
            $user->setUsername($userArray['username']);
            $user->setHash($userArray['password']);

            return $user;
        } else {
            return false;
        }
    }

    public function delete(mysqli $connection)
    {
        if ($this->id != -1) {

            $this->id = intval($this->id);
            $sql = "DELETE FROM message WHERE sender_id=$this->id AND receiver_id=$this->id ";
            $result = $connection->query($sql);

            $sql = "DELETE FROM comment WHERE user_id=$this->id";
            $result = $connection->query($sql);

            $sql = "DELETE FROM tweet WHERE user_id=$this->id";
            $result = $connection->query($sql);

            $sql = "DELETE FROM user WHERE id=$this->id";
            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return false;
    }
}
