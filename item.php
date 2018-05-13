<?php
session_start();
include_once('includes/connection.php');
include_once('includes/query.php');

if (isset($_GET['i'])) {
    if (!empty($_GET['i'])) {
        $itemArray = array();
        $item = new Item;
        $items = $item->fetch_names();
        
        foreach ($items as $item) { 
            array_push($itemArray, $item['name']); 
        }
        if (in_array($_GET['i'], $itemArray)) {
            $name = $_GET['i'];
            
            $getItem = new Item;
            $currentItem = $getItem->fetch_item($name);
            
            $getCategory = new Category;
            $currentCategory = $getCategory->fetch_by_item($name);
            $page = $currentCategory['short'];
            
            function styleText($text) {
                $boldArray = explode('*', $text);
                $boldCount = 0;
                foreach ($boldArray as $string) {
                    if ($string !== null) {
                        if ($boldCount % 2 !== 0) {
                            $boldArray[$boldCount] = "<span class='bold'>" . $string . "</span>";
                        }
                        $boldCount++;
                    }
                    else {
                        break;
                    }
                }
                $text = implode($boldArray);

                $italicArray = explode('~', $text);
                $italicCount = 0;
                foreach ($italicArray as $string) {
                    if ($string !== null) {
                        if ($italicCount % 2 !== 0) {
                            $italicArray[$italicCount] = "<span class='italic'>" . $string . "</span>";
                        }
                        $italicCount++;
                    }
                    else {
                        break;
                    }
                }
                $text = implode($italicArray);

                $underlineArray = explode('_', $text);
                $underlineCount = 0;
                foreach ($underlineArray as $string) {
                    if ($string !== null) {
                        if ($underlineCount % 2 !== 0) {
                            $underlineArray[$underlineCount] = "<span class='underline'>" . $string . "</span>";
                        }
                        $underlineCount++;
                    }
                    else {
                        break;
                    }
                }
                $text = implode($underlineArray);
                
                $linkArray = explode('[]', $text);
                $linkCount = 0;
                foreach ($linkArray as $string) {
                    if ($string !== null) {
                        if ($linkCount % 2 !== 0) {
                            $linkArray[$linkCount] = "<a class='link' href=".$string." target='_blank'>" . $string . "</a>";
                        }
                        $linkCount++;
                    }
                    else {
                        break;
                    }
                }
                $text = implode($linkArray);
                
                return $text;
            }
?>
<html lang="nl">
    <head>
        <title><?= $currentItem['name']; ?> | Max Altena</title>
        <?php include_once('includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/itemstyle.css">
    </head>

    <body>
        <?php include_once('includes/loader.php'); ?>
        <?php include_once('includes/menu.php'); ?>
        <main>
            <div id="content">
                <h1 id="cat"><?= $currentCategory['name'];?> (<span class="accent"><?= $currentCategory['short'] ?></span>)</h1>
                <h2 id="name"><?= $currentItem['name']; ?></h2>
                <?php
                    if ($currentItem['description'] !== null) {
                    ?>
                        <small class="descriptionS"><?= $currentItem['description']; ?></small>
                    <?php
                    }
                    ?>
                    <?php
                    if ($currentItem['opdracht'] !== null) {
                    ?>
                        <h3>Opdracht</h3>
                    <?php
                        $text = styleText($currentItem['opdracht']);

                        $paragraph = explode('|', $text);

                        foreach ($paragraph as $value) {
                            ?>
                                <p><?= $value; ?></p>
                            <?php
                        }
                    }
                    
                    if ($currentItem['uitvoering'] !== null) {
                    ?>
                        <h3>Uitvoering</h3>
                    <?php
                        $text = styleText($currentItem['uitvoering']);

                        $paragraph = explode('|', $text);

                        foreach ($paragraph as $value) {
                            ?>
                                <p><?= $value; ?></p>
                            <?php
                        }
                    }
                    
                    if ($currentItem['feedback'] !== null) {
                    ?>
                        <h3>Feedback</h3>
                    <?php
                         $text = styleText($currentItem['feedback']);

                        $paragraph = explode('|', $text);

                        foreach ($paragraph as $value) {
                            ?>
                                <p><?= $value; ?></p>
                            <?php
                        }
                    }
                    
                    if ($currentItem['reflectie'] !== null) {
                    ?>
                        <h3>Reflectie</h3>
                    <?php
                        $text = styleText($currentItem['reflectie']);

                        $paragraph = explode('|', $text);

                        foreach ($paragraph as $value) {
                            ?>
                                <p><?= $value; ?></p>
                            <?php
                        }
                    }
                ?>
                
                <?php
                if ($currentItem['media'] !== null) {
            ?>
                    <div id="media">
            <?php
                        $mediaIDs = explode('|', $currentItem['media']);

                        foreach ($itemIDs as $itemID) {
                            $query = $PDO->prepare('SELECT id, name, description, preview, sprint FROM items WHERE id = ?');
                            $query->bindValue(1, $itemID);
                            $query->execute();
                            $result = $query->fetchAll();
            ?>
                            <div class="itemLink item itemSprint<?= $result[0]['sprint']; ?>" id="itemLink<?= $result[0]['id']; ?>">
                                <div class="section">
                                    <div class="firstClass">
                                        <h1><?= $result[0]['name']; ?></h1>
                                        <h2><?= $result[0]['description']; ?></h2>
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
                            <script>$("#itemLink<?= $result[0]['id']; ?>").on("click", function(){ window.location = "/item?i=<?= $result[0]['name']; ?>";});</script>
            <?php
                            $photo = new Photo;
                            $photoInsert = $photo->fetch_by_id($result[0]['preview']);

                            if ($photoInsert !== null) {
            ?>
                                <script>$("#itemLink<?= $result[0]['id']; ?>").css({background: "url(/assets/media/<?= $photoInsert; ?>)", 'background-position': "center center"})</script>
            <?php
                            }
                        }
            ?>
                        </div>
                    </div>
            <?php
                }
            ?>
            </div>
            <?php
                if ($currentItem['related'] !== null) {
            ?>
                    <div id="related">
                        <div class="relatedHeader "id="relatedHeader<?= $currentItem['name']; ?>">
                            <h1 id="relatedH1">Verwante opdrachten van <span class="accent"><?= $currentItem['name']; ?></span></h1>
                            <svg viewBox="0 0 60 15" id="separator">
                                <polyline class="coolLine" points="5,4.5 11.2,10.5 17.5,4.5 23.7,10.5 30,4.5 36.2,10.5 42.5,4.5 48.8,10.5 55,4.5"/>
                            </svg>
                        </div>
                        <div id="relatedItems">
            <?php
                        $itemIDs = explode('|', $currentItem['related']);

                        foreach ($itemIDs as $itemID) {
                            $query = $PDO->prepare('SELECT id, name, description, preview, sprint FROM items WHERE id = ?');
                            $query->bindValue(1, $itemID);
                            $query->execute();
                            $result = $query->fetchAll();
            ?>
                            <div class="itemLink item itemSprint<?= $result[0]['sprint']; ?>" id="itemLink<?= $result[0]['id']; ?>">
                                <div class="section">
                                    <div class="firstClass">
                                        <h1><?= $result[0]['name']; ?></h1>
                                        <h2><?= $result[0]['description']; ?></h2>
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
                            <script>$("#itemLink<?= $result[0]['id']; ?>").on("click", function(){ window.location = "/item?i=<?= $result[0]['name']; ?>";});</script>
            <?php
                            $photo = new Photo;
                            $photoInsert = $photo->fetch_by_id($result[0]['preview']);

                            if ($photoInsert !== null) {
            ?>
                                <script>$("#itemLink<?= $result[0]['id']; ?>").css({background: "url(/assets/media/<?= $photoInsert; ?>)", 'background-position': "center center"})</script>
            <?php
                            }
                        }
            ?>
                        </div>
                    </div>
            <?php
                }
            ?>
            <div id="bottom">
                <span id="backtoCat" class="backtoCat">
                    <span class="arrowSpan arrowSpanBTC"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
                    <span class="footerLink">Terug naar <?= $currentCategory['name']; ?> (<span class="accent"><?= $currentCategory['short']; ?></span>)</span>
                </span>
                <span id="backLine"></span>
                <span id="backtoTop" class="backtoTop">
                    <span class="footerLink">Terug naar boven</span>
                    <span class="arrowSpan arrowSpanBTT"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
                </span>
            </div>
        </main>
        <script>
            $(document).ready(function(){
                $(".backtoCat").on("click", function(){
                    window.location = "/categorie?c=<?= $currentCategory['short']; ?>";
                });
            });
        </script>
        <script src="js/item.js"></script>
        <?php include_once('includes/menuselect.php'); ?>
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