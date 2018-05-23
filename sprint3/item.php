<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint3/includes/connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint3/includes/query.php');

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
                return implode($underlineArray);
            }
?>
<html lang="nl">
    <head>
        <title><?= $currentItem['name']; ?> | Max Altena</title>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint3/includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="/sprint3/css/itemstyle.css">
    </head>

    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint3/includes/loader.php'); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint3/includes/menu.php'); ?>
        <main>
            <div id="content">
                <small class="alert">Op dit moment zijn er nog geen foto's, documenten of media toegevoegd aan de opdrachten</small>

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
                        <h3 id="opdrachtH">Opdracht</h3>
                    <?php
                        $text = styleText($currentItem['opdracht']);

                        $paragraph = explode('|', $text);

                        foreach ($paragraph as $value) {
                            ?>
                                <p class="opdrachtP"><?= $value; ?></p>
                            <?php
                        }
                    }

                    if ($currentItem['uitvoering'] !== null) {
                    ?>
                        <h3 id="uitvoeringH">Uitvoering</h3>
                    <?php
                        $text = styleText($currentItem['uitvoering']);

                        $paragraph = explode('|', $text);

                        foreach ($paragraph as $value) {
                            ?>
                                <p class="uitvoeringP"><?= $value; ?></p>
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
                    $("body").css({position: "absolute", left: 0});
                    var width = $("body").width();
                    $("body").animate({left: width}, 500, "easeInOutCubic", function(){
                        setTimeout(function(){
                            window.location = "/sprint3/categorie?c=<?= $currentCategory['short']; ?>";
                        }, 500);
                    });
                });
            });
        </script>
        <script src="/sprint3/js/item.js"></script>
    </body>
</html>
<?php
        }
        else {
            header('Location: /sprint3/');
            exit();
        }
    }
    else {
        header('Location: /sprint3/');
        exit();
    }
}
else {
    header('Location: /sprint3/');
    exit();
}
?>