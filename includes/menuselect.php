<?php
$shorts = array();
$names = array();
foreach ($categories as $category) {
    array_push($shorts, $category['short']);
    array_push($names, $category['name']);
}

if ($page == null) {
    $page = 0;
}
?>

<script>
    var page = <?= json_encode($page); ?>;
    var shorts = <?= json_encode($shorts); ?>;
    var names = <?= json_encode($names); ?>;

    switch(page) {
        default:
        case "0":
            break;
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