<?php

    $mysqli = new mysqli('localhost:3306', 'root', 'coffee123', 'twitbay');

    if ($mysqli->connect_errno) {
        echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
    }