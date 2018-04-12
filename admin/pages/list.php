<?php
session_start();
include_once('../../includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
?>
<main>
    <div class="gridHeader">
        <h1>Lijst</h1>
    </div>
    <div class="gridContent">
        <p>Leuke lijstjes van items, categorieën en rubrix'!</p>
    </div>
</main>
<?php
}
else {
    header('Location: ../../login');
    exit();
}
?>