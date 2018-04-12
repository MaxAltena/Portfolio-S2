<?php
session_start();
include_once('../includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
?>
<html lang="nl">
    <head>
        <title>Admin panel | Max Altena</title>
        <?php include_once('../includes/head_admin.php'); ?>
    </head>

    <body>
        <?php include_once('../includes/loader.php'); ?>
        <div id="all">
            <div id="menu">
                <div id="back">← terug naar website</div>
                <div id="menu_box_logo">
                    <div class="menu_logo_link">
                        <?php include('../assets/logo.svg'); ?>
                    </div>
                </div>
                <div class="item active" id="dashboard">Dashboard</div>
                <div class="item" id="account">Account</div>
                <div class="item" id="list">Lijst</div>
                
                <?php
                    if ($_SESSION['rank'] >= 1) {  
                ?>
                <div class="item" id="toevoegen">Toevoegen</div>
                <div class="item" id="wijzigen">Wijzigen</div>
                <div class="item" id="verwijderen">Verwijderen</div>
                <div class="item" id="media">Media</div>
                <?php
                    }
                    
                    if ($_SESSION['rank'] == 2) {  
                ?>
                <div class="item" id="rubrix">Rubrix' beheren</div>
                <div class="item" id="categorie">Categorieën beheren</div>
                <div class="item" id="rank">Ranks aanpassen</div>
                <?php
                    }
                ?>
                <div id="logout">Uitloggen</div>
            </div>
            
            <div id="contentContainer">
                <div id="content"></div>
            </div>
        </div>
        <script src="../js/admin.js"></script>
    </body>
</html>
<?php
}
else {
    header('Location: ../login');
    exit();
}
?>