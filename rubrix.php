<?php
session_start();
include_once('includes/connection.php');
include_once('includes/query.php');

if (isset($_GET['r'])) {
    if (!empty($_GET['r'])) {
        $rubrixArray = array();
        $rubrix = new Rubrix;
        $rubrixs = $rubrix->fetch();
        
        foreach ($rubrixs as $rubrix) { 
            array_push($rubrixArray, $rubrix['name']); 
        }
        if (in_array($_GET['r'], $rubrixArray)) {
            $short = $_GET['r'];
            
            $getRubrix = new Rubrix;
            $currentRubrix = $getRubrix->fetch_rubrix($short);
            
            $getCategory = new Category;
            $currentCategory = $getCategory->fetch_for_rubrix($short);
?>
<html lang="nl">
    <head>
        <title>Rubrix <?= $currentCategory['short']; ?> | Max Altena</title>
        <?php include_once('includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/rubrixstyle.css">
    </head>

    <body>
        <?php include_once('includes/loader.php'); ?>
        <?php include_once('includes/menu.php'); ?>
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
                <div class="terug">
                    <span class="arrowSpan arrowSpanRubrix"><svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span><span class="textSpan">Terug naar <span class="accent"><?= $currentCategory['short']; ?></span></span>
                    <script>$(".terug").on("click", function(){ window.location = "/categorie?c=<?= $currentCategory['short']; ?>";});</script>
                </div>
            </div>
        </main>
        <script src="js/rubrix.js"></script>
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