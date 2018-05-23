$(document).ready(function() {
    $(".categorieLink").on({
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
});