$(document).ready(function() {    
    $("#menu_logo").on({
        mouseenter: function(){
            $("#theX").addClass("animated"); 
        },
        animationend: function(){
            $("#theX").removeClass("animated");
        }
    });
    
    $(".social_icon_a").on({
        mouseenter: function(){
            var element = $(this).find(".social_icon")[0];
            switch(element.id) {
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
            var element = $(this).find(".social_icon")[0];
            switch(element.id) {
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
            if ($("#faded").length) {
                $("#faded").remove();
                $("#menu_banner").stop().delay(500).hide(1);
            } else {
                $("#menu_banner").stop().show(1);
                $("#menu").append("<div id='faded'></div>");
            }
            
            $("#menu_banner").toggleClass("active");
            $("#burger_bar1").toggleClass("active");
            $("#burger_bar3").toggleClass("active");
            $("body").toggleClass("faded");
            $("main").toggleClass("faded");
        }
    });
    
    $(".menu_logo_link").on("click", function(e){
        var currentLocation = window.location.href;
        if(currentLocation.includes("?") == false){
            e.preventDefault();
            $("html, body").animate({scrollTop: 0}, 750);
        }
    });
    
    $("#searchButton").on("click", function(){
        $("#searchSubmit").click(); 
    });
    
    $("#searchBar").keyup(function(){
        $("#searchSubmit").click(); 
    });
    
    setInterval(function(){
        $("#searchSubmit").click(); 
    }, 1000);
    
    $("#searchSubmit").on("click", function(){
        if ($("#searchBar").val() !== ""){
            $.ajax({
            type: "POST",
            url: "/includes/search",
            data: {
                searchValue: $("#searchBar").val()
            },
            cache: false,
            success: function(data){
                var searchResults = JSON.parse(data);
                var searchTerm = $("#searchBar").val();
                
                $("#searchResults").empty().css({height: "auto"});
                $("#searchResult1").css({'padding-left': "0"});
                $("#searchResults").append("<span class='searchResultEntry' id='searchResult1'></span>");
                $("#searchResults").append("<span class='searchResultEntry' id='searchResult2'></span>");
                $("#searchResults").append("<span class='searchResultEntry' id='searchResult3'></span>");
                $("#searchResults").append("<span class='searchResultEntry' id='searchResult4'></span>");
                $("#searchResults").append("<span class='searchResultEntry' id='searchResult5'></span>");
                
                $.each(searchResults, function(index, value) {
                        if (value.substring(0, 3) == "CN:"){
                            var subValue = value.split("CN:");
                            var pattern = new RegExp(searchTerm, 'gi');
                            var boldedText = subValue[1].replace(pattern, function(x){
                                return "<span class='searchBold'>" + x + "</span>";
                            });
                            
                            $.ajax({
                                type: "POST",
                                url: "/includes/search",
                                async: false,
                                data: {
                                    getCategory: subValue[1]
                                },
                                cache: false,
                                success: function(data){
                                    searchResults[index] = "<a href='/categorie?c=" + data + "' class='searchLink'>" + boldedText + "</a>";
                                }
                            });
                        }
                        else if (value.substring(0, 3) == "CS:") {
                            var subValue = value.split("CS:");
                            var pattern = new RegExp(searchTerm, 'gi');
                            var boldedText = subValue[1].replace(pattern, function(x){
                                return "<span class='searchBold'>" + x + "</span>";
                            });
                            
                            searchResults[index] = "<a href='/categorie?c=" + subValue[1] + "' class='searchLink'>" + boldedText + "</a>";
                        }
                        else if (value.substring(0, 3) == "IN:") {
                            var subValue = value.split("IN:");
                            var pattern = new RegExp(searchTerm, 'gi');
                            var boldedText = subValue[1].replace(pattern, function(x){
                                return "<span class='searchBold'>" + x + "</span>";
                            });
                            
                            searchResults[index] = "<a href='/item?i=" + subValue[1] + "' class='searchLink'>" + boldedText + "</a>";
                        }
                        index = index + 2;
                    });
                
                if (searchResults[8] == undefined) {
                    if (searchResults[6] == undefined) {
                        if (searchResults[4] == undefined) {
                            if (searchResults[2] == undefined) {
                                if (searchResults[0] == undefined) {
                                    $("#searchResult1").html("Geen resultaten gevonden");
                                    $("#searchResult1").css({'padding-left': "7.5px"});
                                    $("#searchResult2").remove();
                                    $("#searchResult3").remove();
                                    $("#searchResult4").remove();
                                    $("#searchResult5").remove();
                                }
                                else {
                                    $("#searchResult1").html(searchResults[0]);
                                    $("#searchResult2").remove();
                                    $("#searchResult3").remove();
                                    $("#searchResult4").remove();
                                    $("#searchResult5").remove();
                                }
                            }
                            else {
                                $("#searchResult1").html(searchResults[0]);
                                $("#searchResult2").html(searchResults[2]);
                                $("#searchResult3").remove();
                                $("#searchResult4").remove();
                                $("#searchResult5").remove();
                            }
                        }
                        else {
                            $("#searchResult1").html(searchResults[0]);
                            $("#searchResult2").html(searchResults[2]);
                            $("#searchResult3").html(searchResults[4]);
                            $("#searchResult4").remove();
                            $("#searchResult5").remove();
                        }
                    }
                    else {
                        $("#searchResult1").html(searchResults[0]);
                        $("#searchResult2").html(searchResults[2]);
                        $("#searchResult3").html(searchResults[4]);
                        $("#searchResult4").html(searchResults[6]);
                        $("#searchResult5").remove();
                    }
                }
                else {
                    $("#searchResult1").html(searchResults[0]);
                    $("#searchResult2").html(searchResults[2]);
                    $("#searchResult3").html(searchResults[4]);
                    $("#searchResult4").html(searchResults[6]);
                    $("#searchResult5").html(searchResults[8]);
                }
            }
        });
        }
        else {
            $("#searchResults").empty();
        }
        
        return false;
    });
    
    $("#menu_banner").hide();
});