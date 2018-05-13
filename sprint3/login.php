<?php
session_start();
include_once('includes/connection.php');

if (!isset($_SESSION['ingelogd'])) {
?>
<html lang="nl">
    <head>
        <title>Login | Max Altena</title>
        <?php include_once('includes/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    </head>
    
    <body>
        <?php include_once('includes/loader.php'); ?>
        <main>
            <div id="backTo">← terug naar website</div>
            <div id="error"><small id="errorText"></small></div>
            <div id="container">
                <div id="switchContainer">
                    <input id="switchCheckbox" type="checkbox">
                    <label for="switchCheckbox">
                        <div class="switchDiv" data-checked="Registreren" data-unchecked="Inloggen"></div>
                    </label>
                </div>
                
                <div id="formContainer">
                    <form autocomplete="on" id="formLogin">
                        <input type="text" id="gebruikersnaamLogin" name="username" placeholder="Gebruikersnaam" autocomplete="current-username" autofocus required>
                        <input type="password" id="wachtwoordLogin" name="password" placeholder="Wachtwoord" autocomplete="current-password" required>
                        <input type="submit" id="submitLogin" name="submitLogin" value="Inloggen">
                    </form>
                    
                    <form autocomplete="off" id="formRegister">
                        <input type="text" id="gebruikersnaamRegister" name="username" placeholder="Gebruikersnaam" autofocus required>
                        <input type="password" id="wachtwoordRegister" name="password" placeholder="Wachtwoord" required>
                        <input type="submit" id="submitRegister" name="submitRegister" value="Registreren">
                    </form>
                </div>
            </div>
        </main>
        <script src="js/login.js"></script>
    </body>
</html>
<?php
}
else {
    header('Location: /sprint3/admin/');
    exit();
}
?>