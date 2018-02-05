<?php

include_once("includes/connection.php");

?>

<html lang="nl">
    <head>
        <title>Max Altena</title>
        <?php include_once("includes/header.php"); ?>
        <link rel="stylesheet" type="text/css" href="css/indexstyle.css">
    </head>

    <body>
        <div id="left_banner">
            <div class="menu_box" id="menu_box_logo">
                <a href="https://i371527.hera.fhict.nl/" id="menu_logo_link">
                    <?php include("assets/logo.svg"); ?>
                </a>
            </div>
            <div class="menu_box">
                <div id="BURGER">
                    <?php include("assets/burger.svg"); ?>
                </div>
            </div>
            <div class="menu_box" id="menu_box_social">
                <a href="https://www.linkedin.com/in/MaxAltena/" target="_blank" class="social_icon" id="LINKEDIN">
                    <?php include("assets/linkedin.svg"); ?>
                </a>
                <a href="https://www.flickr.com/people/154548504@N07/" target="_blank" class="social_icon" id="FLICKR">
                    <?php include("assets/flickr.svg"); ?>
                </a>
            </div>
        </div>
        <div id="menu_banner">
            <div id="menu_banner_top">
                
            </div>
            <div id="menu_banner_middle">
                <a href="">HOME</a>
                <a href="">DED</a>
                <a href="">SCO</a>
                <a href="">UXU</a>
                <a href="">PTM</a>
                <div class="menu_link">
                    HOME
                </div>
            </div>
            <div id="menu_banner_bottom">
                <a href="admin">aanmelden</a>
                <p>Gemaakt door Max Altena</p>
            </div>
        </div>
        <main>

        </main>
        
        <script>
            $(document).ready(function() {
                $("#menu_logo").on({
                    mouseenter: function(){
                        $("#theX").addClass("animated"); 
                    },
                    animationend: function(){
                        $("#theX").removeClass("animated");
                    }
                });
                
                $(".social_icon").on({
                    mouseenter: function(){
                        switch($(this).attr("id")) {
                            case "LINKEDIN":
                                $("#theLINKEDIN").css({fill: "#FECD18", transition: "0.2s"});
                                break;
                            case "FLICKR":
                                $("#theFLICKR").css({fill: "#FECD18", transition: "0.2s"});
                                break;
                        }
                    },
                    mouseleave: function(){
                        switch($(this).attr("id")) {
                            case "LINKEDIN":
                                $("#theLINKEDIN").css({fill: "#000000", transition: "0.2s"});
                                break;
                            case "FLICKR":
                                $("#theFLICKR").css({fill: "#000000", transition: "0.2s"});
                                break;
                        }
                    }
                });
                
                $("#BURGER").on({
                    mouseenter: function(){
                        $(this).addClass("active");
                        $("#burger_bar1").css({fill: "#FECD18", transition: "0.2s"});
                        $("#burger_bar2").css({fill: "#FECD18", transition: "0.2s"});
                        $("#burger_bar3").css({fill: "#FECD18", transition: "0.2s"});
                    },
                    mouseleave: function(){
                        $(this).removeClass("active");
                        $("#burger_bar1").css({fill: "#000000", transition: "0.2s"});
                        $("#burger_bar2").css({fill: "#000000", transition: "0.2s"});
                        $("#burger_bar3").css({fill: "#000000", transition: "0.2s"});
                    },
                    click: function(){
                        $("#menu_banner").toggleClass("active");
                        $("#burger_bar1").toggleClass("active");
                        $("#burger_bar3").toggleClass("active");
                    }
                });
            });
        </script>
    </body>
</html>