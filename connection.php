<?php
require_once 'config.php';

$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($connection->connect_errno) {
    die("Can not connect to Database: " . $connection->connect_error);
}