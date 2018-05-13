<html lang="nl">
    <head>
        <title>Documentatie | Max Altena</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Hind:400,700|Open+Sans:400,400i,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>
    </head>

    <body>
        <div id="backButton"><a href="../">← terug naar website</a></div>
        <nav>
            <div id="mainNAV">
                <button id="mainSprint1" class="mainMenu activeMain">Sprint 1</button>
                <button id="mainSprint2" class="mainMenu">Sprint 2</button>
                <button id="mainSprint3" class="mainMenu">Sprint 3</button>
                <button id="mainSprint4" class="mainMenu">Sprint 4</button>
                <button id="mainSprint5" class="mainMenu">Sprint 5</button>
            </div>
            <div id="subNAV">
                <button id="subTab1" class="subMenu activeSub">Concept</button>
                <button id="subTab2" class="subMenu">Functioneel ontwerp</button>
                <button id="subTab3" class="subMenu">Prototype</button>
                <button id="subTab4" class="subMenu">Code snippets</button>
                <button id="subTab5" class="subMenu">Feedback</button>
            </div>
        </nav>
        <main>
            <?php
                include_once('sprint1.php');
                include_once('sprint2.php');
                include_once('sprint3.php');
                include_once('sprint4.php');
                include_once('sprint5.php');
            ?>
        </main>
    </body>
</html>