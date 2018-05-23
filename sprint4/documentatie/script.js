$(document).ready(function(){
    var click = true;
    
    $(".mainMenu").on("click", function(){
        if (click === true) {
            click = false;
            $(".activeMain").removeClass("activeMain");
            $("#" + this.id).addClass("activeMain");
            activeMain = this.id;
            
            currentContent();
        }
        
        setTimeout(function(){
            click = true;
        }, 1000);
    });
    
    $(".subMenu").on("click", function(){
        if (click === true) {
            click = false;
            $(".activeSub").removeClass("activeSub");
            $("#" + this.id).addClass("activeSub");
            activeSub = this.id;
            
            currentContent();
        }
        
        setTimeout(function(){
            click = true;
        }, 1000);
    });
    
    function currentContent(){
        switch (activeMain) {
            case "mainSprint1":
                $(".activeMainContent").removeClass("activeMainContent").fadeIn(0).fadeOut(500);
                $("#contentSprint1").addClass("activeMainContent").fadeOut(0).delay(500).fadeIn(500);
                
                switch (activeSub) {
                    case "subTab1":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint1_Tab1").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab2":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint1_Tab2").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab3":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint1_Tab3").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab4":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint1_Tab4").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab5":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint1_Tab5").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                }
                break;
            case "mainSprint2":
                $(".activeMainContent").removeClass("activeMainContent").fadeIn(0).fadeOut(500);
                $("#contentSprint2").addClass("activeMainContent").fadeOut(0).delay(500).fadeIn(500);
                
                switch (activeSub) {
                    case "subTab1":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint2_Tab1").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab2":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint2_Tab2").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab3":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint2_Tab3").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab4":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint2_Tab4").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab5":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint2_Tab5").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                }
                break;
            case "mainSprint3":
                $(".activeMainContent").removeClass("activeMainContent").fadeIn(0).fadeOut(500);
                $("#contentSprint3").addClass("activeMainContent").fadeOut(0).delay(500).fadeIn(500);
                
                switch (activeSub) {
                    case "subTab1":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint3_Tab1").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab2":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint3_Tab2").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab3":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint3_Tab3").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab4":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint3_Tab4").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab5":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint3_Tab5").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                }
                break;
            case "mainSprint4":
                $(".activeMainContent").removeClass("activeMainContent").fadeIn(0).fadeOut(500);
                $("#contentSprint4").addClass("activeMainContent").fadeOut(0).delay(500).fadeIn(500);
                
                switch (activeSub) {
                    case "subTab1":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint4_Tab1").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab2":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint4_Tab2").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab3":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint4_Tab3").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab4":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint4_Tab4").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab5":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint4_Tab5").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                }
                break;
            case "mainSprint5":
                $(".activeMainContent").removeClass("activeMainContent").fadeIn(0).fadeOut(500);
                $("#contentSprint5").addClass("activeMainContent").fadeOut(0).delay(500).fadeIn(500);
                
                switch (activeSub) {
                    case "subTab1":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint5_Tab1").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab2":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint5_Tab2").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab3":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint5_Tab3").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab4":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint5_Tab4").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                    case "subTab5":
                        $(".activeSubContent").removeClass("activeSubContent").fadeIn(0).fadeOut(500);
                        $("#contentSprint5_Tab5").addClass("activeSubContent").fadeOut(0).delay(500).fadeIn(500);
                        break;
                }
                break;
        }
    }
});