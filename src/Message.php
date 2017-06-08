<?php

class Message
{
    private $id;

    private $senderId;

    private $receiverId;

    private $status;

    private $text;

    function __construct()
    {
        $this->id = -1;
        $this->senderId = '';
        $this->receiverId = '';
        $this->status = 0;
        $this->text = '';
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function saveToDb(mysqli $connection)
    {
        if ($this->id == -1) {
            $senderId = $this->senderId;
            $receiverId = $this->receiverId;
            $status = $this->status;
            $text = $this->text;

            $sql = "INSERT INTO message(sender_id, receiver_id, status, text) VALUES('$senderId', '$receiverId', '$status', '$text')";

            $result = $connection->query($sql);

            if($result) {
                $this->id = $connection->insert_id;  //id ostatnio wstawionego wiersza.
            } else {
                die("Error: wiadomość nie zapisana do bazy danych: " . $connection->error);
            }
        }

    }
}