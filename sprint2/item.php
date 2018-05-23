<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint2/includes/connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint2/includes/query.php');

if (isset($_GET['i'])) {
    if (!empty($_GET['i'])) {
        $itemArray = array();
        $item = new Item;
        $items = $item->fetch_ids();
        
        foreach ($items as $item) { 
            array_push($itemArray, $item['id']); 
        }
        if (in_array($_GET['i'], $itemArray)) {
            $id = $_GET['i'];
            
            $getItem = new Item;
            $currentItem = $getItem->fetch_item($id);
            
            $getCategory = new Category;
            $currentCategory = $getCategory->fetch_by_item($id);
?>
<html lang="nl">
    <head>
        <title><?= $currentItem['name']; ?> | Max Altena</title>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint2/includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="/sprint2/css/itemstyle.css">
    </head>

    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint2/includes/loader.php'); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint2/includes/menu.php'); ?>
        <main>
            <div id="content">
                <p><?= $currentItem['name']; ?></p>
                <p><?= $currentCategory['name']; ?></p>
            </div>
        </main>
        <script src="/sprint2/js/menu.js"></script>
    </body>
</html>
<?php
        }
        else {
            header('Location: /sprint2/');
            exit();
        }
    }
    else {
        header('Location: /sprint2/');
        exit();
    }
}
else {
    header('Location: /sprint2/');
    exit();
}
?>