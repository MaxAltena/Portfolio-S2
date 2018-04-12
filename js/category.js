$(document).ready(function() {
    $(".itemLink").on({
        mouseenter: function(){
            $(this).find(".firstClass").css({'padding-left': "4%", transition: "0.5s"});
            $(this).find("h1").css({color: "#FFFFFF", transition: "0.5s"});
            $(this).find("h2").css({color: "#FFFFFF", transition: "0.5s"});
            $(this).find(".arrowSpan").addClass("hovered");
            $(this).find(".arrowPath").css({fill: "#FFFFFF", transition: "0.5s"});
        },
        mouseleave: function(){
            $(this).find(".firstClass").css({'padding-left': "0%", transition: "0.5s"});
            $(this).find("h1").css({color: "#000000", transition: "0.5s"});
            $(this).find("h2").css({color: "#7D7D7D", transition: "0.5s"});
            $(this).find(".arrowSpan").removeClass("hovered");
            $(this).find(".arrowPath").css({fill: "rgba(0, 0, 0, 0.7)", transition: "0.5s"});
        }
    });
    
    $("#rubrixLink").on({
        mouseenter: function(){
            $(this).find(".textSpan").css({'padding-right': "5%", transition: "0.5s"});
            $(this).find(".arrowSpan").addClass("hovered");
            $(this).find(".arrowPath").css({fill: "#FFFFFF", transition: "0.5s"});
        },
        mouseleave: function(){
            $(this).find(".textSpan").css({'padding-right': "0%", transition: "0.5s"});
            $(this).find(".arrowSpan").removeClass("hovered");
            $(this).find(".arrowPath").css({fill: "rgba(0, 0, 0, 0.7)", transition: "0.5s"});
        }
    });
    
    $("#backtoHome").on({
        mouseenter: function(){
            $(this).find(".footerLink").css({'padding-left': "2%", transition: "0.5s"});
            $(this).find(".arrowSpan").addClass("hovered");
            $(this).find(".arrowPath").css({fill: "#FFFFFF", transition: "0.5s"});
        },
        mouseleave: function(){
            $(this).find(".footerLink").css({'padding-left': "0%", transition: "0.5s"});
            $(this).find(".arrowSpan").removeClass("hovered");
            $(this).find(".arrowPath").css({fill: "rgba(0, 0, 0, 0.7)", transition: "0.5s"});
        }
    });
    
    $("#backtoTop").on({
        mouseenter: function(){
            $(this).find(".footerLink").css({'padding-right': "2%", transition: "0.5s"});
            $(this).find(".arrowSpan").addClass("hovered");
            $(this).find(".arrowPath").css({fill: "#FFFFFF", transition: "0.5s"});
        },
        mouseleave: function(){
            $(this).find(".footerLink").css({'padding-right': "0%", transition: "0.5s"});
            $(this).find(".arrowSpan").removeClass("hovered");
            $(this).find(".arrowPath").css({fill: "rgba(0, 0, 0, 0.7)", transition: "0.5s"});
        }
    });
    
    $(".backtoTop").on("click", function(){
        $("html, body").animate({scrollTop: 0}, 750);
    });
    
    $(".backtoHome").on("click", function(){
        $("body").css({position: "absolute", left: 0});
        var width = $("body").width();
        $("body").animate({left: width}, 500, "easeInOutCubic", function(){
            setTimeout(function(){
                window.location = "../";
            }, 500);
        });
    });
});