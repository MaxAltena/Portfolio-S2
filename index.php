<?php
session_start();
include_once('includes/connection.php');
include_once('includes/query.php');

$category = new Category;
$categories = $category->fetch();

$page = "Home";

?>

<html lang="nl">
    <head>
        <title>Portfolio | Max Altena</title>
        <?php include_once('includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/indexstyle.css">
    </head>

    <body>
        <?php include_once('includes/loader.php'); ?>
        <?php include_once('includes/menu.php'); ?>
        <main>
            <div id="splash"> <!-- Cool entry game/inspiratieweek? -->
                <div id="splash_overlay">
                    <div>
                        <h1>Max Altena</h1>
                        <h2>ICT & Media Design student</h2>
                    </div>
                </div>
                <div id="ScrollDown"><span></span></div>
            </div>
            <div id="home">
                <div>
                    <h1>Over <span class="accent">Max Altena</span></h1>
                    <svg viewBox="0 0 60 15" id="separator"><polyline class="coolLine" points="5,4.5 11.2,10.5 17.5,4.5 23.7,10.5 30,4.5 36.2,10.5 42.5,4.5 48.8,10.5 55,4.5"/></svg>
                    <p>Ik ben Max Altena, een 19 jarige jongen uit Best. Ik studeer ICT &amp; Media Design op de Fontys hogeschool in Eindhoven. Hier leer ik van alles dat te maken heeft met ICT maar ook met Media en Design. Van hoe je een website maakt tot aan hoe je een poster designt. Dit zal mij verder helpen in mijn carrière als ICT'er en als persoon. Ik vind het leuk dat je op mijn portfolio zit, veel plezier!</p>
                </div>
                <img src="assets/maxs.png" alt="Profielfoto" id="profilephoto" />
            </div>
            <div id="categories">
                <?php
                foreach ($categories as $category) {
                ?>
                    <div class="categorieLink" id="categorieLink<?= $category['short']; ?>">
                        <div class="section">
                            <div class="firstClass">
                                <h1><?= $category['short']; ?></h1>
                                <h2><?= $category['name']; ?></h2>
                            </div>
                            <div>
                                <span class="arrowSpan">
                                    <svg viewBox="0 0 24 24" class="arrow"><path class="arrowPath" d="M24 11.871l-5-4.871v3h-19v4h19v3z"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <script>$("#categorieLink<?= $category['short']; ?>").on("click", function(){$("body").css({position: "absolute", right: 0}); var width = $("body").width(); $("body").animate({right: width}, 500, "easeInOutCubic", function(){ setTimeout(function(){ window.location = "/categorie?c=<?= $category['short']; ?>"; }, 500);});});</script>
                <?php
                    $photo = new Photo;
                    $photoInsert = $photo->fetch_by_id($category['preview']);

                    if ($photoInsert !== null) {
                ?>
                        <script>$("#categorieLink<?= $category['short']; ?>").css({background: "url(/assets/photos/<?= $photoInsert; ?>)"})</script>
                <?php
                    }
                }
                ?>
            </div>
        </main>
        <script src="js/home.js"></script>
        <?php include_once('includes/menuselect.php'); ?>
    </body>
</html>