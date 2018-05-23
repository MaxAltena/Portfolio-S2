<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/connection.php');

$query = $PDO->prepare('SELECT short, name, preview FROM categories');
$query->execute();
$categories = $query->fetchAll();

?>
<div id="menu">
    <div id="left_banner">
        <div class="menu_box" id="menu_box_logo">
            <a href="../">
                <div class="menu_logo_link">
                    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/logo.svg'); ?>
                </div>
            </a>
        </div>
        <div class="menu_box">
            <div id="BURGER">
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/burger.svg'); ?>
            </div>
        </div>
        <div class="menu_box" id="menu_box_social">
            <a href="https://www.linkedin.com/in/MaxAltena/" target="_blank" class="social_icon_a">
                <div class="social_icon" id="LINKEDIN">
                    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/linkedin.svg'); ?>
                </div>
            </a>
            <a href="https://www.flickr.com/people/154548504@N07/" target="_blank" class="social_icon_a">
                <div class="social_icon" id="FLICKR">
                    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/flickr.svg'); ?>
                </div>
            </a>
            <a href="https://github.com/MaxAltena/" target="_blank" class="social_icon_a">
                <div class="social_icon" id="GITHUB">
                    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/github.svg'); ?>
                </div>
            </a>
        </div>
    </div>
    <div id="menu_banner">
        <div id="menu_banner_top">
            <div id="searchContainer">
                <form id="searchForm" autocomplete="off">
                    <input type="text" placeholder="Zoeken..." name="searchBar" id="searchBar" />
                    <div id="searchButton"><?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/search.svg'); ?></div>
                    <input type="submit" id="searchSubmit" value="" />
                </form>
                <div id="searchResults"></div>
                <script>
                    $(document).ready(function(){
                        $("#searchResults").css({height: "0"});
                    });
                </script>
            </div>
        </div>
        
        <div id="menu_banner_middle">
            <a href="../">
                <div class="menuLink" id="homeLink">
                    <div>
                        <h1>Home</h1>
                        <h2>Van alles wat</h2>
                    </div>
                </div>
            </a>
            <?php
            foreach($categories as $category) {
            ?>
            <a href="/categorie?c=<?= $category['short']; ?>">
                <div class="menuLink" id="<?= $category['short']; ?>Link">
                    <div>
                        <h1><?= $category['short']; ?></h1>
                        <h2><?= $category['name']; ?></h2>
                    </div>
                </div>
            </a>
            <?php
            }
            ?>
        </div>
        <div id="menu_banner_bottom">
            <a href="/documentatie/" id="documentatieLink">documentatie</a>
            <a href="/login" id="adminLink">inloggen</a>
        </div>
    </div>
</div>
<script src="/js/menu.js"></script>