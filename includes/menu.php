<?php
include_once('includes/connection.php');
include_once('includes/query.php');

$category = new Category;
$categories = $category->fetch();

?>
<div id="menu">
    <div id="left_banner">
        <div class="menu_box" id="menu_box_logo">
            <div class="menu_logo_link">
                <?php include('assets/logo.svg'); ?>
            </div>
        </div>
        <div class="menu_box">
            <div id="BURGER">
                <?php include('assets/burger.svg'); ?>
            </div>
        </div>
        <div class="menu_box" id="menu_box_social">
            <div class="social_icon" id="LINKEDIN">
                <?php include('assets/linkedin.svg'); ?>
            </div>
            <div class="social_icon" id="FLICKR">
                <?php include('assets/flickr.svg'); ?>
            </div>
            <div class="social_icon" id="GITHUB">
                <?php include('assets/github.svg'); ?>
            </div>
        </div>
    </div>
    <div id="menu_banner">
        <div id="menu_banner_top">
            <div id="searchContainer">
                <form id="searchForm" autocomplete="off">
                    <input type="text" placeholder="Zoeken..." name="searchBar" id="searchBar" />
                    <div id="searchButton"><?php include('assets/search.svg'); ?></div>
                    <input type="submit" id="searchSubmit" value="" />
                </form>
                <div id="searchResults">
                </div>
            </div>
        </div>
        
        <div id="menu_banner_middle">
            <div class="menuLink" id="homeLink">
                <div>
                    <h1>Home</h1>
                    <h2>Van alles wat</h2>
                </div>
            </div>
            <script></script>
            <?php
            foreach($categories as $category) {
            ?>
            <div class="menuLink" id="<?= $category['short']; ?>Link">
                <div>
                    <h1><?= $category['short']; ?></h1>
                    <h2><?= $category['name']; ?></h2>
                </div>
            </div>
            <script>$("#<?= $category['short']; ?>Link").on("click", function(){ $("#menu_banner").css({position: "absolute"}); $("body").css({position: "absolute", right: 0}); var width = $("body").width(); $("body").animate({right: width}, 500, "easeInOutCubic", function(){ setTimeout(function(){ window.location = "/categorie?c=<?= $category['short']; ?>"; }, 500);});});</script>
            <?php
            }
            ?>
        </div>
        <div id="menu_banner_bottom">
            <p id="documentatieLink">documentatie</p>
            <p id="adminLink">inloggen</p>
        </div>
    </div>
</div>
<script src="../js/menu.js"></script>