<?php

class Comment
{
    private $id;

    private $userId;

    private $tweetId;

    private $creationDate;

    private $comment;

    function __construct()
    {
        $this->id = -1;
        $this->userId = '';
        $this->tweetId = '';
        $this->creationDate = '';
        $this->comment = '';
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

    public function getTweetId()
    {
        return $this->tweetId;
    }

    public function setTweetId($tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }


    static public function loadCommentById()
    {

    }

    static public function loadAllCommentsByPostId(mysqli $connection, $tweetId)
    {
        $tweetId = intval($tweetId);

        $sql = "SELECT * FROM comment c LEFT JOIN user u ON u.id = c.user_id WHERE tweet_id=$tweetId ORDER BY creation_date DESC LIMIT 20 ";

        $table = [];

        $result = $connection->query($sql);

        if($result == true && $result->num_rows != 0){
            foreach($result as $row) {
                $newComment = new Comment();
                $newComment->id = $row['id'];
                $newComment->userId = $row['username'];
                $newComment->comment = $row['comment'];
                $newComment->creationDate = $row['creation_date'];
                $newComment->tweetId = $row['tweet_id'];

                $table[] = $newComment;
            }
            return $table;
        } else {
            $newComment = new Comment();
            $newComment->userId = '';
            $newComment->comment = '';
            $newComment->creationDate = '';
            $newComment->tweetId = '';

            $table[] = $newComment;
            return $table;
        }
    }

    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $comment = $this->comment;
            $creationDate = $this->creationDate;

            $userId = $this->userId;
            $userId = intval($userId);

            $tweetId = $this->tweetId;
            $tweetId = intval($tweetId);

            $sql = "INSERT INTO comment(user_id, tweet_id, creation_date, comment) VALUES('$userId', '$tweetId', '$creationDate', '$comment')";

            $result = $connection->query($sql);

            if($result) {
                $this->id = $connection->insert_id;  //id ostatnio wstawionego wiersza.
            } else {
                die("Error: comment not saved: " . $connection->error);
            }
        }
    }

}