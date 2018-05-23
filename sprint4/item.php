<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/connection.php');

if (isset($_GET['i'])) {
    if (!empty($_GET['i'])) {
        $itemArray = array();
        
        $query = $PDO->prepare('SELECT name FROM items');
        $query->execute();
        $items = $query->fetchAll();
        
        foreach ($items as $item) { 
            array_push($itemArray, $item['name']); 
        }
        if (in_array($_GET['i'], $itemArray)) {
            $name = $_GET['i'];
            
            $query = $PDO->prepare('SELECT * FROM items WHERE name = ?');
            $query->bindValue(1, $name);
            $query->execute();
            $currentItem = $query->fetch();
            
            $query = $PDO->prepare('SELECT category FROM items WHERE name = ?');
            $query->bindValue(1, $name);
            $query->execute();
            $categoryID = $query->fetch(PDO::FETCH_COLUMN, 0);

            $query = $PDO->prepare('SELECT name, short FROM categories WHERE id = ?');
            $query->bindValue(1, $categoryID);
            $query->execute();
            $currentCategory = $query->fetch();
            
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
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="/sprint4/css/itemstyle.css">
    </head>

    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/loader.php'); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/menu.php'); ?>
        <main>
            <div id="wrapper">
                <div id="content">
                    <h1 id="cat"><?= $currentCategory['name'];?> (<span class="accent"><?= $currentCategory['short'] ?></span>)</h1>
                    <h2 id="name"><?= $currentItem['name']; ?></h2>
            <?php
                    if ($currentItem['description'] !== null) {
                        ?>
                            <small class="descriptionS"><?= $currentItem['description']; ?></small>
                        <?php
                        }
                    
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
                </div>
            <?php
                if ($currentItem['media'] !== null) {
            ?>
                <div id="media">
                    <div id="image"></div>
            <?php
                    $mediaIDs = explode('|', $currentItem['media']);

                    if (count($mediaIDs) > 1) {
            ?>
                        <div id="prev">&#10094;</div>
                        <div id="next">&#10095;</div>
            <?php
                        $images = array();
                        foreach($mediaIDs as $mediaID){
                            $query = $PDO->prepare('SELECT name FROM media WHERE id = ? and type = ?');
                            $query->bindValue(1, $mediaID);
                            $query->bindValue(2, "IMG");
                            $query->execute();
                            $result = $query->fetch();
                            $image = $result['name'];
                            $images[] = $image;
                        }
            ?>
                        <script>
                            var images = <?= json_encode($images); ?>;
                            var index = 1;
                            imageSlider(index);

                            $("#prev").on("click", function(){
                              imageSlider(index += -1);
                            });

                            $("#next").on("click", function(){
                              imageSlider(index += 1);
                            });

                            function imageSlider(x){
                              if (x > images.length) { index = 1 }
                              if (x < 1) { index = images.length }

                              $('#image').fadeTo(250, 0, function(){
                                $(this).css('background-image', 'url(/sprint4/assets/media/' + images[index - 1] + ')');
                              }).fadeTo(250, 1);
                            }
                        </script>
            <?php
                    }
                    else {
                        $query = $PDO->prepare('SELECT name FROM media WHERE id = ? and type = ?');
                        $query->bindValue(1, $currentItem['media']);
                        $query->bindValue(2, "IMG");
                        $query->execute();
                        $result = $query->fetch();
                        $image = $result['name'];
            ?>
                        <script>
                            $("#image").css({"background-image": "url(/sprint4/assets/media/<?= $image; ?>)"});
                        </script>
            <?php
                    }
            ?>
                </div>
            <?php
                }
                
                if ($currentItem['document'] !== null) {
                    $query = $PDO->prepare('SELECT name FROM media WHERE id = ? and type = ?');
                    $query->bindValue(1, $currentItem['document']);
                    $query->bindValue(2, "DOC");
                    $query->execute();
                    $result = $query->fetch();
                    $document = $result['name'];
            ?>
                    <a href="/sprint4/assets/media/<?= $document; ?>" id="document">
                        <svg viewBox="0 0 60 60" id="fileIcon">
                            <path d="M42.5,22h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S43.052,22,42.5,22z"/>
                            <path d="M17.5,16h10c0.552,0,1-0.447,1-1s-0.448-1-1-1h-10c-0.552,0-1,0.447-1,1S16.948,16,17.5,16z"/>
                            <path d="M42.5,30h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S43.052,30,42.5,30z"/>
                            <path d="M42.5,38h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S43.052,38,42.5,38z"/>
                            <path d="M42.5,46h-25c-0.552,0-1,0.447-1,1s0.448,1,1,1h25c0.552,0,1-0.447,1-1S43.052,46,42.5,46z"/>
                            <path d="M38.914,0H6.5v60h47V14.586L38.914,0z M39.5,3.414L50.086,14H39.5V3.414z M8.5,58V2h29v14h14v42H8.5z"/>
                        </svg>
            <?php
                        
            ?>
                       <p id="fileText"><?= $document; ?></p>
                       <script>
                            $("#document").on({
                                mouseenter: function(){
                                    $("#fileText").css({"text-decoration": "line-through"});
                                },
                                mouseleave: function(){
                                    $("#fileText").css({"text-decoration": "underline"});
                                }
                            });
                        </script>
                    </a>
            <?php
                    }
                
                if ($currentItem['video'] !== null) {
                    $query = $PDO->prepare('SELECT name FROM media WHERE id = ? and type = ?');
                    $query->bindValue(1, $currentItem['video']);
                    $query->bindValue(2, "VID");
                    $query->execute();
                    $result = $query->fetch();
                    $video = $result['name'];
            ?>
                    <a href="/sprint4/assets/media/<?= $video; ?>" id="video">
                        <svg viewBox="0 0 58 58" id="videoIcon">
                            <path d="M36.537,28.156l-11-7c-0.308-0.195-0.698-0.208-1.019-0.033C24.199,21.299,24,21.635,24,22v14c0,0.365,0.199,0.701,0.519,0.877C24.669,36.959,24.834,37,25,37c0.187,0,0.374-0.053,0.537-0.156l11-7C36.825,29.66,37,29.342,37,29S36.825,28.34,36.537,28.156z M26,34.179V23.821L34.137,29L26,34.179z"/>
                            <path d="M57,6H47H11H1C0.448,6,0,6.447,0,7v11v11v11v11c0,0.553,0.448,1,1,1h10h36h10c0.552,0,1-0.447,1-1V40V29V18V7C58,6.447,57.552,6,57,6z M10,28H2v-9h8V28z M2,30h8v9H2V30z M12,40V29V18V8h34v10v11v11v10H12V40z M56,28h-8v-9h8V28z M48,30h8v9h-8V30z M56,8v9h-8V8H56z M2,8h8v9H2V8z M2,50v-9h8v9H2z M56,50h-8v-9h8V50z"/>
                        </svg>
            <?php
                        
            ?>
                       <p id="videoText"><?= $video; ?></p>
                       <script>
                            $("#video").on({
                                mouseenter: function(){
                                    $("#videoText").css({"text-decoration": "line-through"});
                                },
                                mouseleave: function(){
                                    $("#videoText").css({"text-decoration": "underline"});
                                }
                            });
                        </script>
                    </a>
            <?php
                    }
                
                if (($currentItem['media'] !== null) && ($currentItem['document'] !== null) && ($currentItem['video'] !== null)){
            ?>
                    <style>
                        #wrapper {
                            grid-template-rows: 1fr 0.1fr 0.5fr 0.1fr 0.5fr 0.25fr;
                            grid-template-areas: 
                                "content . media"
                                "content . ."
                                "content . document"
                                "content . ."
                                "content . video"
                                "content . .";
                        }
                    </style>
            <?php
                }
                elseif (($currentItem['media'] == null) && ($currentItem['document'] !== null) && ($currentItem['video'] !== null)) {
            ?>
                    <style>
                        #wrapper {
                            grid-template-rows: 0.5fr 0.1fr 0.5fr 0.5fr;
                            grid-template-areas: 
                                "content . document"
                                "content . ."
                                "content . video"
                                "content . .";
                        }
                    </style>
            <?php
                }
                elseif (($currentItem['media'] !== null) && ($currentItem['document'] == null) && ($currentItem['video'] !== null)) {
            ?>
                    <style>
                        #wrapper {
                            grid-template-rows: 0.5fr 0.1fr 0.5fr 0.5fr;
                            grid-template-areas: 
                                "content . media"
                                "content . ."
                                "content . video"
                                "content . .";
                        }
                    </style>
            <?php
                }
                elseif (($currentItem['media'] !== null) && ($currentItem['document'] !== null) && ($currentItem['video'] == null)) {
            ?>
                    <style>
                        #wrapper {
                            grid-template-rows: 0.5fr 0.1fr 0.5fr 0.5fr;
                            grid-template-areas: 
                                "content . media"
                                "content . ."
                                "content . document"
                                "content . .";
                        }
                    </style>
            <?php
                }
                elseif (($currentItem['media'] == null) && ($currentItem['document'] == null) && ($currentItem['video'] !== null)) {
            ?>
                    <style>
                        #wrapper {
                            grid-template-rows: 0.5fr 1fr;
                            grid-template-areas: 
                                "content . video"
                                "content . .";
                        }
                    </style>
            <?php
                }
                elseif (($currentItem['media'] == null) && ($currentItem['document'] !== null) && ($currentItem['video'] == null)) {
            ?>
                    <style>
                        #wrapper {
                            grid-template-rows: 0.5fr 1fr;
                            grid-template-areas: 
                                "content . document"
                                "content . .";
                        }
                    </style>
            <?php
                }
                elseif (($currentItem['media'] !== null) && ($currentItem['document'] == null) && ($currentItem['video'] == null)) {
            ?>
                    <style>
                        #wrapper {
                            grid-template-rows: 0.5fr 1fr;
                            grid-template-areas: 
                                "content . media"
                                "content . .";
                        }
                    </style>
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
                            <a href="/sprint4/item?i=<?= $result[0]['name']; ?>" class="aLink">
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
                            </a>
            <?php
                            $query = $PDO->prepare('SELECT name FROM media WHERE id = ?');
                            $query->bindValue(1, $result[0]['preview']);
                            $query->execute();
                            $foto = $query->fetch();
                            $photoInsert = $foto['name'];

                            if ($photoInsert !== null) {
            ?>
                                <script>$("#itemLink<?= $result[0]['id']; ?>").css({background: "url(/sprint4/assets/media/<?= $photoInsert; ?>)", 'background-position': "center center"})</script>
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
                <a href="/sprint4/categorie?c=<?= $currentCategory['short']; ?>" class="bLink">
                    <span id="backtoCat" class="backtoCat">
                        <span class="arrowSpan arrowSpanBTC"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
                        <span class="footerLink">Terug naar <?= $currentCategory['name']; ?> (<span class="accent"><?= $currentCategory['short']; ?></span>)</span>
                    </span>
                </a>
                <span id="backLine"></span>
                <span id="backtoTop" class="backtoTop">
                    <span class="footerLink">Terug naar boven</span>
                    <span class="arrowSpan arrowSpanBTT"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span>
                </span>
            </div>
        </main>
        <script src="/sprint4/js/item.js"></script>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/menuselect.php'); ?>
    </body>
</html>
<?php
        }
        else {
            header('Location: /sprint4/');
            exit();
        }
    }
    else {
        header('Location: /sprint4/');
        exit();
    }
}
else {
    header('Location: /sprint4/');
    exit();
}
?>