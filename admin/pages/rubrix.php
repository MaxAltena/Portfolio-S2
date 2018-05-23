<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['rank'] == 2) {
        if(isset($_POST['add'])){
            $name = $_POST['name'];
            $criterium = $_POST['criterium'];
            $zeer = $_POST['zeer'];
            $goed = $_POST['goed'];
            $voldoende = $_POST['voldoende'];
            $onvoldoende = $_POST['onvoldoende'];
            $value = $_POST['value'];
            $opinion = $_POST['opinion'];
            
            $query = $PDO->prepare('INSERT INTO rubrix (name, criterium, zeer, goed, voldoende, onvoldoende, value, opinion) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
            $query->bindValue(1, $name);
            $query->bindValue(2, $criterium);
            $query->bindValue(3, $zeer);
            $query->bindValue(4, $goed);
            $query->bindValue(5, $voldoende);
            $query->bindValue(6, $onvoldoende);
            $query->bindValue(7, $value);
            $query->bindValue(8, $opinion);
            $query->execute();
            $result = $query->rowCount() ? true : false;
            
            if($result === true) {
                echo("Rubrix is succesvol toegevoegd!");
            }
            else {
                echo("Oops, er ging iets mis");
            }
        }
        elseif(isset($_POST['edit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $criterium = $_POST['criterium'];
            $zeer = $_POST['zeer'];
            $goed = $_POST['goed'];
            $voldoende = $_POST['voldoende'];
            $onvoldoende = $_POST['onvoldoende'];
            $value = $_POST['value'];
            $opinion = $_POST['opinion'];

            $query = $PDO->prepare('UPDATE rubrix SET name = ?, criterium = ?, zeer = ?, goed = ?, voldoende = ?, onvoldoende = ?, value = ?, opinion = ? WHERE id = ?');
            $query->bindValue(1, $name);
            $query->bindValue(2, $criterium);
            $query->bindValue(3, $zeer);
            $query->bindValue(4, $goed);
            $query->bindValue(5, $voldoende);
            $query->bindValue(6, $onvoldoende);
            $query->bindValue(7, $value);
            $query->bindValue(8, $opinion);
            $query->bindValue(9, $id);
            $query->execute();
            $result = $query->rowCount() ? true : false;

            if($result === true) {
                echo("Rubrix is succesvol gewijzigd!");
            }
            else {
                echo("Er zijn geen wijzigingen gemaakt!");
            }
        }
        elseif(isset($_POST['getEdit'])){
            $query = $PDO->prepare('SELECT * FROM rubrix WHERE id = ?');
            $query->bindValue(1, $_POST['getEdit']);
            $query->execute();
            $result = $query->fetch();
            echo json_encode($result);
        }
        elseif(isset($_POST['delete'])) {
            $query = $PDO->prepare('DELETE FROM rubrix WHERE id = ?');
            $query->bindValue(1, $_POST['rubrixID']);
            $query->execute();
            $result = $query->rowCount() ? true : false;
            
            if($result === true){
                echo("Rubrix is succesvol verwijderd!");
            }
            else {
                echo("Oops, er ging iets mis");
            }
        }
        else {
            $query = $PDO->prepare('SELECT * FROM rubrix');
            $query->execute();
            $rubrixs = $query->fetchAll();
?>
<main>
    <div class="gridHeader">
        <h1>Rubrix' beheren</h1>
    </div>
    <div class="gridContent rubrixContent">
        <div class="rubrixBack" style="display: none;">← terug</div>
       
        <h2 class="rubrixHeader">Wat wil je doen?</h2>
        
        <div class="rubrixChoicesWrapper">
            <div class="rubrixChoices" id="add">Rubrix toevoegen</div>
            <div class="rubrixChoices" id="edit">Rubrix wijzigen</div>
            <div class="rubrixChoices" id="remove">Rubrix verwijderen</div>
        </div>
        
        <div class="rubrixAddWrapper" style="display: none;">
            <form autocomplete="off" id="addRubrixForm">
                <div class="aTag" id="nameRT">Rubrix van categorie:</div>
                <select name="nameRE" id="nameRE" required>
                    <option value="">Selecteer een categorie...</option>
                    <?php
                        $query = $PDO->prepare('SELECT name, short FROM categories');
                        $query->execute();
                        $result = $query->fetchAll();

                        foreach($result as $category){
                    ?>
                            <option value="<?= $category['short']; ?>"><?= $category['name']; ?> (<?= $category['short']; ?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <div class="aTag" id="criteriumRT">Criterium:</div>
                <textarea name="criteriumRE" id="criteriumRE" form="addRubrixForm" placeholder="Criterium" required></textarea>
                <div class="aTag" id="zeerRT">Zeer goed:</div>
                <textarea name="zeerRE" id="zeerRE" form="addRubrixForm" placeholder="Zeer goed" required></textarea>
                <div class="aTag" id="goedRT">Goed:</div>
                <textarea name="goedRE" id="goedRE" form="addRubrixForm" placeholder="Goed" required></textarea>
                <div class="aTag" id="voldoendeRT">Voldoende:</div>
                <textarea name="voldoendeRE" id="voldoendeRE" form="addRubrixForm" placeholder="Voldoende" required></textarea>
                <div class="aTag" id="onvoldoendeRT">Onvoldoende:</div>
                <textarea name="onvoldoendeRE" id="onvoldoendeRE" form="addRubrixForm" placeholder="Onvoldoende" required></textarea>
                <div class="aTag" id="valueRT">Waarde:</div>
                <select name="valueRE" id="valueRE" required>
                    <option value="">Selecteer een waarde...</option>
                    <option value="zeer">Zeer goed</option>
                    <option value="goed">Goed</option>
                    <option value="voldoende">Voldoende</option>
                    <option value="onvoldoende">Onvoldoende</option>
                </select>
                <div class="aTag" id="opinionRT">Toelichting:</div>
                <textarea name="opinionRE" id="opinionRE" form="addRubrixForm" placeholder="Toelichting" required></textarea>
                <input type="submit" name="submitR" id="submitR" class="submit" value="Rubrix toevoegen" />
            </form>
        </div>
        
        <div class="rubrixEditWrapper" style="display: none;">
            <form class="dropDownEdit" style="display: none;">
                <select required name="rubrixIDedit" id="rubrixIDedit">
                    <option value="" selected>Kies een rubrix om te wijzigen</option>
                    <?php
                        foreach($rubrixs as $rubrix){
                    ?>
                            <option value="<?= $rubrix[0]; ?>"><?= $rubrix[1]; ?> (ID: <?= $rubrix[0]; ?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" name="submit" id="submitRE" class="submit" value="Laad rubrix" />
            </form>
            <form autocomplete="off" id="editRubrixForm" style="display: none;">
                <input type="hidden" name="IDEE" id="IDEE" value=""/>
                <div class="aTag" id="nameERT">Rubrix van categorie:</div>
                <select name="nameERE" id="nameERE" required>
                    <option value="">Selecteer een categorie...</option>
                    <?php
                        $query = $PDO->prepare('SELECT name, short FROM categories');
                        $query->execute();
                        $result = $query->fetchAll();

                        foreach($result as $category){
                    ?>
                            <option value="<?= $category['short']; ?>"><?= $category['name']; ?> (<?= $category['short']; ?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <div class="aTag" id="criteriumERT">Criterium:</div>
                <textarea name="criteriumERE" id="criteriumERE" form="editRubrixForm" placeholder="Criterium" required></textarea>
                <div class="aTag" id="zeerERT">Zeer goed:</div>
                <textarea name="zeerERE" id="zeerERE" form="editRubrixForm" placeholder="Zeer goed" required></textarea>
                <div class="aTag" id="goedERT">Goed:</div>
                <textarea name="goedERE" id="goedERE" form="editRubrixForm" placeholder="Goed" required></textarea>
                <div class="aTag" id="voldoendeERT">Voldoende:</div>
                <textarea name="voldoendeERE" id="voldoendeERE" form="editRubrixForm" placeholder="Voldoende" required></textarea>
                <div class="aTag" id="onvoldoendeERT">Onvoldoende:</div>
                <textarea name="onvoldoendeERE" id="onvoldoendeERE" form="editRubrixForm" placeholder="Onvoldoende" required></textarea>
                <div class="aTag" id="valueERT">Waarde:</div>
                <select name="valueERE" id="valueERE" required>
                    <option value="">Selecteer een waarde...</option>
                    <option value="zeer">Zeer goed</option>
                    <option value="goed">Goed</option>
                    <option value="voldoende">Voldoende</option>
                    <option value="onvoldoende">Onvoldoende</option>
                </select>
                <div class="aTag" id="opinionERT">Toelichting:</div>
                <textarea name="opinionERE" id="opinionERE" form="editRubrixForm" placeholder="Toelichting" required></textarea>
                <input type="submit" name="submitR" id="submitER" class="submit" value="Rubrix wijzigen" />
            </form>
        </div>
        
        <div class="rubrixDeleteWrapper" style="display: none;">
            <form autocomplete="off" class="dropDownForm" id="deleteRubrixForm">
                <select required name="rubrixID" id="rubrixID">
                    <option value="" selected>Kies een rubrix om te verwijderen</option>
                    <?php
                        foreach($rubrixs as $rubrix){
                    ?>
                            <option value="<?= $rubrix[0]; ?>"><?= $rubrix[1]; ?> (ID: <?= $rubrix[0]; ?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" name="submit" id="submitDD" class="submit" value="Verwijder rubrix" />
            </form>
        </div>
    </div>
    <script>
        $(".rubrixBack").on("click", function(){
            if (confirm("Weet je zeker dat je terug wilt? Er wordt niks opgeslagen.")){
                $(".rubrixChoicesWrapper").fadeOut(500);
                $(".rubrixAddWrapper").fadeOut(500);
                $(".rubrixEditWrapper").fadeOut(500);
                $(".rubrixDeleteWrapper").fadeOut(500);
                $(".rubrixHeader").fadeOut(500);
                $(".rubrixBack").fadeOut(500);
                $(".dropDownEdit").fadeOut(500);
                $("#editForm").fadeOut(500);
                setTimeout(function(){
                    $(".rubrixHeader").text("Wat wil je doen?").fadeIn(500);
                    $(".rubrixChoicesWrapper").fadeIn(500);
                }, 500);
            }
        });
        
        $(".rubrixChoices").on({
            click: function(){
                switch(this.id){
                    case "add":
                        $(".rubrixChoicesWrapper").fadeOut(500);
                        $(".rubrixHeader").fadeOut(500);
                        setTimeout(function(){
                            $(".rubrixBack").fadeIn(500);
                            $(".rubrixHeader").text("Toevoegen van een rubrix").fadeIn(500);
                            $(".rubrixAddWrapper").fadeIn(500);
                        }, 500);
                        break;
                    case "edit":
                        $(".rubrixChoicesWrapper").fadeOut(500);
                        $(".rubrixHeader").fadeOut(500);
                        setTimeout(function(){
                            $(".rubrixBack").fadeIn(500);
                            $(".rubrixHeader").text("Wijzigen van een rubrix").fadeIn(500);
                            $(".rubrixEditWrapper").fadeIn(500);
                            $(".dropDownEdit").fadeIn(500);
                        }, 500);
                        break;
                    case "remove":
                        $(".rubrixChoicesWrapper").fadeOut(500);
                        $(".rubrixHeader").fadeOut(500);
                        setTimeout(function(){
                            $(".rubrixBack").fadeIn(500);
                            $(".rubrixHeader").text("Verwijderen van een rubrix").fadeIn(500);
                            $(".rubrixDeleteWrapper").fadeIn(500);
                        }, 500);
                        break;
                }
            },
            mouseenter: function(){
                $(this).css({"text-decoration": "line-through"});
            },
            mouseleave: function(){
                $(this).css({"text-decoration": "underline"});
            }
        });
        
        $("form#addRubrixForm").submit(function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "/admin/pages/rubrix",
                data:{
                    add: "Y",
                    name: $("#nameRE").val(),
                    criterium: $("#criteriumRE").val(),
                    zeer: $("#zeerRE").val(),
                    goed: $("#goedRE").val(),
                    voldoende: $("#voldoendeRE").val(),
                    onvoldoende: $("#onvoldoendeRE").val(),
                    value: $("#valueRE").val(),
                    opinion: $("#opinionRE").val()
                    
                },
                cache: false,
                success: function(result){
                    if(result == "Rubrix is succesvol toegevoegd!") {
                        alert(result);
                        $("#content").hide("slide", { direction: "left" }, 500);
                        setTimeout(function(){
                            $("#content").load("/admin/pages/rubrix").show("slide", { direction: "left" }, 500);
                        }, 500);
                    }
                    else {
                        alert(result);
                    }
                }
            });
        });
        
        $("form#deleteRubrixForm").submit(function(e){
            e.preventDefault();
            
            if (confirm("Weet je zeker dat je deze rubrix wilt verwijderen?")){
                var formData = new FormData(this);
                formData.append("delete", "delete"); 
                
                $.ajax({
                    type: "POST",
                    url: "/admin/pages/rubrix",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        if(result == "Rubrix is succesvol verwijderd!"){
                            alert(result);
                            $("#content").hide("slide", { direction: "left" }, 500);
                            setTimeout(function(){
                                $("#content").load("/admin/pages/rubrix").show("slide", { direction: "left" }, 500);
                            }, 500);
                        }
                        else {
                            alert(result);
                        }
                    }
                });
            }
        });
        
        $("form.dropDownEdit").submit(function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "/admin/pages/rubrix",
                data: {
                    getEdit: $("#rubrixIDedit").val()
                },
                cache: false,
                dataType: "json",
                success: function(result){
                    $(".dropDownEdit").fadeOut(500);
                    $("#IDEE").val(result['id']);
                    $("#nameERE").val(result['name']);
                    $("#criteriumERE").val(result['criterium']);
                    $("#zeerERE").val(result['zeer']);
                    $("#goedERE").val(result['goed']);
                    $("#voldoendeERE").val(result['voldoende']);
                    $("#onvoldoendeERE").val(result['onvoldoende']);
                    $("#valueERE").val(result['value']);
                    $("#opinionERE").val(result['opinion']);
                    
                    setTimeout(function(){
                        $("#editRubrixForm").fadeIn(500);
                    }, 500);
                }
            });
        });
        
        $("form#editRubrixForm").submit(function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "/admin/pages/rubrix",
                data:{
                    edit: "Y",
                    id: $("#IDEE").val(),
                    name: $("#nameERE").val(),
                    criterium: $("#criteriumERE").val(),
                    zeer: $("#zeerERE").val(),
                    goed: $("#goedERE").val(),
                    voldoende: $("#voldoendeERE").val(),
                    onvoldoende: $("#onvoldoendeERE").val(),
                    value: $("#valueERE").val(),
                    opinion: $("#opinionERE").val()
                },
                cache: false,
                success: function(result){
                    if(result == "Rubrix is succesvol gewijzigd!") {
                        alert(result);
                        $("#content").hide("slide", { direction: "left" }, 500);
                        setTimeout(function(){
                            $("#content").load("/admin/pages/rubrix").show("slide", { direction: "left" }, 500);
                        }, 500);
                    }
                    else {
                        alert(result);
                    }
                }
            });
        });
    </script>
</main>
<?php
        }
    }
    else {
        ?>
        <h1 class="nicetry">Nice try!</h1>
        <?php
    }
}
else {
    header('Location: /login');
    exit();
}
?>