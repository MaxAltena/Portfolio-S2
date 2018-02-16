<?php

include_once('includes/connection.php');
include_once('includes/query.php');

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
            
            $getCategory = new Category;
            $currentCategory = $getCategory->fetch_category($short);
            
            $item = new Item;
            $items = $item->fetch_for_preview_by_category($short);
?>
<html lang="nl">
    <head>
        <title>??? | Max Altena</title>
        <?php include_once('includes/head.php'); ?>
    </head>

    <body>
        <?php include_once('includes/loader.php'); ?>
        <?php include_once('includes/menu.php'); ?>
        <main>
            Content!
        </main>
        <script src="js/menu.js"></script>
        <?php include_once('includes/menuselect.php'); ?>
    </body>
</html>
<?php
        }
        else {
            header('Location: https://i371527.hera.fhict.nl/');
            exit();
        }
    }
    else {
        header('Location: https://i371527.hera.fhict.nl/');
        exit();
    }
}
else {
    header('Location: https://i371527.hera.fhict.nl/');
    exit();
}
?>