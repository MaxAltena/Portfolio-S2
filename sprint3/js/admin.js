$(document).ready(function() {
    $("#menu_logo").on({
        mouseenter: function(){
            $("#theX").addClass("animated"); 
        },
        animationend: function(){
            $("#theX").removeClass("animated");
        }
    });
    
    $("#back").on("click", function(){
        $("#all").css({position: "absolute", left: 0})
        var width = $("#all").width();
        $("#all").animate({left: width}, 500, "easeInOutCubic", function(){
            setTimeout(function(){
                window.location = "/sprint3/";
            }, 500);
        });
    });
    
    $(".menu_logo_link").on("click", function(){
        $("#all").css({position: "absolute", left: 0})
        var width = $("#all").width();
        $("#all").animate({left: width}, 500, "easeInOutCubic", function(){
            setTimeout(function(){
                window.location = "/sprint3/";
            }, 500);
        });
    });
    
    $("#logout").on("click", function(){
       $("#all").css({position: "absolute", left: 0})
        var width = $("#all").width();
        $("#all").animate({left: width}, 500, "easeInOutCubic", function(){
            setTimeout(function(){
                window.location = "/sprint3/logout";
            }, 500);
        });
    });
    
    var clicked = false;
    $(".item").on("click", function(){
        if (clicked === false) {
            clicked = true;
            var currentID = $(".active")[0].id;
            var nextID = this.id;

            if (currentID !== nextID) {
                $(".active").removeClass("active");
                $(this).addClass("active");

                var path = "/sprint3/admin/pages/" + nextID;

                $("#content").hide("slide", { direction: "left" }, 500);

                setTimeout(function(){
                    $("#content").load(path).show("slide", { direction: "left" }, 500);
                }, 500);
            }
            
            setTimeout(function(){
                clicked = false;
            }, 1000);
        }
    });
    
    $("#content").load("/sprint3/admin/pages/dashboard");
});