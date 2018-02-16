<?php

include_once('includes/connection.php');
include_once('includes/query.php');

if (isset($_GET['c'])) {
    if (!empty($_GET['c'])) {
        $shortArray = array();
        $category = new Category;
        $categories = $category->fetch();
        
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
        <title><?= $short; ?> | Max Altena</title>
        <?php include_once('includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/categoriestyle.css">
    </head>

    <body>
        <?php include_once('includes/loader.php'); ?>
        <?php include_once('includes/menu.php'); ?>
        <main>
            <div id="top">
                <h1><?= $currentCategory['name']." (<span class='accent'>".$short."</span>)"; ?></h1>
                <?php
                    $currentCategory['text'];
                    
                    $text = explode('|', $currentCategory['text']);
                    
                    foreach ($text as $value) {
                        ?>
                            <p><?= $value; ?></p>
                        <?php
                    }
                    
                    if ($currentCategory['rubrix'] !== null) {
                ?>
                        <a href="https://i371527.hera.fhict.nl/rubrix?r=<?= $currentCategory['rubrix']; ?>" id="rubrixLink"><span class="textSpan">Rubrix van <?= $short; ?></span><span class="arrowSpan arrowSpanRubrix"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span></a>
                <?php
                    }
                ?>
            </div>
            <div id="center">
                <div id="filter"></div>
                <?php
                    $sprintCounter = 0;
                    $sprints = false;
                    foreach ($items as $item) {
                        if ($item['sprint'] == null) {
                ?>
                            <a href="https://i371527.hera.fhict.nl/item?i=<?= $item['id']; ?>" class="itemLink item" id="itemLink<?= $item['id']; ?>">
                                <div class="section">
                                    <div class="firstClass">
                                        <h1><?= $item['name']; ?></h1>
                                        <h2><?= $item['description']; ?></h2>
                                    </div>
                                    <div>
                                        <span class="arrowSpan">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                <?php
                            
                            $photoID = strstr($item['photos'], '|', TRUE);
                            $photo = new Photo;
                            $photoInsert = $photo->fetch_by_id($photoID);
                            
                            if ($photoInsert !== null) {
                ?>
                               <script>$("#itemLink<?= $item['id']; ?>").css({background: "url(/assets/photos/<?= $photoInsert; ?>)"})</script>
                <?php
                            }
                        }
                        else {
                            $sprints = true;
                            if ($item['sprint'] == $sprintCounter) {
                ?>
                            <a href="https://i371527.hera.fhict.nl/item?i=<?= $item['id']; ?>" class="itemLink item itemSprint<?= $item['sprint']; ?>" id="itemLink<?= $item['id']; ?>">
                                <div class="section">
                                    <div class="firstClass">
                                        <h1><?= $item['name']; ?></h1>
                                        <h2><?= $item['description']; ?></h2>
                                    </div>
                                    <div>
                                        <span class="arrowSpan">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                <?php
                                
                                $photoID = strstr($item['photos'], '|', TRUE);
                                $photo = new Photo;
                                $photoInsert = $photo->fetch_by_id($photoID);
                                
                                if ($photoInsert !== null) {
                ?>
                                    <script>$("#itemLink<?= $item['id']; ?>").css({background: "url(/assets/photos/<?= $photoInsert; ?>)"})</script>
                <?php
                                }
                            }
                            else {
                                $sprintCounter = $item['sprint'];  
                ?>
                                <div class="sprintHeader item itemSprint<?= $item['sprint']; ?>" id="sprintHeader<?= $item['sprint']; ?>">
                                    <h1>Sprint <span class="accent"><?= $item['sprint']; ?></span></h1>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 15" id="separator"><polyline class="coolLine" points="5,4.5 11.2,10.5 17.5,4.5 23.7,10.5 30,4.5 36.2,10.5 42.5,4.5 48.8,10.5 55,4.5"/></svg>
                                </div>
                           
                                <a href="https://i371527.hera.fhict.nl/item?i=<?= $item['id']; ?>" class="itemLink item itemSprint<?= $item['sprint']; ?>" id="itemLink<?= $item['id']; ?>">
                                    <div class="section">
                                        <div class="firstClass">
                                            <h1><?= $item['name']; ?></h1>
                                            <h2><?= $item['description']; ?></h2>
                                        </div>
                                        <div>
                                            <span class="arrowSpan">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                <?php
                                
                                $photoID = strstr($item['photos'], '|', TRUE);
                                $photo = new Photo;
                                $photoInsert = $photo->fetch_by_id($photoID);
                                
                                if ($photoInsert !== null) {
                ?>
                                    <script>$("#itemLink<?= $item['id']; ?>").css({background: "url(/assets/photos/<?= $photoInsert; ?>)"})</script>
                <?php
                                }
                            }
                        }
                    }
                    
                    if ($sprints == true && $sprintCounter > 1) {
                        $sprintArray = array();
                        $i = 1;
                        while ($i <= $sprintCounter) {
                            array_push($sprintArray, $i);
                            $i++;
                        }
                        
                ?>
                        <div id="contentFilter">
                            <h2>Filter op sprints</h2>
                            <div>
                                <span class="filterOption activeFilterOption" id="sprintFilterAll">Alles</span>
                                <script>
                                    $("#sprintFilterAll").on("click", function(){
                                        $(".activeFilterOption").removeClass("activeFilterOption");
                                        $(this).addClass("activeFilterOption");
                                        filter = "all";
                                        useFilter();
                                    });
                                </script>
                    <?php
                            foreach ($sprintArray as $sprint) {
                                ?>
                                    <span class="filterOption" id="sprintFilter<?= $sprint; ?>"><?= $sprint; ?></span>
                                    <script>
                                        $("#sprintFilter<?= $sprint; ?>").on("click", function(){
                                            $(".activeFilterOption").removeClass("activeFilterOption");
                                            $(this).addClass("activeFilterOption");
                                            filter = <?= $sprint; ?>;
                                            useFilter();
                                        });
                                    </script>
                                <?php
                            }
                    ?>
                            </div>
                        </div>
                        <script>
                        $("#contentFilter").appendTo("#filter");
                        var filter = "all";
                        
                        function useFilter() {
                            if (filter === "all") {
                                $(".item").show(750);
                            }
                            else {
                                var itemSprint = ".itemSprint" + filter;
                                $(".item:not("+itemSprint+")").hide(750);
                                $(".item"+itemSprint).show(750);
                            }
                        }
                    </script>
                <?php
                    }
                    else {
                ?>
                        <script>
                            $("#filter").remove();
                        </script>
                <?php
                    }
                ?>
                <span class="divider"></span>
            </div>
            <div id="bottom">
                <span id="backtoHome" class="backtoHome">
                    <span class="arrowSpan arrowSpanBTH"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
                    <span class="footerLink">Terug naar homepagina</span>
                </span>
                <span id="backLine"></span>
                <span id="backtoTop" class="backtoTop">
                    <span class="footerLink">Terug naar boven</span>
                    <span class="arrowSpan arrowSpanBTT"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
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