<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if (isset($_POST['list'])) {
        $query = $PDO->prepare('SELECT id FROM categories WHERE short = ?');
        $query->bindValue(1, $_POST['myCategory']);
        $query->execute();
        $result = $query->fetch();
        $category = $result[0];
        
        $query = $PDO->prepare('UPDATE items SET name = ?, description = ?, spotlight = ?, sprint = ?, category = ? WHERE id = ?');
        $query->bindValue(1, $_POST['myName']);
        $query->bindValue(2, $_POST['myDescription']);
        $query->bindValue(3, $_POST['mySpotlight']);
        if($_POST['mySprint'] == "0"){
            $query->bindValue(4, NULL);
        }
        else {
            $query->bindValue(4, $_POST['mySprint']);
        }
        $query->bindValue(5, $category);
        $query->bindValue(6, $_POST['myID']);
        $query->execute();
        
        if($query->rowCount() ? true : false == true){
            echo("Het item is geupdate!");
        }
        else {
            echo("Oeps, er ging iets mis.");
        }
    }
    else {
    $query = $PDO->prepare('SELECT * FROM items');
    $query->execute();
    $items = $query->fetchAll();
    
    $query = $PDO->prepare('SELECT * FROM categories');
    $query->execute();
    $categories = $query->fetchAll();
?>
<main>
    <div class="gridHeader">
        <h1>Lijst</h1>
    </div>
    <div class="gridContent listContent">
        <div class="filterList">
            <div class="filterSprint">
                <p>Filter op sprint</p>
                <p class="filterPlist"><span class="filterOptionSprint activeFilterSprint" id="filterSprintAlles">Alles</span><span class="filterOptionSprint" id="filterSprint1">1</span><span class="filterOptionSprint" id="filterSprint2">2</span><span class="filterOptionSprint" id="filterSprint3">3</span><span class="filterOptionSprint" id="filterSprint4">4</span><span class="filterOptionSprint" id="filterSprint5">5</span></p>
            </div>
            <div class="filterCategory">
                <p>Filter op categorie</p>
                <p class="filterPlist"><span class="filterOptionCategory activeFilterCategory" id="filterCategoryAlles">Alles</span>
                <?php
                    foreach($categories as $category){
                        ?>
                    <span class="filterOptionCategory" id="filterCategory<?= $category['short']; ?>"><?= $category['short']; ?></span>
                        <?php
                    }
                ?></p>
            </div>
            <div class="filterSpotlight">
                <p>Filter op uitgelicht</p>
                <p class="filterPlist"><span class="filterOptionSpotlight activeFilterSpotlight" id="filterSpotlightAlles">Alles</span><span class="filterOptionSpotlight" id="filterSpotlight0">Nee</span><span class="filterOptionSpotlight" id="filterSpotlight1">Ja</span></p>
            </div>
            <script>
                $(document).ready(function(){
                    var filterSprint = "Alles";
                    $(".filterOptionSprint").on("click", function(){
                        var filterID = this.id;
                        var arrayFilter = filterID.split('filterSprint');
                        filterSprint = arrayFilter[1];
                        
                        $(".activeFilterSprint").removeClass("activeFilterSprint");
                        $(this).addClass("activeFilterSprint");
                        
                        setFilter();
                    });
                    
                    var filterCategory = "Alles";
                    $(".filterOptionCategory").on("click", function(){
                        var filterID = this.id;
                        var arrayFilter = filterID.split('filterCategory');
                        filterCategory = arrayFilter[1];
                        
                        $(".activeFilterCategory").removeClass("activeFilterCategory");
                        $(this).addClass("activeFilterCategory");
                        
                        setFilter();
                    });
                    
                    var filterSpotlight = "Alles";
                    $(".filterOptionSpotlight").on("click", function(){
                        var filterID = this.id;
                        var arrayFilter = filterID.split('filterSpotlight');
                        filterSpotlight = arrayFilter[1];
                        
                        $(".activeFilterSpotlight").removeClass("activeFilterSpotlight");
                        $(this).addClass("activeFilterSpotlight");
                        
                        setFilter();
                    });
                    
                    function setFilter(){
                        var element = "";
                        
                        if(filterSprint !== "Alles"){
                            element = ".trSprint" + filterSprint;
                        }
                        
                        if(filterCategory !== "Alles"){
                            element = element + ".trCategory" + filterCategory;
                        }
                        
                        if(filterSpotlight !== "Alles"){
                            element = element + ".trSpotlight" + filterSpotlight;
                        }
                        
                        console.log(element);
                        
                        if(element == ""){
                            $(".trAll").show();
                        }
                        else {
                            $(".trAll").hide();
                            $(element).show();
                        }
                    }
                });
            </script>
        </div>
        
        <div id="table_wrapper">
            <div id="theader">
                <div>Naam</div>
                <div>Omschrijving</div>
                <div>Uitgelicht</div>
                <div>Sprint</div>
                <div>Categorie</div>
                <div></div>
            </div>
            <div id="tbody">
                <table class="listTable">
                    <tbody>
                        <?php
                            foreach($items as $item){
                                $query = $PDO->prepare('SELECT name, short FROM categories WHERE id = ?');
                                $query->bindValue(1, $item['category']);
                                $query->execute();
                                $category = $query->fetch();
                        ?>
                            <tr class="trAll tr<?= $item['id']; ?> trSprint<?= $item['sprint']; ?> trCategory<?= $category['short']; ?> trSpotlight<?= $item['spotlight']; ?>">
                                <td>
                                    <?= $item['name']; ?>
                                </td>
                                <td>
                                    <?= $item['description']; ?>
                                </td>
                                <td>
                        <?php
                                switch($item['spotlight']){
                                    default:
                                    case 0:
                                        ?>
                                        Nee
                                        <?php
                                        break;
                                    case 1:
                                        ?>
                                        Ja
                                        <?php
                                        break;
                                }
                        ?>
                                </td>
                                <td>
                        <?php
                                    if($item['sprint'] == ""){
                                        $item['sprint'] = 0;
                                       ?>
                                       Geen
                                       <?php
                                    }
                                    else {
                                        ?>
                                        <?= $item['sprint']; ?>
                                        <?php
                                    }
                        ?>
                                </td>
                                <td>
                                    <?= $category['short']; ?>
                                </td>
                                <td>
                        <?php
                                    if($_SESSION['rank'] >= 1){
                                        ?>
                                            <button id="button<?= $item['id']; ?>" name="button<?= $item['id']; ?>" class="listButton">Verander</button>
                                        <?php
                                    }
                        ?>
                                </td>

                                <script>
                                    $(document).ready(function(){
                                        $("#button<?= $item['id']; ?>").on("click", function(){
                                            $("#editMe").fadeIn(250);
                                            $("#editMe #myName").val("<?= $item['name']; ?>");
                                            $("#editMe #myDescription").val("<?= $item['description']; ?>");
                                            $("#editMe #mySpotlight").val("<?= $item['spotlight']; ?>");
                                            $("#editMe #mySprint").val("<?= $item['sprint']; ?>");
                                            $("#editMe #myID").val("<?= $item['id']; ?>");
                                            $("#editMe #myCategory").val("<?= $category['short']; ?>");
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
        </div>
           
        <?php
            if($_SESSION['rank'] >= 1) {
        ?>
            <div id="editMe" style="display: none;">
                <div>
                    <svg id="exitIcon" viewBox="0 0 220.176 220.176"><path d="M131.577,110.084l84.176-84.146c5.897-5.928,5.897-15.565,0-21.492c-5.928-5.928-15.595-5.928-21.492,0l-84.176,84.146L25.938,4.446c-5.928-5.928-15.565-5.928-21.492,0s-5.928,15.565,0,21.492l84.146,84.146L4.446,194.26c-5.928,5.897-5.928,15.565,0,21.492c5.928,5.897,15.565,5.897,21.492,0l84.146-84.176l84.176,84.176c5.897,5.897,15.565,5.897,21.492,0c5.897-5.928,5.897-15.595,0-21.492L131.577,110.084z" fill="#202020"/></svg>
                </div>
                <form id="formList">
                    <div>Naam:</div>
                    <div>Omschrijving:</div>
                    <div>Uitgelicht:</div>
                    <div>Sprint:</div>
                    <div>Categorie:</div>
                    
                    <input type="text" name="myName" id="myName" placeholder="Naam" required />
                    <input type="text" name="myDescription" id="myDescription" placeholder="Omschrijving" required />
                    <select name="mySpotlight" id="mySpotlight" required>
                        <option value="0">Nee</option>
                        <option value="1">Ja</option>
                    </select>
                    <select name="mySprint" id="mySprint" required>
                        <option value="0">Geen sprint</option>
                        <option value="1">Sprint 1</option>
                        <option value="2">Sprint 2</option>
                        <option value="3">Sprint 3</option>
                        <option value="4">Sprint 4</option>
                        <option value="5">Sprint 5</option>
                    </select>
                    <select name="myCategory" id="myCategory" required>
                        <?php
                            $query = $PDO->prepare('SELECT * FROM categories');
                            $query->execute();
                            $categories = $query->fetchAll();
                            
                            foreach($categories as $category) {
                                ?>
                                <option value="<?= $category['short'] ?>"><?= $category['name']; ?> (<?= $category['short']; ?>)</option>
                                <?php
                            }
                        ?>
                    </select>
                    <input type="hidden" name="myID" id="myID" />
                    <input type="submit" name="submit" id="submit" value="Item wijzigen" />
                </form>
                <script>
                    $(document).ready(function(){
                        $("#exitIcon").on("click", function(){
                            $("#editMe").fadeOut(250);
                            $("#myName").val("");
                            $("#myDescription").val("");
                            $("#mySpotlight").val("");
                            $("#mySprint").val("");
                            $("#myCategory").val("");
                            $("#myID").val("");
                        });
                        
                        $("#formList").submit(function(e){
                            e.preventDefault();
                            
                            if (confirm("Weet je zeker dat je dit item wilt wijzigen?")){
                                var formData = new FormData(this);
                                formData.append("list", "list"); 

                                $.ajax({
                                    type: "POST",
                                    url: "/admin/pages/list",
                                    data: formData,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(result){
                                        alert(result);
                                        $("#content").hide("slide", { direction: "left" }, 500);
                                        setTimeout(function(){
                                            $("#content").load("/admin/pages/list").show("slide", { direction: "left" }, 500);
                                        }, 500);
                                    }
                                });
                            }
                        });
                    });
                </script>
            </div>
        <?php
            }
        ?>
    </div>
    <script>
        $(document).ready(function(){
            $("#theader div:nth-child(1)").width($("tbody .trAll td:nth-child(1)").width());
            $("#theader div:nth-child(2)").width($("tbody .trAll td:nth-child(2)").width());
            $("#theader div:nth-child(3)").width($("tbody .trAll td:nth-child(3)").width());
            $("#theader div:nth-child(4)").width($("tbody .trAll td:nth-child(4)").width());
            $("#theader div:nth-child(5)").width($("tbody .trAll td:nth-child(5)").width());
            $("#theader div:nth-child(6)").width($("tbody .trAll td:nth-child(6)").width());
        });
    </script>
</main>
<?php 
    }
}
else {
    header('Location: /login');
    exit();
}
?>