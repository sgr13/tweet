<?php

class Message
{
    private $id;
    private $senderId;
    private $receiverId;
    private $status;
    private $text;
    private $creationDate;

    public function __construct()
    {
        $this->id = -1;
        $this->senderId = '';
        $this->receiverId = '';
        $this->status = 0;
        $this->text = '';
        $this->creationDate='';
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
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
            $senderId = intval($senderId);
            $receiverId = $this->receiverId;
            $receiverId = intval($receiverId);
            $status = $this->status;
            $text = $this->text;
            $date = $this->creationDate;

            $sql = "INSERT INTO message(sender_id, receiver_id, status, text, creationDate) VALUES('$senderId', '$receiverId', '$status', '$text', '$date')";
            $result = $connection->query($sql);

            if($result) {
                $this->id = $connection->insert_id;  //id ostatnio wstawionego wiersza.
            } else {
                die("Error: wiadomość nie zapisana do bazy danych: " . $connection->error);
            }
        }
    }
}
