<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint3/includes/connection.php');

if(isset($_SESSION['getUsername'])) {
    $username = $_SESSION['getUsername'];
    
    $query = $PDO->prepare("SELECT * FROM users WHERE username = ?");
    $query->bindValue(1, $username);
    $query->execute();
    $userinfo = $query->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION['user_id'] = $userinfo['id'];
    $_SESSION['username'] = $userinfo['username'];
    $_SESSION['password_MD5'] = $userinfo['password'];
    $_SESSION['rank'] = $userinfo['rank'];
    
    $_SESSION['ingelogd'] = true;
    unset($_SESSION['getUsername']);
    
    header('Location: /sprint3/admin/');
    exit();
}
else {
    header('Location: /sprint3/');
    exit();
}
?>