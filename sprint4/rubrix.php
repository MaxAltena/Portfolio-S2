<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/connection.php');

if (isset($_GET['r'])) {
    if (!empty($_GET['r'])) {
        $rubrixArray = array();
        $query = $PDO->prepare('SELECT DISTINCT name FROM rubrix');
        $query->execute();
        $rubrixs = $query->fetchAll();
        
        foreach ($rubrixs as $rubrix) { 
            array_push($rubrixArray, $rubrix['name']); 
        }
        if (in_array($_GET['r'], $rubrixArray)) {
            $short = $_GET['r'];
            
            $query = $PDO->prepare('SELECT * FROM rubrix WHERE name = ?');
            $query->bindValue(1, $short);
            $query->execute();
            $currentRubrix = $query->fetchAll();
            
            $query = $PDO->prepare('SELECT name, short FROM categories WHERE short = ?');
            $query->bindValue(1, $short);
            $query->execute();
            $result = $query->fetchAll();
            $currentCategory = $result[0];
?>
<html lang="nl">
    <head>
        <title>Rubrix <?= $currentCategory['short']; ?> | Max Altena</title>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="/sprint4/css/rubrixstyle.css">
    </head>

    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/loader.php'); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/menu.php'); ?>
        <main>
            <div id="rubrixHeader">
                <h1>Rubrix voor <?= $currentCategory['name']; ?> (<span class="accent"><?= $currentCategory['short']; ?></span>)</h1>
            </div>
            <div id="rubrixContent">
                <table>
                    <tr>
                        <th>Criterium</th>
                        <th>Zeer goed</th>
                        <th>Goed</th>
                        <th>Voldoende</th>
                        <th>Onvoldoende</th>
                    </tr>
        <?php
            foreach ($currentRubrix as $value) {
        ?>
                <tr>
                    <td class="criterium criterium<?= $value['id']; ?>"><?= $value['criterium']; ?></td>
                    <td class="zeer zeer<?= $value['id']; ?>"><?= $value['zeer']; ?></td>
                    <td class="goed goed<?= $value['id']; ?>"><?= $value['goed']; ?></td>
                    <td class="voldoende voldoende<?= $value['id']; ?>"><?= $value['voldoende']; ?></td>
                    <td class="onvoldoende onvoldoende<?= $value['id']; ?>"><?= $value['onvoldoende']; ?></td>
                </tr>
                <div class="opinionBlock" id="opinion<?= $value['id']; ?>" style="display: none;"><p><?= $value['opinion']; ?></p></div>
                <script>
                    $(".<?= $value['value'].$value['id']; ?>").addClass("selected");
                    $(".<?= $value['value'].$value['id']; ?>.selected").on({
                        mousemove: function(e){
                            var top = e.pageY + 10;
                            var left = e.pageX - 265;
                            $("#opinion<?= $value['id']; ?>").css({top: top, left: left });
                        },
                        mouseenter: function(e){
                            $("#opinion<?= $value['id']; ?>").css({ display: "block" });
                        },
                        mouseleave: function(){
                            $("#opinion<?= $value['id']; ?>").css({ display: "none" });
                        }
                    });
                </script>
        <?php
            }
        ?>
                </table>
            </div>
            <div id="rubrixTerug">
                <a href="/sprint4/categorie?c=<?= $currentCategory['short']; ?>">
                    <div class="terug">
                        <span class="arrowSpan arrowSpanRubrix"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span><span class="textSpan">Terug naar <span class="accent"><?= $currentCategory['short']; ?></span></span>
                    </div>
                </a>
            </div>
        </main>
        <script src="/sprint4/js/rubrix.js"></script>
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