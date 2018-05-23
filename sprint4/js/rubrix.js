$(document).ready(function(){
    $(".terug").on({
        mouseenter: function(){
            $(this).find(".textSpan").css({'padding-left': "5%", transition: "0.5s"});
            $(this).find(".arrowSpan").addClass("hovered");
            $(this).find(".arrowPath").css({fill: "#FFFFFF", transition: "0.5s"});
        },
        mouseleave: function(){
            $(this).find(".textSpan").css({'padding-left': "0%", transition: "0.5s"});
            $(this).find(".arrowSpan").removeClass("hovered");
            $(this).find(".arrowPath").css({fill: "rgba(0, 0, 0, 0.7)", transition: "0.5s"});
        }
    });
});