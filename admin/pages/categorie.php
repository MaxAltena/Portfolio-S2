<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['rank'] == 2) {
        function isEmpty($value) {
            $strTemp = $value;
            $strTemp = trim($strTemp);
            
            if($strTemp == ""){
                return true;
            }
            return false;
        }
        
        if(isset($_POST['add'])){
            $name = $_POST['name'];
            $short = $_POST['short'];
            $preview = $_POST['preview'];
            $text = $_POST['text'];
            $rubrix = $_POST['rubrix'];
            
            $query = $PDO->prepare('SELECT name FROM categories WHERE name = ?');
            $query->bindValue(1, $name);
            $query->execute();
            $result = $query->rowCount() ? true : false;
            
            if($result === false){
                $query = $PDO->prepare('SELECT short FROM categories WHERE short = ?');
                $query->bindValue(1, $short);
                $query->execute();
                $result = $query->rowCount() ? true : false;

                if($result === false){
                    $query = $PDO->prepare('INSERT INTO categories (name, short, preview, text, rubrix) VALUES(?, ?, ?, ?, ?)');
                    $query->bindValue(1, $name);
                    $query->bindValue(2, $short);
                    if(isEmpty($preview)){
                        $query->bindValue(3, NULL);
                    }
                    else {
                        $query->bindValue(3, $preview);
                    }
                    if(isEmpty($text)){
                        $query->bindValue(4, NULL);
                    }
                    else {
                        $query->bindValue(4, $text);
                    }
                    $query->bindValue(5, $rubrix);
                    $query->execute();
                    $result = $query->rowCount() ? true : false;
                    
                    if($result === true) {
                        echo("Categorie is succesvol toegevoegd!");
                    }
                    else {
                        echo("Oops, er ging iets mis");
                    }
                }
                else {
                    echo("Een categorie met deze afkorting bestaat al!");
                }
            }
            else {
                echo("Een categorie met deze naam bestaat al!");
            }
        }
        elseif(isset($_POST['edit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $short = $_POST['short'];
            $preview = $_POST['preview'];
            $text = $_POST['text'];
            $rubrix = $_POST['rubrix'];
            
            $query = $PDO->prepare('SELECT * FROM categories WHERE name = ? AND NOT id = ?');
            $query->bindValue(1, $name);
            $query->bindValue(2, $id);
            $query->execute();
            $result = $query->rowCount() ? true : false;
            
            if($result === false){
                $query = $PDO->prepare('SELECT short FROM categories WHERE short = ? AND NOT id = ?');
                $query->bindValue(1, $short);
                $query->bindValue(2, $id);
                $query->execute();
                $result = $query->rowCount() ? true : false;

                if($result === false){
                    $query = $PDO->prepare('UPDATE categories SET name = ?, short = ?, preview = ?, text = ?, rubrix = ? WHERE id = ?');
                    $query->bindValue(1, $name);
                    $query->bindValue(2, $short);
                    if(isEmpty($preview)){
                        $query->bindValue(3, NULL);
                    }
                    else {
                        $query->bindValue(3, $preview);
                    }
                    if(isEmpty($text)){
                        $query->bindValue(4, NULL);
                    }
                    else {
                        $query->bindValue(4, $text);
                    }
                    $query->bindValue(5, $rubrix);
                    $query->bindValue(6, $id);
                    $query->execute();
                    $result = $query->rowCount() ? true : false;
                    
                    if($result === true) {
                        echo("Categorie is succesvol gewijzigd!");
                    }
                    else {
                        echo("Er zijn geen wijzigingen gemaakt!");
                    }
                }
                else {
                    echo("Een categorie met deze afkorting bestaat al!");
                }
            }
            else {
                echo("Een categorie met deze naam bestaat al!");
            }
        }
        elseif(isset($_POST['getEdit'])){
            $query = $PDO->prepare('SELECT * FROM categories WHERE id = ?');
            $query->bindValue(1, $_POST['getEdit']);
            $query->execute();
            $result = $query->fetch();
            echo json_encode($result);
        }
        elseif(isset($_POST['delete'])) {
            $query = $PDO->prepare('DELETE FROM categories WHERE id = ?');
            $query->bindValue(1, $_POST['categorieID']);
            $query->execute();
            $result = $query->rowCount() ? true : false;
            
            if($result === true){
                echo("Categorie is succesvol verwijderd!");
            }
            else {
                echo("Oops, er ging iets mis");
            }
        }
        else {
            $query = $PDO->prepare('SELECT * FROM categories');
            $query->execute();
            $categories = $query->fetchAll();
?>
<main>
    <div class="gridHeader">
        <h1>Categorieën beheren</h1>
    </div>
    <div class="gridContent categorieContent">
        <div class="categorieBack" style="display: none;">← terug</div>
       
        <h2 class="categorieHeader">Wat wil je doen?</h2>
        
        <div class="categorieChoicesWrapper">
            <div class="categorieChoices" id="add">Categorie toevoegen</div>
            <div class="categorieChoices" id="edit">Categorie wijzigen</div>
            <div class="categorieChoices" id="remove">Categorie verwijderen</div>
        </div>
        
        <div class="categorieAddWrapper" style="display: none;">
            <form autocomplete="off" id="addForm">
                <div class="aTag" id="naamT">Naam:</div>
                <input type="text" name="naamE" id="naamE" placeholder="Naam" required />
                <div class="aTag" id="afkortingT">Afkorting:</div>
                <input type="text" name="afkortingE" id="afkortingE" placeholder="Afkorting" maxlength="12" required />
                <div class="aTag" id="tekstT">Tekst:</div>
                <textarea name="tekstE" id="tekstE" form="addForm" placeholder="Tekst"></textarea>
                <div class="aTag" id="previewT">Voorvertooning:</div>        
                <select name="previewE" id="previewE">
                    <option value="">Geen voorvertooning</option>
                    <?php
                        $query = $PDO->prepare('SELECT id, name FROM media WHERE type = "IMG"');
                        $query->execute();
                        $result = $query->fetchAll();

                        foreach($result as $photo){
                    ?>
                            <option value="<?= $photo['id']; ?>"><?= $photo['name']; ?></option>
                    <?php
                        }
                    ?>
                </select>
                <div class="aTag" id="rubrixT">Rubrix:</div>
                <select name="rubrixE" id="rubrixE" required>
                    <option value="0">Nee</option>
                    <option value="1">Ja</option>
                </select>
                <input type="submit" name="submitE" id="submitE" class="submit" value="Categorie toevoegen" />
            </form>
        </div>
        
        <div class="categorieEditWrapper" style="display: none;">
            <form class="dropDownEdit" style="display: none;">
                <select required name="categorieID" id="categorieID">
                    <option value="" selected>Kies een categorie om te wijzigen</option>
                    <?php
                        foreach($categories as $category){
                    ?>
                            <option value="<?= $category[0]; ?>"><?= $category[1]; ?> (<?= $category[2]; ?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" name="submit" id="submitEE" class="submit" value="Laad categorie" />
            </form>
            <form autocomplete="off" id="editForm" style="display: none;">
                <input type="hidden" name="IDEE" id="IDEE" value=""/>
                <div class="aTag" id="naamTT">Naam:</div>
                <input type="text" name="naamEE" id="naamEE" placeholder="Naam" required />
                <div class="aTag" id="afkortingTT">Afkorting:</div>
                <input type="text" name="afkortingEE" id="afkortingEE" placeholder="Afkorting" maxlength="12" required />
                <div class="aTag" id="tekstTT">Tekst:</div>
                <textarea name="tekstEE" id="tekstEE" form="editForm" placeholder="Tekst"></textarea>
                <div class="aTag" id="previewTT">Voorvertooning:</div>        
                <select name="previewEE" id="previewEE">
                    <option value="">Geen voorvertooning</option>
                    <?php
                        $query = $PDO->prepare('SELECT id, name FROM media WHERE type = "IMG"');
                        $query->execute();
                        $result = $query->fetchAll();

                        foreach($result as $photo){
                    ?>
                            <option value="<?= $photo['id']; ?>"><?= $photo['name']; ?></option>
                    <?php
                        }
                    ?>
                </select>
                <div class="aTag" id="rubrixTT">Rubrix:</div>
                <select name="rubrixEE" id="rubrixEE" required>
                    <option value="0">Nee</option>
                    <option value="1">Ja</option>
                </select>
                <input type="submit" name="submitEF" id="submitEF" class="submit" value="Categorie wijzigen" />
            </form>
        </div>
        
        <div class="categorieDeleteWrapper" style="display: none;">
            <form autocomplete="off" class="dropDownForm" id="deleteForm">
                <select required name="categorieID" id="categorieID">
                    <option value="" selected>Kies een categorie om te verwijderen</option>
                    <?php
                        foreach($categories as $category){
                    ?>
                            <option value="<?= $category[0]; ?>"><?= $category[1]; ?> (<?= $category[2]; ?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" name="submit" id="submitDD" class="submit" value="Verwijder categorie" />
            </form>
        </div>
    </div>
    <script>
        $(".categorieBack").on("click", function(){
            if (confirm("Weet je zeker dat je terug wilt? Er wordt niks opgeslagen.")){
                $(".categorieChoicesWrapper").fadeOut(500);
                $(".categorieAddWrapper").fadeOut(500);
                $(".categorieEditWrapper").fadeOut(500);
                $(".categorieDeleteWrapper").fadeOut(500);
                $(".categorieHeader").fadeOut(500);
                $(".categorieBack").fadeOut(500);
                $(".dropDownEdit").fadeOut(500);
                $("#editForm").fadeOut(500);
                setTimeout(function(){
                    $(".categorieHeader").text("Wat wil je doen?").fadeIn(500);
                    $(".categorieChoicesWrapper").fadeIn(500);
                }, 500);
            }
        });
        
        $(".categorieChoices").on({
            click: function(){
                switch(this.id){
                    case "add":
                        $(".categorieChoicesWrapper").fadeOut(500);
                        $(".categorieHeader").fadeOut(500);
                        setTimeout(function(){
                            $(".categorieBack").fadeIn(500);
                            $(".categorieHeader").text("Toevoegen van een categorie").fadeIn(500);
                            $(".categorieAddWrapper").fadeIn(500);
                        }, 500);
                        break;
                    case "edit":
                        $(".categorieChoicesWrapper").fadeOut(500);
                        $(".categorieHeader").fadeOut(500);
                        setTimeout(function(){
                            $(".categorieBack").fadeIn(500);
                            $(".categorieHeader").text("Wijzigen van een categorie").fadeIn(500);
                            $(".categorieEditWrapper").fadeIn(500);
                            $(".dropDownEdit").fadeIn(500);
                        }, 500);
                        break;
                    case "remove":
                        $(".categorieChoicesWrapper").fadeOut(500);
                        $(".categorieHeader").fadeOut(500);
                        setTimeout(function(){
                            $(".categorieBack").fadeIn(500);
                            $(".categorieHeader").text("Verwijderen van een categorie").fadeIn(500);
                            $(".categorieDeleteWrapper").fadeIn(500);
                        }, 500);
                        break;
                }
            },
            mouseenter: function(){
                $(this).css({"text-decoration": "underline"});
            },
            mouseleave: function(){
                $(this).css({"text-decoration": "none"});
            }
        });
        
        $("form#addForm").submit(function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "/admin/pages/categorie",
                data:{
                    add: "Y",
                    name: $("#naamE").val(),
                    short: $("#afkortingE").val(),
                    preview: $("#previewE").val(),
                    text: $("#tekstE").val(),
                    rubrix: $("#rubrixE").val()
                },
                cache: false,
                success: function(result){
                    if(result == "Categorie is succesvol toegevoegd!") {
                        alert(result);
                        $("#content").hide("slide", { direction: "left" }, 500);
                        setTimeout(function(){
                            $("#content").load("/admin/pages/categorie").show("slide", { direction: "left" }, 500);
                        }, 500);
                    }
                    else {
                        alert(result);
                    }
                }
            });
        });
        
        $("form#deleteForm").submit(function(e){
            e.preventDefault();
            
            if (confirm("Weet je zeker dat je deze categorie wilt verwijderen?")){
                var formData = new FormData(this);
                formData.append("delete", "delete"); 
                
                $.ajax({
                    type: "POST",
                    url: "/admin/pages/categorie",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        if(result == "Categorie is succesvol verwijderd!"){
                            alert(result);
                            $("#content").hide("slide", { direction: "left" }, 500);
                            setTimeout(function(){
                                $("#content").load("/admin/pages/categorie").show("slide", { direction: "left" }, 500);
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
                url: "/admin/pages/categorie",
                data: {
                    getEdit: $("#categorieID").val()
                },
                cache: false,
                dataType: "json",
                success: function(result){
                    $(".dropDownEdit").fadeOut(500);
                    $("#IDEE").val(result['id']);
                    $("#naamEE").val(result['name']);
                    $("#afkortingEE").val(result['short']);
                    $("#previewEE").val(result['preview']);
                    $("#tekstEE").val(result['text']);
                    $("#rubrixEE").val(result['rubrix']);
                    
                    setTimeout(function(){
                        $("#editForm").fadeIn(500);
                    }, 500);
                }
            });
        });
        
        $("form#editForm").submit(function(e){
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "/admin/pages/categorie",
                data:{
                    edit: "Y",
                    id: $("#IDEE").val(),
                    name: $("#naamEE").val(),
                    short: $("#afkortingEE").val(),
                    preview: $("#previewEE").val(),
                    text: $("#tekstEE").val(),
                    rubrix: $("#rubrixEE").val()
                },
                cache: false,
                success: function(result){
                    if(result == "Categorie is succesvol gewijzigd!") {
                        alert(result);
                        $("#content").hide("slide", { direction: "left" }, 500);
                        setTimeout(function(){
                            $("#content").load("/admin/pages/categorie").show("slide", { direction: "left" }, 500);
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