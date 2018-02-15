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
            
            $item = new Item;
            $items = $item->fetch_for_preview_by_category($short);
            
            // Get items
?>
<html lang="nl">
    <head>
        <title><?= $short; ?> | Max Altena</title>
        <?php include_once('includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/categoriestyle.css">
    </head>

    <body>
        <?php include_once('includes/loader.php'); ?>
        <?php include_once('includes/menu.php'); ?>
        <main>
            <div id="top">
                <!-- Top = short name, full name and description? -->
                <h1><?= $short; ?></h1>
            </div>
            <div id="center">
                <!-- Filter per sprint -->
                <div style="background: yellow;">
                    Sprint1
                </div>
                <?php
                    foreach ($items as $item) {
                        // Switch to see what sprint item is from
                        // If sprint item counter is not 0, create sprint header
                        // Else do not create sprint header
                        // 
                        
                        
                        echo('<span class="divider"></span><a href="https://i371527.hera.fhict.nl/item?i='.$item['id'].'" class="itemLink" id="itemLink'.$item['id'].'"><div class="section"><div class="firstClass"><h1>'.$item['name'].'</h1><h2>'.$item['description'].'</h2></div><div><span class="arrowSpan"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span></div></div></a>');
                        
                        $photoID = strstr($item['photos'], '|', TRUE);
                        $photo = new Photo;
                        $photoInsert = $photo->fetch_by_id($photoID);

                        if ($photoInsert !== null) {
                            echo('<script>$("#itemLink'.$item['id'].'").css({background: "url(/assets/photos/'.$photoInsert.')"})</script>');
                        }
                    }
                ?>
                <!-- Load in items - get name, get description? -->
                <span class="divider"></span>
            </div>
            <div id="bottom">
                <!-- Back to homepage and back to top button? -->
                <span id="backtoHome" class="backtoHome">
                    <span class="footerLink">Terug naar homepagina</span>
                </span>
                <span id="backLine"></span>
                <span id="backtoTop" class="backtoTop">
                    <span class="footerLink">Terug naar boven</span>
                </span>
            </div>
        </main>
        <script src="js/category.js"></script>
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