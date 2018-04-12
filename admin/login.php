<?php
session_start();
include_once('../includes/connection.php');

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = $PDO->prepare("SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1");
    $query->bindValue(1, $username);
    $query->bindValue(2, $password);
    $query->execute();
    $result = $query->rowCount() ? true : false;

    if ($result == true) {
        $_SESSION['getUsername'] = $username;
        $_SESSION['password_noMD5'] = $_POST['password'];
        echo('Login');
    }
    else {
        echo('Gebruikersnaam en wachtwoord combinatie is incorrect');
    }
}
else {
    header('Location: ../');
    exit();
}

?>