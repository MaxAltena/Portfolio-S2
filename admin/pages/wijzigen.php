<?php
session_start();
include_once('../../includes/connection.php');

if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['rank'] >= 1) {
?>
<main>
    <div class="gridHeader">
        <h1>Wijzigen</h1>
    </div>
    <div class="gridContent">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo vitae sapiente officiis omnis quidem fugiat odio quibusdam dolor libero odit adipisci aliquid praesentium nesciunt quia, necessitatibus facilis ut porro architecto at dolore excepturi maxime similique quis placeat consectetur! Soluta, error nisi delectus ratione nemo, aut. Obcaecati eaque tenetur aspernatur deserunt nostrum, id quae aliquam nam dolores commodi in, at facere praesentium porro? Velit blanditiis natus necessitatibus hic dolor est sed nesciunt quis, explicabo, quam earum in expedita tempore nostrum quo voluptatum assumenda quidem facere sequi? Amet voluptate natus eaque, sed quas saepe odit, ad perferendis architecto iusto, laudantium rerum esse.</p>
    </div>
</main>
<?php
    }
    else {
        ?>
        <h1 class="nicetry">Nice try!</h1>
        <?php
    }
}
else {
    header('Location: ../../login');
    exit();
}
?>