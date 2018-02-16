<?php

include_once('includes/connection.php');
include_once('includes/query.php');

$rubrix = new Rubrix;
$rubrixs = $rubrix->fetch();

if (isset($_GET['r'])) {
    if (!empty($_GET['r'])) {
        $rubrixArray = array();
        
        foreach ($rubrixs as $rubrix) { 
            array_push($rubrixArray, $rubrix['rubrix_id']); 
        }
        if (in_array($_GET['r'], $rubrixArray)) {
            $rubrixID = $_GET['r'];
            
            $getRubrix = new Rubrix;
            $currentRubrix = $getRubrix->fetch_rubrix($rubrixID);
            
            $getCategory = new Category;
            $currentCategory = $getCategory->fetch_by_rubrix($rubrixID);
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
            <div>
                <h1>Rubrix voor <?= $currentCategory['name']; ?></h1>
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
                    <td><?= $value[0]; ?></td>
                    <td><?= $value[1]; ?></td>
                    <td><?= $value[2]; ?></td>
                    <td><?= $value[3]; ?></td>
                    <td><?= $value[4]; ?></td>
                </tr>
        <?php
            }
        ?>
                </table>
                <a href="https://i371527.hera.fhict.nl/categorie?c=<?= $currentCategory['short']; ?>" class="terug"><span class="arrowSpan arrowSpanRubrix"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg></span><span class="textSpan">Terug naar <?= $currentCategory['short']; ?></span></a>
            </div>
            <script>
                // Selected values from Database highlight
            </script>
        </main>
        <script src="js/menu.js"></script>
        <script src="js/rubrix.js"></script>
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