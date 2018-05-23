<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint1/includes/connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint1/includes/query.php');

$category = new Category;
$categories = $category->fetch();

if (isset($_GET['c'])) {
    if (!empty($_GET['c'])) {
        $shortArray = array();
        
        foreach ($categories as $category) { 
            array_push($shortArray, $category['short']); 
        }
        if (in_array($_GET['c'], $shortArray)) {
            $short = $_GET['c'];
            $page = $short;
            
            // Get items
?>
<html lang="nl">
    <head>
        <title><?= $short; ?> | Max Altena</title>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint1/includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="/sprint1/css/categoriestyle.css">
    </head>

    <body>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/sprint1/includes/menu.php'); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint1/includes/loader.php'); ?>
        <main>
            <div id="top">
                <h1><?= $short; ?></h1>
            </div>
        </main>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint1/includes/menuselect.php'); ?>
    </body>
</html>
<?php
        }
        else {
            header('Location: /sprint1/');
            exit();
        }
    }
    else {
        header('Location: /sprint1/');
        exit();
    }
}
else {
    header('Location: /sprint1/');
    exit();
}
?>