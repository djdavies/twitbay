<?php

class User {
    // Get all users names
    public function getUserNames() {
        require('database.php');
        if ($result = $mysqli->query('SELECT name FROM users')) {
            while ($row = $result->fetch_assoc()) {
                echo $row['name'] . '<br>';
            }
        }
    }

    public function setUserName($username, $email, $password) {
    	require('database.php');
    	$register = $mysqli->query("INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$password')");

        header('Location: index.php');
    }
}
