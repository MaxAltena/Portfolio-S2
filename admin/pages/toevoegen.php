<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['rank'] >= 1) {
        if(isset($_POST['add'])){
            function isEmpty($value) {
                $strTemp = $value;
                $strTemp = trim($strTemp);
                
                if($strTemp == ""){
                    return true;
                }
                return false;
            }
            
            $name = $_POST['name'];
            $description = $_POST['description'];
            $preview = $_POST['preview'];
            $opdracht = $_POST['opdracht'];
            $uitvoering = $_POST['uitvoering'];
            $feedback = $_POST['feedback'];
            $reflectie = $_POST['reflectie'];
            $media = $_POST['media'];
            $document = $_POST['document'];
            $video = $_POST['video'];
            $related = $_POST['related'];
            $spotlight = $_POST['spotlight'];
            $sprint = $_POST['sprint'];
            $category = $_POST['category'];
            
            $query = $PDO->prepare('SELECT name FROM items WHERE name = ?');
            $query->bindValue(1, $name);
            $query->execute();
            $result = $query->rowCount() ? true : false;
            
            if($result === false){
                $query = $PDO->prepare('INSERT INTO items (name, description, preview, opdracht, uitvoering, feedback, reflectie, media, document, video, related, spotlight, sprint, category) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $query->bindValue(1, $name);
                if(isEmpty($description)){
                    $query->bindValue(2, NULL);
                }
                else {
                    $query->bindValue(2, $description);
                }
                if(isEmpty($preview)){
                    $query->bindValue(3, NULL);
                }
                else {
                    $query->bindValue(3, $preview);
                }
                if(isEmpty($opdracht)){
                    $query->bindValue(4, NULL);
                }
                else {
                    $query->bindValue(4, $opdracht);
                }
                if(isEmpty($uitvoering)){
                    $query->bindValue(5, NULL);
                }
                else {
                    $query->bindValue(5, $uitvoering);
                }
                if(isEmpty($feedback)){
                    $query->bindValue(6, NULL);
                }
                else {
                    $query->bindValue(6, $feedback);
                }
                if(isEmpty($reflectie)){
                    $query->bindValue(7, NULL);
                }
                else {
                    $query->bindValue(7, $reflectie);
                }
                if(isEmpty($media)){
                    $query->bindValue(8, NULL);
                }
                else {
                    $query->bindValue(8, $media);
                }
                if(isEmpty($document)){
                    $query->bindValue(9, NULL);
                }
                else {
                    $query->bindValue(9, $document);
                }
                if(isEmpty($video)){
                    $query->bindValue(10, NULL);
                }
                else {
                    $query->bindValue(10, $video);
                }
                if(isEmpty($related)){
                    $query->bindValue(11, NULL);
                }
                else {
                    $query->bindValue(11, $related);
                }
                if(isEmpty($spotlight)){
                    $query->bindValue(12, NULL);
                }
                else {
                    $query->bindValue(12, $spotlight);
                }
                if(isEmpty($sprint)){
                    $query->bindValue(13, NULL);
                }
                else {
                    $query->bindValue(13, $sprint);
                }
                $query->bindValue(14, $category);
                $query->execute();
                $result = $query->rowCount() ? true : false;

                if($result === true) {
                    echo("Item is succesvol toegevoegd!");
                }
                else {
                    echo("Oops, er ging iets mis");
                }
            }
            else {
                echo("Een item met deze naam bestaat al!");
            }
        }
        else {
            $query = $PDO->prepare('SELECT * FROM items');
            $query->execute();
            $items = $query->fetchAll();
?>
<main>
    <div class="gridHeader">
        <h1>Toevoegen</h1>
    </div>
    <div class="gridContent addContent">
        <div id="editFormContainer">
            <h3 id="formHeader">Toevoegen van item</h3>
            <form autocomplete="off" id="editorForm">
                <input type="hidden" name="idE" id="idE" />
                <div class="aTag" id="naamT">Naam:</div>
                <input type="text" name="naamE" id="naamE" placeholder="Naam" required />
                <div class="aTag" id="descriptionT">Omschrijving:</div>
                <input type="text" name="descriptionE" id="descriptionE" placeholder="Omschrijving" />
                <div class="aTag" id="opdrachtT">Opdracht:</div>
                <textarea name="opdrachtE" id="opdrachtE" form="editorForm" placeholder="Opdracht"></textarea>
                <div class="aTag" id="uitvoeringT">Uitvoering:</div>
                <textarea name="uitvoeringE" id="uitvoeringE" form="editorForm" placeholder="Uitvoering"></textarea>
                <div class="aTag" id="feedbackT">Feedback:</div>
                <textarea name="feedbackE" id="feedbackE" form="editorForm" placeholder="Feedback"></textarea>
                <div class="aTag" id="reflectieT">Reflectie:</div>
                <textarea name="reflectieE" id="reflectieE" form="editorForm" placeholder="Reflectie"></textarea>
                <div class="aTag" id="sprintT">Sprint:</div>
                <select name="sprintE" id="sprintE">
                    <option value="">Geen sprint</option>
                    <option value="1">Sprint 1</option>
                    <option value="2">Sprint 2</option>
                    <option value="3">Sprint 3</option>
                    <option value="4">Sprint 4</option>
                    <option value="5">Sprint 5</option>
                </select>
                <div class="aTag" id="categoryT">Categorie:</div>
                <select name="categoryE" id="categoryE" required>
                    <?php
                        $query = $PDO->prepare('SELECT * FROM categories');
                        $query->execute();
                        $categories = $query->fetchAll();

                        foreach($categories as $category) {
                            ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name']; ?> (<?= $category['short']; ?>)</option>
                            <?php
                        }
                    ?>
                </select>
                <div class="aTag" id="spotlightT">Uitgelicht:</div>
                <select name="spotlightE" id="spotlightE" required>
                    <option value="0">Nee</option>
                    <option value="1">Ja</option>
                </select>
                <div class="aTag" id="relatedT">Gerelateerd:</div>
                <select multiple name="relatedE" id="relatedE">
                    <?php
                        $query = $PDO->prepare('SELECT id, name, category FROM items');
                        $query->execute();
                        $result = $query->fetchAll();

                        foreach($result as $item){
                    ?>
                            <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                    <?php
                        }
                    ?>
                </select>
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
                <div class="aTag" id="mediaT">Fotos:</div>
                <select multiple name="mediaE" id="mediaE">
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
                <div class="aTag" id="documentT">Document:</div>
                <select name="documentE" id="documentE">
                    <option value="">Geen document</option>
                    <?php
                        $query = $PDO->prepare('SELECT id, name FROM media WHERE type = "DOC"');
                        $query->execute();
                        $result = $query->fetchAll();

                        foreach($result as $document){
                    ?>
                            <option value="<?= $document['id']; ?>"><?= $document['name']; ?></option>
                    <?php
                        }
                    ?>
                </select>
                <div class="aTag" id="videoT">Video:</div>
                <select name="videoE" id="videoE">
                    <option value="">Geen video</option>
                    <?php
                        $query = $PDO->prepare('SELECT id, name FROM media WHERE type = "VID"');
                        $query->execute();
                        $result = $query->fetchAll();

                        foreach($result as $video){
                    ?>
                            <option value="<?= $video['id']; ?>"><?= $video['name']; ?></option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" name="submitE" id="submitE" class="submit" value="Item toevoegen" />

                <div class="styleInfo">
                    <p class="uitleg">Styling toepassen</p>
                    <div class="bold">
                        <p>Dikgedrukt</p>
                        <p>Gebruik *tekst*</p>
                        <p>Input:</p>
                        <p>*Dikgedrukte* tekst</p>
                        <p>Output:</p>
                        <p><span class="bold">Dikgedrukte</span> tekst</p>
                    </div>
                    <div class="italic">
                        <p>Cursief</p>
                        <p>Gebruik ~tekst~</p>
                        <p>Input:</p>
                        <p>~Cursieve~ tekst</p>
                        <p>Output:</p>
                        <p><span class="italic">Cursieve</span> tekst</p>
                    </div>
                    <div class="underline">
                        <p>Onderlijnd</p>
                        <p>Gebruik _tekst_</p>
                        <p>Input:</p>
                        <p>_Onderlijnde_ tekst</p>
                        <p>Output:</p>
                        <p><span class="underline">Onderlijnde</span> tekst</p>
                    </div>
                    <div class="link">
                        <p>Link</p>
                        <p>Gebruik []link[]</p>
                        <p>Input:</p>
                        <p>[]https://google.com/[]</p>
                        <p>Output:</p>
                        <p><a href="https://google.com/" target="_blank" class="link">https://google.com/</a></p>
                    </div>
                    <div class="paragraph">
                        <p>Paragraaf</p>
                        <p>Gebruik tekst1|tekst2</p>
                        <p>Input:</p>
                        <p>Eerste|Tweede</p>
                        <p>Output:</p>
                        <p>Eerste</p>
                        <p>Tweede</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $("#relatedE").multiSelect({
            selectableHeader: "<div class='searchHeader'>Alle items</div><input type='text' class='search-input' autocomplete='off' placeholder='Zoek in alle items...'>",
            selectionHeader: "<div class='searchHeader'>Gerelateerde items</div><input type='text' class='search-input' autocomplete='off' placeholder='Zoek in gerelateerde items...'>",
            afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
              if (e.which === 40){
                that.$selectableUl.focus();
                return false;
              }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
              if (e.which == 40){
                that.$selectionUl.focus();
                return false;
              }
            });
          },
            afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
          },
            afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
          }
        });
        
        $("#mediaE").multiSelect({
          selectableHeader: "<div class='searchHeader'>Alle fotos</div><input type='text' class='search-input' autocomplete='off' placeholder='Zoek in alle fotos...'>",
          selectionHeader: "<div class='searchHeader'>Gekozen fotos</div><input type='text' class='search-input' autocomplete='off' placeholder='Zoek in gekozen fotos...'>",
          afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
              if (e.which === 40){
                that.$selectableUl.focus();
                return false;
              }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
              if (e.which == 40){
                that.$selectionUl.focus();
                return false;
              }
            });
          },
          afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
          },
          afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
          }
        });
        
        $("#editorForm").submit(function(e){
            e.preventDefault();
            
            var myName = $("#naamE").val();
            var myDescription = $("#descriptionE").val();
            var myPreview = $("#previewE").val();
            var myOpdracht = $("#opdrachtE").val();
            var myUitvoering = $("#uitvoeringE").val();
            var myFeedback = $("#feedbackE").val();
            var myReflectie = $("#reflectieE").val();
            var myMedia = $("#mediaE").val().toString().replace(/,/g, "|");
            var myDocument = $("#documentE").val();
            var myVideo = $("#videoE").val();
            var myRelated = $("#relatedE").val().toString().replace(/,/g, "|");
            var mySpotlight = $("#spotlightE").val();
            var mySprint = $("#sprintE").val();
            var myCategory = $("#categoryE").val();
            
            $.ajax({
                type: "POST",
                url: "/admin/pages/toevoegen",
                data: {
                    add: "Y",
                    name: myName,
                    description: myDescription,
                    preview: myPreview,
                    opdracht: myOpdracht,
                    uitvoering: myUitvoering,
                    feedback: myFeedback,
                    reflectie: myReflectie,
                    media: myMedia,
                    document: myDocument,
                    video: myVideo,
                    related: myRelated,
                    spotlight: mySpotlight,
                    sprint: mySprint,
                    category: myCategory
                },
                cache: false,
                success: function(result){
                    if(result == "Item is succesvol toegevoegd!"){
                        alert(result);
                        $("#content").hide("slide", { direction: "left" }, 500);
                        setTimeout(function(){
                            $("#content").load("/admin/pages/toevoegen").show("slide", { direction: "left" }, 500);
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