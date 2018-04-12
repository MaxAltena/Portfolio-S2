<?php
session_start();
include_once('../includes/connection.php');

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $queryCheck = $PDO->prepare("SELECT * FROM users WHERE username = ?");
    $queryCheck->bindValue(1, $username);
    $queryCheck->execute();
    $resultCheck = $queryCheck->rowCount() ? true : false;
    
    if ($resultCheck == false){
        $queryRegister = $PDO->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $queryRegister->bindValue(1, $username);
        $queryRegister->bindValue(2, $password);
        $queryRegister->execute();
        $resultRegister = $queryRegister->rowCount() ? true : false;
            
        if ($resultRegister == true) {
            $_SESSION['getUsername'] = $username;
            $_SESSION['password_noMD5'] = $_POST['password'];
            echo('Register');
        }
        else {
            echo('Er ging iets fout met het aanmaken van de gebruiker');   
        }
    }
    else {
        echo('Deze gebruikersnaam bestaat al');
    }
}
else {
    header('Location: ../');
    exit();
}
?>