<style>
    @import url('https://fonts.googleapis.com/css?family=Source+Code+Pro:500');
    
    #splash {
        width: 100%;
        height: 100vh;
        z-index: 1;
    }
    
    #splash_name {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        grid-area: name;
    }
    
    #splash_zelfportretClick {
        display: flex;
        justify-content: center;
        align-items: center;
        grid-area: zelfportret;
    }
    
    #ScrollDown {
        position: relative;
        color: #DEDEDE;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none; 
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        grid-area: scrolldown;
    }
    
    #ScrollDown span {
        position: absolute;
        width: 30px;
        height: 50px;
        border: 2px solid #DEDEDE;
        border-radius: 50px;
        box-sizing: border-box;
    }
    
    #ScrollDown span::before {
        position: absolute;
        top: 10px;
        left: 50%;
        content: '';
        width: 4px;
        height: 12.5px;
        margin-left: -2px;
        background-color: #DEDEDE;
        border-radius: 20px;
        -webkit-animation: scrollbar 5s infinite;
        animation: scrollbar 5s infinite;
        box-sizing: border-box;
    }
    
    @-webkit-keyframes scrollbar {
        0% {
            -webkit-transform: translate(0, 0);
        }
        50% {
            -webkit-transform: translate(0, 15px);
        }
        100% {
            -webkit-transform: translate(0, 0);
        }
    }
    @keyframes scrollbar {
        0% {
            transform: translate(0, 0);
        }
        50% {
            transform: translate(0, 15px);
        }
        100% {
            transform: translate(0, 0);
        }
    }
    
    #splash_grid {
        z-index: 10;
        width: 100%;
        height: 100%;
        background: transparent;
        display: grid;
        grid-template-columns: auto;
        grid-template-rows: 30% 40% 20% 10%;
        grid-template-areas:
            "."
            "name"
            "zelfportret"
            "scrolldown";
        cursor: pointer;
        position: absolute;
        top: 0;
    }
    
    h1.text {
        color: #DEDEDE;
        font-size: 50px;
        text-transform: capitalize;
    }
    
    h2.text {
        color: #DEDEDE;
        font-size: 20px;
    }
    
    h3.text {
        color: #DEDEDE;
        font-size: 14px;
        text-decoration: underline;
        text-decoration-color: #DEDEDE;
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
        right: 0.5vh;
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
        right: calc(1vh + 4vw);
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
</style>
<script>
    function activeLine(){
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
        <textarea id="code_canvas" onkeyup="activeLine();" onmouseup="this.onkeyup();"><?php include_once($_SERVER['DOCUMENT_ROOT'] . '/sprint4/includes/zelfportret.txt'); ?></textarea>
    </div>
    <div id="splash_grid">
        <div id="splash_name">
            <h1 class="text">Max Altena</h1>
            <h2 class="text">ICT &amp; Media Design student</h2>
        </div>
        <div id="splash_zelfportretClick">
            <h3 class="text">Klik om zelfportret te starten</h3>
        </div>
        <div id="ScrollDown"><span></span></div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#splash_grid").on({
            mouseenter: function(){
                $("#splash_zelfportretClick .text").css({transition: "0.5s", transform: "scale(1.25,1.25)", "text-decoration": "line-through"});
            },
            mouseleave: function(){
                $("#splash_zelfportretClick .text").css({transition: "0.5s", transform: "scale(1,1)", "text-decoration": "underline"});
            },
            click: function(){
                open();
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
        
        function open(){
            $("body").animate({scrollTop: 0}, 500).css({"overflow-y": "hidden"});
            $("#code_canvas").css({"overflow-y": "auto"});
            
            var clientW = $("body").clientWidth;
            $("#splash_canvas").css({position: "absolute", left: "0", top: "0", width: clientW});
            
            $("#splash_grid").fadeOut();
            $("#exit, #reset").fadeIn();
        }
        
        function exit(){
            $("#code_canvas").animate({scrollTop: 0}, 500).css({"overflow-y": "hidden"});
            $("body").css({"overflow-y": "auto"});
            
            var clientW = $("body").clientWidth;
            $("#splash_canvas").css({position: "absolute", left: "100", top: "0", width: clientW - 100});
            
            $("#exit, #reset").fadeOut();
            $("#splash_grid").fadeIn();
            
            $("#gutter_canvas").children("div").each(function(){
                $(this).css({background: "#202020"});
            });
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