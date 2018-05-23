<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_GET['c'])) {
    if (!empty($_GET['c'])) {
        $shortArray = array();
        $query = $PDO->prepare('SELECT short, name, preview FROM categories');
        $query->execute();
        $categories = $query->fetchAll();
        
        foreach ($categories as $category) { 
            array_push($shortArray, $category['short']); 
        }
        if (in_array($_GET['c'], $shortArray)) {
            $short = $_GET['c'];
            $page = $short;
            
            $query = $PDO->prepare('SELECT name, text, rubrix FROM categories WHERE short = ?');
            $query->bindValue(1, $short);
            $query->execute();
            $result = $query->fetchAll();
            $currentCategory = $result[0];
            
            $query = $PDO->prepare('SELECT id FROM categories WHERE short = ?');
            $query->bindValue(1, $short);
            $query->execute();
            $categoryID = $query->fetch(PDO::FETCH_COLUMN, 0);

            $query = $PDO->prepare('SELECT id, name, description, preview, sprint, spotlight FROM items WHERE category = ? ORDER BY sprint ASC');
            $query->bindValue(1, $categoryID);
            $query->execute();
            $items = $query->fetchAll();
            
            $query = $PDO->prepare('SELECT id FROM categories WHERE short = ?');
            $query->bindValue(1, $short);
            $query->execute();
            $result = $query->fetch();
            $categoryID = $result[0];
            
            $query = $PDO->prepare('SELECT * FROM items WHERE category = ? AND spotlight = 1');
            $query->bindValue(1, $categoryID);
            $query->execute();
            $HasSpotlight = $query->rowCount() ? true : false;
?>
<html lang="nl">
    <head>
        <title><?= $short; ?> | Max Altena</title>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="/css/categoriestyle.css">
    </head>

    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/loader.php'); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/menu.php'); ?>
        <main>
            <div id="top">
                <div id="topTitle">
                    <h1><?= $currentCategory['name']." (<span class='accent'>".$short."</span>)"; ?></h1>
                </div>
                <div id="topContent">
                    <?php
                        $currentCategory['text'];

                        $text = explode('|', $currentCategory['text']);

                        foreach ($text as $value) {
                            ?>
                                <p><?= $value; ?></p>
                            <?php
                        }
                    ?>
                </div>
                <?php if ($currentCategory['rubrix'] == 1) { ?>
                <div id="topRubrix">
                    <a href="/rubrix?r=<?= $short; ?>" class="aLink">
                        <div id="rubrixLink">
                            <span class="textSpan">Rubrix van <span class="accent"><?= $short; ?></span></span>
                            <span class="arrowSpan arrowSpanRubrix">
                                <svg viewBox="0 0 24 24" class="arrow">
                                    <path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                </div>
                <?php
                    }
                ?>
            </div>
            <div id="center">
        <?php
            if ($HasSpotlight == "1"){
        ?>
                <div id="spotlight">
                    <h1>Uitgelichte opdrachten</h1>
                    <svg viewBox="0 0 60 15" id="separator">
                        <polyline class="coolLine" points="5,4.5 11.2,10.5 17.5,4.5 23.7,10.5 30,4.5 36.2,10.5 42.5,4.5 48.8,10.5 55,4.5"/>
                    </svg>
                </div>
                <div id="spotlightContent">
        <?php
                foreach ($items as $item){
                    if ($item['spotlight'] == 1){
                        $highID = $item['id'] + 10000;
        ?>
                    <a href="/item?i=<?= $item['name']; ?>" class="aLink">
                        <div class="itemLink" id="itemLink<?= $highID; ?>">
                            <div class="section">
                                <div class="firstClass">
                                    <h1><?= $item['name']; ?></h1>
                                    <h2><?= $item['description']; ?></h2>
                                </div>
                                <div>
                                    <span class="arrowSpan">
                                        <svg viewBox="0 0 24 24" class="arrow">
                                            <path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
                            $query = $PDO->prepare('SELECT name FROM media WHERE id = ?');
                            $query->bindValue(1, $item['preview']);
                            $query->execute();
                            $result = $query->fetch();
                            $photoInsert = $result['name'];

                            if ($photoInsert !== null) {
                ?>
                               <script>$("#itemLink<?= $highID; ?>").css({background: "url(/assets/media/<?= $photoInsert; ?>)", 'background-position': "center center"})</script>
                <?php
                            }
                    }
                }
        ?>
                </div>
        <?php
            }  
        ?>
                <div id="filter"></div>
        <?php
                    $sprintCounter = 0;
                    $sprints = false;
                    foreach ($items as $item) {
                        if ($item['sprint'] == null) {
        ?>
                            <a href="/item?i=<?= $item['name']; ?>" class="aLink">
                                <div class="itemLink item" id="itemLink<?= $item['id']; ?>">
                                    <div class="section">
                                        <div class="firstClass">
                                            <h1><?= $item['name']; ?></h1>
                                            <h2><?= $item['description']; ?></h2>
                                        </div>
                                        <div>
                                            <span class="arrowSpan">
                                                <svg viewBox="0 0 24 24" class="arrow">
                                                    <path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                <?php
                            $query = $PDO->prepare('SELECT name FROM media WHERE id = ?');
                            $query->bindValue(1, $item['preview']);
                            $query->execute();
                            $result = $query->fetch();
                            $photoInsert = $result['name'];

                            if ($photoInsert !== null) {
                ?>
                               <script>$("#itemLink<?= $item['id']; ?>").css({background: "url(/assets/media/<?= $photoInsert; ?>)", 'background-position': "center center"})</script>
                <?php
                            }
                        }
                        else {
                            $sprints = true;
                            if ($item['sprint'] == $sprintCounter) {
                ?>
                            <a href="/item?i=<?= $item['name']; ?>" class="aLink">
                                <div class="itemLink item itemSprint<?= $item['sprint']; ?>" id="itemLink<?= $item['id']; ?>">
                                    <div class="section">
                                        <div class="firstClass">
                                            <h1><?= $item['name']; ?></h1>
                                            <h2><?= $item['description']; ?></h2>
                                        </div>
                                        <div>
                                            <span class="arrowSpan">
                                                <svg viewBox="0 0 24 24" class="arrow">
                                                    <path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                <?php
                                $query = $PDO->prepare('SELECT name FROM media WHERE id = ?');
                                $query->bindValue(1, $item['preview']);
                                $query->execute();
                                $result = $query->fetch();
                                $photoInsert = $result['name'];

                                if ($photoInsert !== null) {
                ?>
                                    <script>$("#itemLink<?= $item['id']; ?>").css({background: "url(/assets/media/<?= $photoInsert; ?>)", 'background-position': "center center"})</script>
                <?php
                                }
                            }
                            else {
                                $sprintCounter = $item['sprint'];  
                ?>
                                <div class="sprintHeader item itemSprint<?= $item['sprint']; ?>" id="sprintHeader<?= $item['sprint']; ?>">
                                    <h1>Sprint <span class="accent"><?= $item['sprint']; ?></span></h1>

                                    <svg viewBox="0 0 60 15" id="separator">
                                        <polyline class="coolLine" points="5,4.5 11.2,10.5 17.5,4.5 23.7,10.5 30,4.5 36.2,10.5 42.5,4.5 48.8,10.5 55,4.5"/>
                                    </svg>
                                </div>

                                <a href="/item?i=<?= $item['name']; ?>" class="aLink">
                                    <div class="itemLink item itemSprint<?= $item['sprint']; ?>" id="itemLink<?= $item['id']; ?>">
                                        <div class="section">
                                            <div class="firstClass">
                                                <h1><?= $item['name']; ?></h1>
                                                <h2><?= $item['description']; ?></h2>
                                            </div>
                                            <div>
                                                <span class="arrowSpan">
                                                    <svg viewBox="0 0 24 24" class="arrow">
                                                        <path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                <?php
                                $query = $PDO->prepare('SELECT name FROM media WHERE id = ?');
                                $query->bindValue(1, $item['preview']);
                                $query->execute();
                                $result = $query->fetch();
                                $photoInsert = $result['name'];

                                if ($photoInsert !== null) {
                ?>
                                    <script>$("#itemLink<?= $item['id']; ?>").css({background: "url(/assets/media/<?= $photoInsert; ?>)", 'background-position': "center center"})</script>
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
                                $(".item").show("blind", { direction: "vertical" }, 750);
                            }
                            else {
                                var itemSprint = ".itemSprint" + filter;
                                $(".item:not("+itemSprint+")").hide("blind", { direction: "vertical" }, 750);
                                $(".item"+itemSprint).show("blind", { direction: "vertical" }, 750);
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
                <a href="../" class="bLink">
                    <span id="backtoHome" class="backtoHome">
                        <span class="arrowSpan arrowSpanBTH"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
                        <span class="footerLink">Terug naar homepagina</span>
                    </span>
                </a>
                <span id="backLine"></span>
                <span id="backtoTop" class="backtoTop">
                    <span class="footerLink">Terug naar boven</span>
                    <span class="arrowSpan arrowSpanBTT"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
                </span>
            </div>
        </main>
        <script src="/js/category.js"></script>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/menuselect.php'); ?>
    </body>
</html>
<?php
        }
        else {
            header('Location: ../');
            exit();
        }
    }
    else {
        header('Location: ../');
        exit();
    }
}
else {
    header('Location: ../');
    exit();
}
?>