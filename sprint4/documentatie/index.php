<html lang="nl">
    <head>
        <title>Documentatie | Max Altena</title>
        <meta charset="UTF-8">
        <meta name="description" content="Documentatie van de portfoliowebsite van Max Altena">
        <meta name="keywords" content="Portfolio,Max,Altena,Max Altena,Documentatie">
        <meta name="author" content="Max Altena">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon" sizes="180x180" href="/sprint4/assets/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/sprint4/assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="194x194" href="/sprint4/assets/icons/favicon-194x194.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/sprint4/assets/icons/android-chrome-192x192.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/sprint4/assets/icons/favicon-16x16.png">
        <link rel="manifest" href="/sprint4/assets/icons/site.webmanifest">
        <link rel="mask-icon" href="/sprint4/assets/icons/safari-pinned-tab.svg" color="#FECD18">
        <link rel="shortcut icon" href="/sprint4/assets/icons/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="Max Altena">
        <meta name="application-name" content="Max Altena">
        <meta name="msapplication-TileColor" content="#FECD18">
        <meta name="msapplication-TileImage" content="/sprint4/assets/icons/mstile-144x144.png">
        <meta name="msapplication-config" content="/sprint4/assets/icons/browserconfig.xml">
        <meta name="theme-color" content="#FECD18">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Hind:400,700|Open+Sans:400,400i,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/sprint4/documentatie/style.css">
    </head>

    <body>
        <div id="backButton"><a href="/sprint4/">← terug naar website</a></div>
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
                include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/documentatie/sprint1.php');
                include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/documentatie/sprint2.php');
                include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/documentatie/sprint3.php');
                include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/documentatie/sprint4.php');
                include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/documentatie/sprint5.php');
            ?>
        </main>
        <script>
            var activeMain = "mainSprint1";
            var activeSub = "subTab1";
            var activeMainContent = "contentSprint1";
            var activeSubContent = "contentSprint1_Tab1";
        </script>
        <?php
            if (isset($_GET['sprint'])) {
                $sprint = $_GET['sprint'];
        ?>
                <script>
                    var sprint = <?= $sprint; ?>;
                    activeMain = "mainSprint" + sprint;
                    activeMainContent = "contentSprint" + sprint;
                    activeSubContent = "contentSprint" + sprint + "_Tab1";
                    $(".activeMain").removeClass("activeMain");
                    $(".activeMainContent").removeClass("activeMainContent");
                    $(".activeSubContent").removeClass("activeSubContent");
                    $("#mainSprint"+sprint).addClass("activeMain");
                    $("#contentSprint"+sprint).addClass("activeMainContent");
                    $("#contentSprint"+sprint+"_Tab1").addClass("activeSubContent");
                </script>
        <?php
        }
        ?>
        <script src="/sprint4/documentatie/script.js"></script>
    </body>
</html>