<?php
require_once('database.php');
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$result = $mysqli->query("
                        SELECT email, password, name
                        FROM users 
                        WHERE email = '$username' 
                        AND password = '$password';
                    ");

// If match found in database
if ($result) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header('Location: index.php');
}
