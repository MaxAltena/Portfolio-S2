$(document).ready(function(){
    $("#backtoCat").on({
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
});