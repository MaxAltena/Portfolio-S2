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
        window.location = "../";
    });
    
    $(".menu_logo_link").on("click", function(){
        window.location = "../";
    });
    
    $("#logout").on("click", function(){
        window.location = "../logout";
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

                var path = "/admin/pages/" + nextID;

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
    
    $("#content").load("/admin/pages/dashboard");
});