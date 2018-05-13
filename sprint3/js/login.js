$(document).ready(function(){
    $("#backTo").on("click", function(){
        $("main").css({position: "absolute", left: 0})
        var width = $("main").width();
        $("main").animate({left: width}, 500, "easeInOutCubic", function(){
            setTimeout(function(){
                window.location = "/sprint3/";
            }, 500);
        });
    });
    
    $("#submitLogin").on("click", function(){
        $("#error").fadeOut(300);
        
        if ($("#gebruikersnaamLogin").val().trim() !== "" && $("#wachtwoordLogin").val().trim() !== "") {
            $("#gebruikersnaamLogin").effect("transfer", { to: $("#submitLogin") }, 550);
            $("#wachtwoordLogin").effect("transfer", { to: $("#submitLogin") }, 550);
            
            setTimeout(function(){
                $.ajax({
                    type: "POST",
                    url: "/sprint3/admin/login",
                    data: {
                        username: $("#gebruikersnaamLogin").val(),
                        password: $("#wachtwoordLogin").val()
                    },
                    cache: false,
                    success: function(result){
                        if (result === "Login"){
                            $("main").css({position: "absolute", right: 0})
                            var width = $("main").width();
                            $("main").animate({right: width}, 500, "easeInOutCubic", function(){
                                setTimeout(function(){
                                    window.location = "/sprint3/admin/userdata";
                                }, 500);
                            });
                        }
                        else {
                            $("#error").fadeIn(300);
                            $("#errorText").text(result);
                            $("#submitLogin").effect("shake");
                            $("#gebruikersnaamLogin").effect("shake");
                            $("#wachtwoordLogin").effect("shake");
                        }
                    }
                });
            }, 500);
        }
        else if ($("#gebruikersnaamLogin").val().trim() !== "" && $("#wachtwoordLogin").val().trim() == "") {
            $("#error").fadeIn(300);
            $("#errorText").text("Geen wachtwoord ingevuld");
            $("#wachtwoordLogin").effect("shake");
        }
        else if ($("#gebruikersnaamLogin").val().trim() == "" && $("#wachtwoordLogin").val().trim() !== "") {
            $("#error").fadeIn(300);
            $("#errorText").text("Geen gebruikersnaam ingevuld");
            $("#gebruikersnaamLogin").effect("shake");
        }
        else if ($("#gebruikersnaamLogin").val().trim() == "" && $("#wachtwoordLogin").val().trim() == "") {
            $("#error").fadeIn(300);
            $("#errorText").text("Geen velden ingevuld");
            $("#gebruikersnaamLogin").effect("shake");
            $("#wachtwoordLogin").effect("shake");
        }
        return false;
    });
    
    $("#submitRegister").on("click", function(){
        $("#error").fadeOut(300);
        
        if ($("#gebruikersnaamRegister").val().trim() !== "" && $("#wachtwoordRegister").val().trim() !== "") {
            $("#gebruikersnaamRegister").effect("transfer", { to: $( "#submitRegister" ) }, 750);
            $("#wachtwoordRegister").effect("transfer", { to: $( "#submitRegister" ) }, 750);
            
            setTimeout(function(){
                $.ajax({
                    type: "POST",
                    url: "/sprint3/admin/register",
                    data: {
                        username: $("#gebruikersnaamRegister").val(),
                        password: $("#wachtwoordRegister").val()
                    },
                    cache: false,
                    success: function(result){
                        if (result === "Register"){
                            $("main").css({position: "absolute", right: 0})
                            var width = $("main").width();
                            $("main").animate({right: width}, 500, "easeInOutCubic", function(){
                                setTimeout(function(){
                                    window.location = "/sprint3/admin/userdata";
                                }, 500);
                            });
                        }
                        else {
                            $("#error").fadeIn(300);
                            $("#errorText").text(result);
                            $("#submitRegister").effect("shake");
                            $("#gebruikersnaamRegister").effect("shake");
                            $("#wachtwoordRegister").effect("shake");
                        }
                    }
                });
            }, 500);
        }
        else if ($("#gebruikersnaamRegister").val().trim() !== "" && $("#wachtwoordRegister").val().trim() == "") {
            $("#error").fadeIn(300);
            $("#errorText").text("Geen wachtwoord ingevuld");
            $("#wachtwoordRegister").effect("shake");
        }
        else if ($("#gebruikersnaamRegister").val().trim() == "" && $("#wachtwoordRegister").val().trim() !== "") {
            $("#error").fadeIn(300);
            $("#errorText").text("Geen gebruikersnaam ingevuld");
            $("#gebruikersnaamRegister").effect("shake");
        }
        else if ($("#gebruikersnaamRegister").val().trim() == "" && $("#wachtwoordRegister").val().trim() == "") {
            $("#error").fadeIn(300);
            $("#errorText").text("Geen velden ingevuld");
            $("#gebruikersnaamRegister").effect("shake");
            $("#wachtwoordRegister").effect("shake");
        }
        return false;
    });
    
    var currentValue = "login";
    
    function switcher() {
        switch(currentValue) {
            default:
            case "login":
                $("#formRegister").hide("slide", { direction: "left" }, 140);
                $("#formLogin").delay(180).show("slide", { direction: "right" }, 140);
                
                setTimeout(function(){
                     $("#gebruikersnaamLogin").focus();
                }, 300);
                break;
            case "register":
                $("#formLogin").hide("slide", { direction: "right" }, 140);
                $("#formRegister").delay(180).show("slide", { direction: "left" }, 140);
                
                setTimeout(function(){
                     $("#gebruikersnaamRegister").focus();
                }, 300);
                break;
        }
    }
    
    $("#switchCheckbox").on("click", function() {
        $("#switchCheckbox").prop("disabled", true);
        
        if ($(this).prop("checked") == true) {
            currentValue = "register";
            switcher();
            $("#error").fadeOut(300).hide();
            
            setTimeout(function(){
                $("#gebruikersnaamLogin").val('');
                $("#wachtwoordLogin").val('');
            }, 300)
        } 
        else {
            currentValue = "login";
            switcher();
            $("#error").fadeOut(300).hide();
            
            setTimeout(function(){
                $("#gebruikersnaamRegister").val('');
                $("#wachtwoordRegister").val('');
            }, 300)
        }
        
        setTimeout(function(){
            $("#switchCheckbox").prop("disabled", false);
        }, 500);
    });
    
    $("#error").hide();
    switcher();
    
    setTimeout(function(){
        $("#gebruikersnaamRegister").val('');
        $("#wachtwoordRegister").val('');
    }, 300);
});