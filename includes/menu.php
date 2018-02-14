<?php

include_once('includes/connection.php');
include_once('includes/query.php');

$category = new Category;
$categories = $category->fetch();

?>
<div id="menu">
    <div id="left_banner">
        <div class="menu_box" id="menu_box_logo">
            <a href="https://i371527.hera.fhict.nl/" id="menu_logo_link">
                <?php include('assets/logo.svg'); ?>
            </a>
        </div>
        <div class="menu_box">
            <div id="BURGER">
                <?php include('assets/burger.svg'); ?>
            </div>
        </div>
        <div class="menu_box" id="menu_box_social">
            <a href="https://www.linkedin.com/in/MaxAltena/" target="_blank" class="social_icon" id="LINKEDIN">
                <?php include('assets/linkedin.svg'); ?>
            </a>
            <a href="https://www.flickr.com/people/154548504@N07/" target="_blank" class="social_icon" id="FLICKR">
                <?php include('assets/flickr.svg'); ?>
            </a>
            <a href="https://github.com/MaxAltena/" target="_blank" class="social_icon" id="GITHUB">
                <?php include('assets/github.svg'); ?>
            </a>
        </div>
    </div>
    <div id="menu_banner">
        <div id="menu_banner_top"><a href="https://i371527.hera.fhict.nl/documentatie/">documentatie</a></div>
        <div id="menu_banner_middle">
            <a href="https://i371527.hera.fhict.nl/" class="menuLink">
                <div>
                    <h1>Home</h1>
                    <h2>Van alles wat</h2>
                </div>
            </a>
            <?php
            foreach($categories as $category) {
                echo('<a href="https://i371527.hera.fhict.nl/categorie?c='.$category['short'].'" class="menuLink"><div><h1>'.$category['short'].'</h1><h2>'.$category['name'].'</h2></div></a>');
            }
            ?>
        </div>
        <div id="menu_banner_bottom">
            <a href="https://i371527.hera.fhict.nl/admin/">aanmelden</a>
            <p>Gemaakt door Max Altena</p>
        </div>
    </div>
</div>