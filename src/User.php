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

    public function save(mysqli $connection)          // to musi byc obiekt klasy mqsli , inny nie zostanie przyjety
    {
        if (-1 === $this->id) {
            $sql = sprintf("INSERT INTO `user` (`email`, `username`, `password`) VALUES ('%s', '%s', '%s')", //trzy stringi
                $this->email,
                $this->username,
                $this->password
            );

            $result = $connection->query($sql);
            if($result) {
                $this->id = $connection->insert_id;  //id ostatnio wstawionego wiersza.
            } else {
                die("Error: user not saved: " . $connection->error);
            }
        }
    }

    static public function loadUserByUsername(mysqli $conn, $username)
    {
        $username = $conn->real_escape_string($username);   /// ????

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
            return FALSE;
        }

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

}