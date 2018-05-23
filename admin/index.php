<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_POST['username'], $_POST['password'], $_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = $PDO->prepare("SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1");
    $query->bindValue(1, $username);
    $query->bindValue(2, $password);
    $query->execute();
    $result = $query->rowCount() ? true : false;

    if ($result == true) {
        $_SESSION['getUsername'] = $username;
        $_SESSION['password_noMD5'] = $_POST['password'];
        echo('Login');
    }
    else {
        echo('Gebruikersnaam en wachtwoord combinatie is incorrect');
    }
}
elseif (isset($_POST['username'], $_POST['password'], $_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $queryCheck = $PDO->prepare("SELECT * FROM users WHERE username = ?");
    $queryCheck->bindValue(1, $username);
    $queryCheck->execute();
    $resultCheck = $queryCheck->rowCount() ? true : false;
    
    if ($resultCheck == false){
        $queryRegister = $PDO->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $queryRegister->bindValue(1, $username);
        $queryRegister->bindValue(2, $password);
        $queryRegister->execute();
        $resultRegister = $queryRegister->rowCount() ? true : false;
            
        if ($resultRegister == true) {
            $_SESSION['getUsername'] = $username;
            $_SESSION['password_noMD5'] = $_POST['password'];
            echo('Register');
        }
        else {
            echo('Er ging iets fout met het aanmaken van de gebruiker');   
        }
    }
    else {
        echo('Deze gebruikersnaam bestaat al');
    }
}
elseif (isset($_SESSION['getUsername'])) {
    $username = $_SESSION['getUsername'];
    
    $query = $PDO->prepare("SELECT * FROM users WHERE username = ?");
    $query->bindValue(1, $username);
    $query->execute();
    $userinfo = $query->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION['user_id'] = $userinfo['id'];
    $_SESSION['username'] = $userinfo['username'];
    $_SESSION['password_MD5'] = $userinfo['password'];
    $_SESSION['rank'] = $userinfo['rank'];
    
    $_SESSION['ingelogd'] = true;
    unset($_SESSION['getUsername']);
    
    header('Location: /admin/');
    exit();
}
elseif (isset($_SESSION['ingelogd'])) {
?>
<html lang="nl">
    <head>
        <title>Admin panel | Max Altena</title>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head_admin.php'); ?>
    </head>
    
    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/loader.php'); ?>
        <div id="all">
            <div id="menu">
                <a href="../" id="back">← terug naar website</a>
                <div id="menu_box_logo">
                    <a href="../" class="menu_logo_link">
                        <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/logo.svg'); ?>
                    </a>
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
                <a href="/logout" id="logout">Uitloggen</a>
            </div>
<?php
            if(isset($_POST['externalEdit'])) {
                $query = $PDO->prepare('SELECT * FROM items WHERE id = ?');
                $query->bindValue(1, $_POST['externalID']);
                $query->execute();
                $result = $query->fetch();
?>
                <script>
                    var externalResult = <?= json_encode($result); ?>;
                    var externalID = externalResult[0];
                </script>
<?php
            }
?>
            <div id="contentContainer">
                <div id="content"></div>
            </div>
<?php
            if(isset($_POST['externalEdit'])) {
?>
                <script>
                    $(document).ready(function(){       
                        $("#content").load("/admin/pages/wijzigen");
                        $(".active").removeClass("active");
                        $("#wijzigen").addClass("active");
                    });
                </script>
<?php
            }
            else {
?>
                <script>
                    $(document).ready(function(){
                        $("#content").load("/admin/pages/dashboard"); 
                    });
                </script>
<?php
            }
?>
        </div>
        <script src="/js/admin.js"></script>
    </body>
</html>
<?php
}
else {
    header('Location: /login');
    exit();
}
?>