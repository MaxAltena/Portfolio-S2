<?php
session_start();
include_once('../includes/connection.php');

if (isset($_POST['value'], $_POST['id'])){
    $query = $PDO->prepare('UPDATE users SET rank = ? WHERE id = ?');
    $query->bindValue(1, $_POST['value']);
    $query->bindValue(2, $_POST['id']);
    $query->execute();
    echo($query->rowCount() ? true : false);
}
else {
    header('Location: ../');
    exit();
}

?>