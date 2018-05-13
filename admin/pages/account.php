<?php
session_start();
include_once('../../includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
?>
<main>
    <div class="gridHeader">
        <h1>Account</h1>
    </div>
    <div class="gridContent accountGrid">
        <div class="accountGridTop">
            <div class="accountHeader"><h2>Gegevens</h2></div>
            <div class="accountContent accountGegevensContent">
                <p class="accountContentP1">Gebruikersnaam:</p>
                <p class="accountContentP2"><?= $_SESSION['username']; ?></p>
                <p class="accountContentP3">User ID:</p>
                <p class="accountContentP4"><?= $_SESSION['user_id']; ?></p>
                <p class="accountContentP5">Rank:</p>
                <p class="accountContentP6"><?= $_SESSION['rank']; ?></p>
            </div>
        </div>
        <div class="accountGridBottom">
            <div class="accountHeader"><h2>Wachtwoord</h2></div>
            <div class="accountContent accountPasswordContent">
                <p class="accountContentP1">Wachtwoord:</p>
                <p class="accountContentP2">
                <?php
                    $length_password = strlen($_SESSION['password_noMD5']);
                    for($i=1; $i<=$length_password; $i++) {
                        echo "*";
                    }
                ?>
                </p>
                <form autocomplete="off" class="accountContentForm">
                    <p class="accountPasswordContentP1">Nieuw wachtwoord:</p>
                    <input type="password" name="password1" id="newPassword1" class="accountPasswordContentF1" required placeholder="Nieuw wachtwoord" />
                    <p class="accountPasswordContentP2">Herhaal nieuw wachtwoord:</p>
                    <input type="password" name="password2" id="newPassword2" class="accountPasswordContentF2" required placeholder="Herhaal" />
                    <p class="accountPasswordContentERROR"></p>
                    <input type="submit" name="submit" id="submitPassword" class="accountPasswordContentF3" value="Wijzig wachtwoord" />
                    <script>
                        $(document).ready(function(){
                            $("#submitPassword").on("click", function(){
                                $(".accountPasswordContentERROR").fadeOut(300);
                                
                                if ($("#newPassword1").val().trim() !== "" && $("#newPassword2").val().trim() !== "") {
                                    $("#newPassword1").effect("transfer", { to: $("#submitPassword") }, 550);
                                    $("#newPassword2").effect("transfer", { to: $("#submitPassword") }, 550);
                                    
                                    if ($("#newPassword1").val() == $("#newPassword2").val()){
                                        setTimeout(function(){
                                            $.ajax({
                                                type: "POST",
                                                url: "password",
                                                data: {
                                                    password: $("#newPassword1").val()
                                                },
                                                cache: false,
                                                success: function(result){
                                                    if (result === "success"){
                                                        window.location = "../../login";
                                                    }
                                                    else {
                                                        $(".accountPasswordContentERROR").fadeIn(300).text(result);
                                                        $("#submitPassword").effect("shake");
                                                        $("#newPassword1").effect("shake");
                                                        $("#newPassword2").effect("shake");
                                                    }
                                                }
                                            });
                                        }, 500);
                                    }
                                    else {
                                        setTimeout(function(){
                                            $(".accountPasswordContentERROR").fadeIn(300).text("Wachtwoorden zijn niet gelijk");
                                            $("#newPassword1").effect("shake");
                                            $("#newPassword2").effect("shake");
                                        }, 500);

                                    }
                                }
                                else if ($("#newPassword1").val().trim() !== "" && $("#newPassword2").val().trim() == "") {
                                    $(".accountPasswordContentERROR").fadeIn(300).text("Herhaal het nieuwe wachtwoord");
                                    $("#newPassword2").effect("shake");
                                }
                                else if ($("#newPassword1").val().trim() == "" && $("#newPassword2").val().trim() !== "") {
                                    $(".accountPasswordContentERROR").fadeIn(300).text("Vul een nieuw wachtwoord in");
                                    $("#newPassword1").effect("shake");
                                }
                                else if ($("#newPassword1").val().trim() == "" && $("#newPassword2").val().trim() == "") {
                                    $(".accountPasswordContentERROR").fadeIn(300).text("Geen velden ingevuld");
                                    $("#newPassword1").effect("shake");
                                    $("#newPassword2").effect("shake");
                                }
                                return false;
                            });
                            
                            $(".accountPasswordContentERROR").hide();
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
}
else {
    header('Location: ../../login');
    exit();
}
?>