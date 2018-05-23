<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['rank'] >= 1) {
        if (isset($_POST['add'])) {
            $name = $_FILES['file']['name'];
            $target_directory = "/sprint4/assets/media/";
            $target_file = $target_directory . basename($name);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_array = array("jpg", "jpeg", "png", "gif", "pdf", "mp4");
            
            if (in_array($imageFileType, $extensions_array)) {
                $type = "";
                switch($imageFileType){
                    default:
                    case "jpg":
                    case "jpeg":
                    case "png":
                    case "gif":
                        $type = "IMG";
                        break;
                    case "pdf":
                        $type = "DOC";
                        break;
                    case "mp4":
                        $type = "VID";
                        break;
                }
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $target_file) == false) {
                    $query = $PDO->prepare('INSERT INTO media (name, type) VALUES(?, ?)');
                    $query->bindValue(1, $name);
                    $query->bindValue(2, $type);
                    $query->execute();
                    $result = $query->rowCount() ? true : false;
                    
                    if ($result === true){
                        move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $target_file);
                        echo('Het bestand is geupload.');
                    }
                    elseif ($result === false){
                        echo('Er ging iets mis met het uploaden van het bestand.');
                    }
                    else {
                        echo('Oeps, er ging iets mis.');
                    }
                }
                else {
                    echo('Een bestand met deze naam bestaat al.');
                }
            }
            else {
                echo('Het type bestand is niet jpg, jpeg, png, gif, pdf of mp4.');
            }
        }
        elseif (isset($_POST['remove'])){
            $id = $_POST['file'];
            
            $query = $PDO->prepare('SELECT name FROM media WHERE id = ?');
            $query->bindValue(1, $id);
            $query->execute();
            $name = $query->fetchColumn();
            
            $query = $PDO->prepare('SELECT type FROM media WHERE id = ?');
            $query->bindValue(1, $id);
            $query->execute();
            $type = $query->fetchColumn();
            
            switch($type){
                case "IMG":
                    $query = $PDO->prepare('UPDATE items SET media = NULL WHERE media = ?');
                    break;
                case "DOC":
                    $query = $PDO->prepare('UPDATE items SET document = NULL WHERE document = ?');
                    break;
                case "VID":
                    $query = $PDO->prepare('UPDATE items SET video = NULL WHERE video = ?');
                    break;
            }
            $query->bindValue(1, $id);
            $query->execute();
            
            $query = $PDO->prepare('DELETE FROM media WHERE id = ?');
            $query->bindValue(1, $id);
            $query->execute();
            $result = $query->rowCount() ? true : false;
 
            if ($result === true) {
                unlink($_SERVER['DOCUMENT_ROOT'] . "/sprint4/assets/media/" . $name);
                echo('Het bestand is verwijderd.');
            }
            elseif ($result === false) {
                echo('Er ging iets mis met het verwijderen van het bestand.');
            }
            else {
                echo('Oeps, er ging iets mis.');
            }
        } 
        else {
?>
<main>
    <div class="gridHeader">
        <h1>Media</h1>
    </div>
    <div class="gridContent mediaContent">
        <div class="mediaBack" style="display: none;">← terug</div>
       
        <h2 class="mediaHeader">Wat wil je doen?</h2>
        
        <div class="mediaChoicesWrapper">
            <div class="mediaChoices" id="add">Media toevoegen</div>
            <div class="mediaChoices" id="remove">Media verwijderen</div>
        </div>
        
        <div class="mediaAddWrapper" style="display: none;">
            <form id="addForm" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="file" required/>
                <input type="submit" value="Media toevoegen" name="upload" id="upload" />
            </form>
        </div>
        
        <div class="mediaRemoveWrapper" style="display: none;">
            <form id="removeForm" method="post">
                <select name="file" id="idOfFile" required>
                    <option value="">Selecteer een bestand</option>
                    <?php
                        $query = $PDO->prepare("SELECT * FROM media");
                        $query->execute();
                        $media = $query->fetchAll();
                        foreach ($media as $file) {
                            $id = $file['id'];
                            $name = $file['name'];
                            $type = $file['type'];
                    ?>
                            <option value="<?= $id; ?>"><?= $name; ?> (<?= $type; ?>)</option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" value="Media verwijderen" name="deload" id="deload" />
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".mediaBack").on("click", function(){
                if (confirm("Weet je zeker dat je terug wilt? Er wordt niks opgeslagen.")){
                    $(".mediaChoicesWrapper").fadeOut(500);
                    $(".mediaAddWrapper").fadeOut(500);
                    $(".mediaRemoveWrapper").fadeOut(500);
                    $(".mediaHeader").fadeOut(500);
                    $(".mediaBack").fadeOut(500);
                    setTimeout(function(){
                        $(".mediaHeader").text("Wat wil je doen?").fadeIn(500);
                        $(".mediaChoicesWrapper").fadeIn(500);
                    }, 500);
                }
            });
            
            $(".mediaChoices").on({
                click: function(){
                    switch(this.id){
                        case "add":
                            $(".mediaChoicesWrapper").fadeOut(500);
                            $(".mediaHeader").fadeOut(500);
                            setTimeout(function(){
                                $(".mediaBack").fadeIn(500);
                                $(".mediaHeader").text("Toevoegen van media").fadeIn(500);
                                $(".mediaAddWrapper").fadeIn(500);
                            }, 500);
                            break;
                        case "remove":
                            $(".mediaChoicesWrapper").fadeOut(500);
                            $(".mediaHeader").fadeOut(500);
                            setTimeout(function(){
                                $(".mediaBack").fadeIn(500);
                                $(".mediaHeader").text("Verwijderen van media").fadeIn(500);
                                $(".mediaRemoveWrapper").fadeIn(500);
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
            
            $("form#addForm").submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);
                formData.append("add", "add"); 
                
                $.ajax({
                    type: "POST",
                    url: "/sprint4/admin/pages/media",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        alert(result);
                        $("#content").hide("slide", { direction: "left" }, 500);
                        setTimeout(function(){
                            $("#content").load("/sprint4/admin/pages/media").show("slide", { direction: "left" }, 500);
                        }, 500);
                    }
                });
            });
            
            $("form#removeForm").submit(function(e){
                e.preventDefault();
                
                if (confirm("Weet je zeker dat je dit bestand wilt verwijderen? Dit kan niet worden teruggedraaid.")){
                    var formData = new FormData(this);
                    formData.append("remove", "remove"); 

                    $.ajax({
                        type: "POST",
                        url: "/sprint4/admin/pages/media",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            alert(result);
                            $("#content").hide("slide", { direction: "left" }, 500);
                            setTimeout(function(){
                                $("#content").load("/sprint4/admin/pages/media").show("slide", { direction: "left" }, 500);
                            }, 500);
                        }
                    });
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
    header('Location: /sprint4/login');
    exit();
}
?>