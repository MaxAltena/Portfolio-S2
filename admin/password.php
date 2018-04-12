<?php
session_start();
include_once('../includes/connection.php');

if (isset($_POST['password'])) {
    $_SESSION['password_noMD5'] = $_POST['password'];
    $password = md5($_POST['password']);
    $_SESSION['password_MD5'] = $password;
    
    $query = $PDO->prepare("UPDATE users SET password = ? WHERE id = ?");
    $query->bindValue(1, $password);
    $query->bindValue(2, $_SESSION['user_id']);
    $query->execute();
    $result = $query->rowCount() ? true : false;

    if ($result == true) {
        session_destroy();
        echo('success');
    }
    else {
        echo('Er ging iets fout');
    }
}
else {
    header('Location: ../');
    exit();
}

?>