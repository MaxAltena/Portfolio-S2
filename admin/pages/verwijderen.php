<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['rank'] >= 1) {
        if (isset($_POST['myID'])) {
            $query = $PDO->prepare('DELETE FROM items WHERE id = ?');
            $query->bindValue(1, $_POST['myID']);
            $query->execute();
            $result = $query->rowCount() ? true : false;
            
            if($result === true){
                echo("Item is succesvol verwijderd!");
            }
            else {
                echo("Oops, er ging iets mis");
            }
        }
        else {
            $query = $PDO->prepare('SELECT * FROM items');
            $query->execute();
            $items = $query->fetchAll();
?>
<main>
    <div class="gridHeader">
        <h1>Verwijderen</h1>
    </div>
    <div class="gridContent deleteContent">
        <form autocomplete="off" class="dropDownForm">
            <select required name="myID" id="myID">
                <option value="" selected>Kies een item om te verwijderen</option>
                <?php
                    foreach($items as $item){
                ?>
                        <option value="<?= $item[0]; ?>"><?= $item[1]; ?></option>
                <?php
                    }
                ?>
            </select>
            <input type="submit" name="submit" id="submitDD" class="submit" value="Verwijder item" />
        </form>
    </div>
    <script>
        $(".dropDownForm").submit(function(e){
            e.preventDefault();
            
            if (confirm("Weet je zeker dat je dit item wilt verwijderen?")){
                $.ajax({
                    type: "POST",
                    url: "/admin/pages/verwijderen",
                    data: {
                        myID: $("#myID").val()
                    },
                    cache: false,
                    success: function(result){
                        if(result == "Item is succesvol verwijderd!"){
                            alert(result);
                            $("#content").hide("slide", { direction: "left" }, 500);
                            setTimeout(function(){
                                $("#content").load("/admin/pages/verwijderen").show("slide", { direction: "left" }, 500);
                            }, 500);
                        }
                        else {
                            alert(result);
                        }
                    }
                });
            }
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