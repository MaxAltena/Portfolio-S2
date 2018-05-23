<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_POST['searchValue'])){
    $search = $_POST['searchValue'];
    $result = array();
    $queryCategoryName = $PDO->prepare("SELECT DISTINCT name FROM categories WHERE name LIKE :search");
    $queryCategoryName->bindValue(":search", "%" . $search . "%");
    $queryCategoryName->execute();
    $fetchedCategoryName = $queryCategoryName->fetchAll();
    foreach($fetchedCategoryName as $array){
        foreach($array as $value) {
            $result[] = "CN:" . $value;
        }
    }
    
    $queryCategoryShort = $PDO->prepare("SELECT DISTINCT short FROM categories WHERE short LIKE :search");
    $queryCategoryShort->bindValue(":search", "%" . $search . "%");
    $queryCategoryShort->execute();
    $fetchedCategoryShort = $queryCategoryShort->fetchAll();
    foreach($fetchedCategoryShort as $array){
        foreach($array as $value) {
            $result[] = "CS:" . $value;
        }
    }
    
    $queryItemName = $PDO->prepare("SELECT DISTINCT name FROM items WHERE name LIKE :search");
    $queryItemName->bindValue(":search", "%" . $search . "%");
    $queryItemName->execute();
    $fetchedItemName = $queryItemName->fetchAll();
    foreach($fetchedItemName as $array){
        foreach($array as $value) {
            $result[] = "IN:" . $value;
        }
    }
    
    echo json_encode(array_unique($result));
}
else if (isset($_POST['getCategory'])) {
    $query = $PDO->prepare("SELECT short FROM categories WHERE name = ? LIMIT 1");
    $query->bindValue(1, $_POST['getCategory']);
    $query->execute();
    echo($query->fetchColumn());
}
else {
    header('Location: ../');
    exit();
}



?>