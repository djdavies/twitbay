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
}
