<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['rank'] == 2) {
        if (isset($_POST['value'], $_POST['id'])){
            $query = $PDO->prepare('UPDATE users SET rank = ? WHERE id = ?');
            $query->bindValue(1, $_POST['value']);
            $query->bindValue(2, $_POST['id']);
            $query->execute();
            echo($query->rowCount() ? true : false);
        }
        else {
            $query = $PDO->prepare('SELECT * FROM users WHERE rank != 2');
            $query->execute();
            $users = $query->fetchAll();
?>
<main>
    <div class="gridHeader">
        <h1>Ranks aanpassen</h1>
    </div>
    <div class="gridContent rankContent">
        <div class="filter">
            <p>Filter op rank</p>
            <p class="filterP"><span class="filterOption activeFilter" id="filterAlles">Alles</span> <span class="filterOption" id="filter0">0</span> <span class="filterOption" id="filter1">1</span></p>
            <script>
                $(document).ready(function(){
                    $(".filterOption").on("click", function(){
                        var filterID = this.id;
                        var arrayFilter = filterID.split('filter');
                        filter = arrayFilter[1];
                        
                        switch(filter){
                            default:
                            case "Alles":
                                $(".activeFilter").removeClass("activeFilter");
                                $(this).addClass("activeFilter");
                                
                                $(".trRankAll").show();
                                break;
                            case "0":
                                $(".activeFilter").removeClass("activeFilter");
                                $(this).addClass("activeFilter");
                                
                                $(".trRank0").show();
                                $(".trRank1").hide();
                                break;
                            case "1":
                                $(".activeFilter").removeClass("activeFilter");
                                $(this).addClass("activeFilter");
                                
                                $(".trRank0").hide();
                                $(".trRank1").show();
                                break;
                        }
                    });
                    setInterval(function(){
                        $(".activeFilter").click();
                    }, 500)
                });
            </script>
        </div>
        
        <table class="rankTable">
            <thead>
                <tr>
                    <th class="user">Gebruikersnaam</th>
                    <th class="rank">Rank</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($users as $user){
                ?>
                    <tr class="trRankAll trRank<?= $user['rank']; ?> tr<?= $user['id']; ?>">
                        <td>
                            <?= $user['username']; ?>
                        </td>
                        <td class="tdRank<?= $user['id']; ?>">
                            <?= $user['rank']; ?>
                        </td>
                        <td>
                            <select id="select<?= $user['id']; ?>" name="select<?= $user['id']; ?>">
                                <?php switch ($user['rank']) {
                                    default:
                                    case 0:
                                ?>
                                    <option value="0" selected>Rank 0</option>
                                    <option value="1">Rank 1</option>
                                <?php
                                    break;
                                    case 1:
                                ?>
                                    <option value="0">Rank 0</option>
                                    <option value="1" selected>Rank 1</option>
                                <?php 
                                break;
                                } ?>
                            </select>
                        </td>
                        <td>
                            <button id="button<?= $user['id']; ?>" name="button<?= $user['id']; ?>" class="rankButton">Verander</button>
                        </td>
                        <td>
                            <p class="rankErrorText error<?= $user['id']; ?>"></p>
                        </td>
                        
                        <script>
                            $(document).ready(function(){
                                $("#button<?= $user['id']; ?>").on("click", function(){
                                    var newRank = $("#select<?= $user['id']; ?>").find(":selected").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "/sprint4/admin/pages/rank",
                                        data: {
                                            value: newRank,
                                            id: "<?= $user['id']; ?>"
                                        },
                                        cache: false,
                                        success: function(data){
                                            if (data === "1"){
                                                var newClass = "trRank" + newRank;
                                                var oldClass = "trRank" + $(".tdRank<?= $user['id']; ?>").text();
                                                $(".tr<?= $user['id']; ?>").removeClass(oldClass).addClass(newClass);
                                                $(".tdRank<?= $user['id']; ?>").text(newRank);
                                                
                                                $(".error<?= $user['id']; ?>").css({color: "black"}).text("Rank van gebruiker veranderd naar " + newRank);
                                                
                                                setTimeout(function(){
                                                    $(".error<?= $user['id']; ?>").text("");
                                                }, 2500);
                                            }
                                            else {
                                                $(".error<?= $user['id']; ?>").css({color: "red"}).text("Rank van gebruiker is al " + newRank);
                                                
                                                setTimeout(function(){
                                                    $(".error<?= $user['id']; ?>").text("");
                                                }, 5000);
                                            }
                                        }
                                    })
                                });
                            });
                        </script>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
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