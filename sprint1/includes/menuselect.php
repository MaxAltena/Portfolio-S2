<?php
$shorts = array();
$names = array();
foreach ($categories as $category) {
    array_push($shorts, $category['short']);
    array_push($names, $category['name']);
}
?>

<script>
    var page = <?= json_encode($page); ?>;
    var shorts = <?= json_encode($shorts); ?>;
    var names = <?= json_encode($names); ?>;

    switch(page) {
        case "Home":
            $(".menuLink:contains('Home')").addClass("current");
            break;
    <?php
        foreach ($shorts as &$value) {
            echo('case "'.$value.'": $(".menuLink:contains('.$value.')").addClass("current"); break;');
        }
    ?>
}
</script>