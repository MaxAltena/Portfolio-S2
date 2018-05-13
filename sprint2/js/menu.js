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
                case "GITHUB":
                    $("#theGITHUB").css({fill: "#FECD18", transition: "0.2s"});
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
                case "GITHUB":
                    $("#theGITHUB").css({fill: "#000000", transition: "0.2s"});
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
            $("#burger_bar3").addClass("longer");
        },
        mouseleave: function(){
            $(this).removeClass("active");
            $("#burger_bar1").css({fill: "#000000", transition: "0.2s"});
            $("#burger_bar2").css({fill: "#000000", transition: "0.2s"});
            $("#burger_bar3").css({fill: "#000000", transition: "0.2s"});
            $("#burger_bar3").removeClass("longer");
        },
        click: function(){
            $("#menu_banner").toggleClass("active");
            $("#burger_bar1").toggleClass("active");
            $("#burger_bar3").toggleClass("active");
            $("body").toggleClass("faded");
            $("main").toggleClass("faded");
            
            if ($("#faded").length) {
                $("#faded").remove();
            } else {
                $("#menu").append("<div id='faded'></div>");
            }
        }
    });
});