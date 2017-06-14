<?php

class Tweet
{
    private $id;

    private $userId;

    private $text;

    private $creationDate;

    function __construct()
    {
        $this->id = -1;
        $this->userId = '';
        $this->text = '';
        $this->creationDate = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    static public function loadAllTweetsByUserId(mysqli $connection, $userIdd)
    {
        $userIdd = intval($userIdd);

        $sql = "SELECT * FROM user u LEFT JOIN tweet t ON u.id = t.user_id WHERE u.id=$userIdd ORDER BY creation_date DESC LIMIT 100";

        $table = [];

        $result = $connection->query($sql);

        if($result == true && $result->num_rows != 0){
            foreach($result as $row) {
                $newTweet = new Tweet();
                $newTweet->id = $row['id'];
                $newTweet->userId = $row['username'];
                $newTweet->text = $row['text'];
                $newTweet->creationDate = $row['creation_date'];

                $table[] = $newTweet;
            }
            return $table;
        }

    }

    static public function loadAllTweets(mysqli $connection)
    {
        $sql = "SELECT * FROM user u LEFT JOIN tweet t ON u.id = t.user_id ORDER BY creation_date DESC LIMIT 100 ";

        $table = [];

        $result = $connection->query($sql);

        if($result == true && $result->num_rows != 0){
            foreach($result as $row) {
                $newTweet = new Tweet();
                $newTweet->id = $row['id'];
                $newTweet->userId = $row['username'];
                $newTweet->text = $row['text'];
                $newTweet->creationDate = $row['creation_date'];

                $table[] = $newTweet;
            }
            return $table;
        }
    }

    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $text = $this->text;
            $creationDate = $this->creationDate;
            $userId = $this->userId;

            $sql = "INSERT INTO tweet(user_id, text, creation_date) VALUES('$userId', '$text', '$creationDate')";

            $result = $connection->query($sql);

            if($result) {
                $this->id = $connection->insert_id;
            } else {
                die("Error: tweet not saved: " . $connection->error);
            }
        }
    }

}