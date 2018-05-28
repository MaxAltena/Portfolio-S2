<style>
    @import url('https://fonts.googleapis.com/css?family=Source+Code+Pro:500');
    
    #splash {
        width: 100%;
        height: 100vh;
        z-index: 1;
    }
    
    #splash_grid {
        z-index: 10;
        width: 100%;
        height: 100%;
        background: transparent;
        cursor: pointer;
        position: absolute;
        top: 0;
    }
    
    #splash_canvas {
        position: absolute;
        top: 0;
        left: 100px;
        z-index: 5;
        width: 100%;
        height: 100%;
        overflow-y: hidden;
        display: flex;
        justify-content: space-between;
        background: #202020;
        transition: 0.5s;
    }
    
    #splash_canvas * {
        font-family: 'Source Code Pro', monospace;
        font-size: 12px;
        color: #DEDEDE;
    }
    
    #exit {
        position: absolute;
        top: 0.5vh;
        right: calc(0.5vh + 1vw);
        cursor: pointer;
        padding: 1vw;
        display: none;
        z-index: 15;
    }
    
    #exit_icon {
        width: 2vw;
        height: auto;
    }
    
    #reset {
        position: absolute;
        top: 0.5vh;
        right: calc(0.5vh + 5vw);
        cursor: pointer;
        padding: 1vw;
        display: none;
        z-index: 15;
    }
    
    #reset_icon {
        width: 2vw;
        height: auto;
    }
    
    #gutter_canvas {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 13;
    }
    
    #gutter_canvas div {
        width: 100%;
        background: #202020;
    }
    
    #gutter_canvas div div {
        width: 3%;
        height: 25px;
        font-size: 20px;
        line-height: 25px;
        display: flex;
        justify-content: flex-end;
        background: none;
    }
    
    #code_canvas {
        z-index: 14;
        color: #6C9EF8;
        background: none;
        outline: none;
        resize: none;
        width: 100%;
        padding-left: 4%;
        border: none;
        line-height: 25px;
        font-size: 20px;
        overflow-y: hidden;
    }
    
    #code_canvas::-webkit-scrollbar {
        position: absolute;
        top: 0;
        right: 0;
        width: 10px;
    }
    
    #code_canvas::-webkit-scrollbar-track {
        background: #202020; 
    }
    
    #code_canvas::-webkit-scrollbar-thumb {
        background: #FECD18; 
    }
    
    #code_canvas::-webkit-scrollbar-corner {
        background: #202020;
    }
    
    .tag {
        color: #6C9EF8;
    }
    
    #nameSplash {
        color: #DEDEDE;
        font-family: 'Hind', sans-serif;
        font-weight: 700;
        font-size: 125px;
        text-transform: capitalize;
        transform: rotate(90deg);
        position: absolute;
        right: -150;
        top: 250;
    }
    
    #downSplash {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #DEDEDE;
        font-size: 65px;
        position: absolute;
        right: 130;
        bottom: 15;
        border-radius: 50%;
        width: 75px;
        height: 75px;
        cursor: s-resize;
    }
    
    #zelfportretSplash {
        width: 200px;
        color: #DEDEDE;
        font-size: 14px;
        text-decoration: underline;
        text-decoration-color: #DEDEDE;
        position: absolute;
        top: 5;
        left: calc(50vw - 150px);
        text-align: center;
        font-family: 'Hind', sans-serif;
        font-weight: 700;
    }
</style>
<script>
    function activeLine(event){
        if(event.which == 27){
            $("#gutter_canvas").children("div").each(function(){
                $(this).css({background: "#202020"});
            });
        }
        else {
            var lineNumber = $("#code_canvas")[0].value.substr(0, $("#code_canvas")[0].selectionStart).split("\n").length;
            var classToFind = "gutter" + lineNumber;
            
            $("#gutter_canvas").children("div").each(function(){
                if(this.className == classToFind){
                    $(this).css({background: "#303030"});
                }
                else {
                    $(this).css({background: "#202020"});
                }
            });
        }
    }
</script>

<div id="splash">
    <div id="splash_canvas">
        <div id="exit">
            <svg id="exit_icon" viewBox="0 0 220.176 220.176"><path d="M131.577,110.084l84.176-84.146c5.897-5.928,5.897-15.565,0-21.492c-5.928-5.928-15.595-5.928-21.492,0l-84.176,84.146L25.938,4.446c-5.928-5.928-15.565-5.928-21.492,0s-5.928,15.565,0,21.492l84.146,84.146L4.446,194.26c-5.928,5.897-5.928,15.565,0,21.492c5.928,5.897,15.565,5.897,21.492,0l84.146-84.176l84.176,84.176c5.897,5.897,15.565,5.897,21.492,0c5.897-5.928,5.897-15.595,0-21.492L131.577,110.084z" fill="#DEDEDE"/></svg>
        </div>
        <div id="reset">
            <svg id="reset_icon" viewBox="0 0 438.529 438.528"><path d="M433.109,23.694c-3.614-3.612-7.898-5.424-12.848-5.424c-4.948,0-9.226,1.812-12.847,5.424l-37.113,36.835c-20.365-19.226-43.684-34.123-69.948-44.684C274.091,5.283,247.056,0.003,219.266,0.003c-52.344,0-98.022,15.843-137.042,47.536C43.203,79.228,17.509,120.574,5.137,171.587v1.997c0,2.474,0.903,4.617,2.712,6.423c1.809,1.809,3.949,2.712,6.423,2.712h56.814c4.189,0,7.042-2.19,8.566-6.565c7.993-19.032,13.035-30.166,15.131-33.403c13.322-21.698,31.023-38.734,53.103-51.106c22.082-12.371,45.873-18.559,71.376-18.559c38.261,0,71.473,13.039,99.645,39.115l-39.406,39.397c-3.607,3.617-5.421,7.902-5.421,12.851c0,4.948,1.813,9.231,5.421,12.847c3.621,3.617,7.905,5.424,12.854,5.424h127.906c4.949,0,9.233-1.807,12.848-5.424c3.613-3.616,5.42-7.898,5.42-12.847V36.542C438.529,31.593,436.733,27.312,433.109,23.694z" fill="#DEDEDE"/><path d="M422.253,255.813h-54.816c-4.188,0-7.043,2.187-8.562,6.566c-7.99,19.034-13.038,30.163-15.129,33.4c-13.326,21.693-31.028,38.735-53.102,51.106c-22.083,12.375-45.874,18.556-71.378,18.556c-18.461,0-36.259-3.423-53.387-10.273c-17.13-6.858-32.454-16.567-45.966-29.13l39.115-39.112c3.615-3.613,5.424-7.901,5.424-12.847c0-4.948-1.809-9.236-5.424-12.847c-3.617-3.62-7.898-5.431-12.847-5.431H18.274c-4.952,0-9.235,1.811-12.851,5.431C1.807,264.844,0,269.132,0,274.08v127.907c0,4.945,1.807,9.232,5.424,12.847c3.619,3.61,7.902,5.428,12.851,5.428c4.948,0,9.229-1.817,12.847-5.428l36.829-36.833c20.367,19.41,43.542,34.355,69.523,44.823c25.981,10.472,52.866,15.701,80.653,15.701c52.155,0,97.643-15.845,136.471-47.534c38.828-31.688,64.333-73.042,76.52-124.05c0.191-0.38,0.281-1.047,0.281-1.995c0-2.478-0.907-4.612-2.715-6.427C426.874,256.72,424.731,255.813,422.253,255.813z" fill="#DEDEDE"/></svg>
        </div>
        <div id="gutter_canvas"></div>
        <textarea id="code_canvas" onkeyup="activeLine(event);" onmouseup="this.onkeyup(event);"><?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/zelfportret.txt'); ?></textarea>
    </div>
    <div id="splash_grid">
        <div id="nameSplash">Max Altena</div>
        <div id="downSplash">&darr;</div>
        <div id="zelfportretSplash">Klik om zelfportret te starten</div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var i = false;
        $("#downSplash").on("click", function(){
            i = true;
            $("body").animate({scrollTop: $("body")[0].clientHeight}, 500);
        });
        
        $("#splash_grid").on({
            mouseenter: function(){
                $("#zelfportretSplash").css({transition: "0.5s", transform: "scale(1.1,1.1)", "text-decoration": "underline"});
            },
            mouseleave: function(){
                $("#zelfportretSplash").css({transition: "0.5s", transform: "scale(1,1)", "text-decoration": "none"});
            },
            click: function(){
                
                if(i == false){
                    open();
                }
                
                i = false;
            }
        });
        
        $("#exit").on("click", function(){
            exit();
        });
        
        $("#reset").on("click", function(){
            reset();
        });
        
        $("#code_canvas").on("input", function() {
            lineCount();
            typed();
        });
        
        $("#code_canvas").scroll(function(){
            var winScroll = $("#code_canvas").scrollTop();
            $("#gutter_canvas").scrollTop(winScroll);
        });
        
        $("#code_canvas").on("keydown", function(e){
            if(e.which == 27){
                exit();
                return false;
            }
            if(e.which == 9){
                insertTextAtCursor($("#code_canvas")[0], '    ');
                return false;
            }
        });
        
        function insertTextAtCursor(el, text) {
            var val = el.value, endIndex, range, doc = el.ownerDocument;
            if (typeof el.selectionStart == "number"
                    && typeof el.selectionEnd == "number") {
                endIndex = el.selectionEnd;
                el.value = val.slice(0, endIndex) + text + val.slice(endIndex);
                el.selectionStart = el.selectionEnd = endIndex + text.length;
            } else if (doc.selection != "undefined" && doc.selection.createRange) {
                el.focus();
                range = doc.selection.createRange();
                range.collapse(false);
                range.text = text;
                range.select();
            }
        }
        
        function open(){
            if($("body").scrollTop() == 0){
                $("body").css({"overflow-y": "hidden"});
                
            
                var clientW = $("body").clientWidth;
                $("#splash_canvas").css({position: "absolute", left: "0", top: "0", width: clientW});
                
                $("#splash_grid").fadeOut();
                $("#exit, #reset").fadeIn();
                
                setTimeout(function(){
                    $("#code_canvas").css({"overflow-y": "auto"});
                    $("#code_canvas").focus();
                }, 500);
            }
            else {
                $("body").animate({scrollTop: 0}, 500);
            
                setTimeout(function(){
                    $("body").css({"overflow-y": "hidden"});
                    
                    var clientW = $("body").clientWidth;
                    $("#splash_canvas").css({position: "absolute", left: "0", top: "0", width: clientW});
                    
                    $("#splash_grid").fadeOut();
                    $("#exit, #reset").fadeIn();
                    
                    setTimeout(function(){
                        $("#code_canvas").css({"overflow-y": "auto"});
                        $("#code_canvas").focus();
                    }, 500);
                }, 500);
            }
        }
        
        function exit(){
            if($("#code_canvas").scrollTop() == 0){
                $("#code_canvas").css({"overflow-y": "hidden"});
                
                var clientW = $("body").clientWidth;
                $("#splash_canvas").css({position: "absolute", left: "100", top: "0", width: clientW - 100});
                
                $("#exit, #reset").fadeOut();
                $("#splash_grid").fadeIn();
                
                $("#gutter_canvas").children("div").each(function(){
                    $(this).css({background: "#202020"});
                });
                
                setTimeout(function(){
                    $("body").css({"overflow-y": "auto"});
                }, 500);
            }
            else {
                $("#code_canvas").animate({scrollTop: 0}, 500);
                
                setTimeout(function(){
                    $("#code_canvas").css({"overflow-y": "hidden"});
                    
                    var clientW = $("body").clientWidth;
                    $("#splash_canvas").css({position: "absolute", left: "100", top: "0", width: clientW - 100});
                    
                    $("#exit, #reset").fadeOut();
                    $("#splash_grid").fadeIn();
                    
                    $("#gutter_canvas").children("div").each(function(){
                        $(this).css({background: "#202020"});
                    });
                    
                    setTimeout(function(){
                        $("body").css({"overflow-y": "auto"});
                    }, 500);
                }, 500);
            }
        }
        
        function reset(){
            fetch("/includes/zelfportret.txt").then(response=>response.text()).then(text=>$("#code_canvas").val(text));
            
            setTimeout(lineCount, 250);
        }
        
        function lineCount(){
            $("#gutter_canvas").empty();
            
            var text = $("#code_canvas").val();
            var lines = text.split(/\r*\n/);
            var lineCount = lines.length;
            for (var i = 0; i < lineCount; i++) {
                $("#gutter_canvas").append("<div class='gutter" + (i+1) + "'><div>" + (i+1) + "</div></div>");
            }
        }
        
        function typed(){
            // Do some styling to elements <3
        }
        
        lineCount();
        typed();
    });
</script>