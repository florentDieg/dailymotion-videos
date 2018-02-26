jQuery(function($){
    var nofiPlayer = $("#nofiPlayer");
    var nofiPayerPausePlayBt = $("#nofiPlayBt");
    var btContent = $("#btContent");
    
    btContent.hover(function(){
        if (!document.getElementById("nofiPlayer").paused || !document.getElementById("nofiPlayer").ended) {
            showPauseBt();
        }
    });
    
    btContent.mouseleave(function(){
        if (document.getElementById("nofiPlayer").paused || document.getElementById("nofiPlayer").ended) {
            showPlayBt();
        }
        else{
            hidePauseBt();
        }
    
    });
    
    btContent.click(function(){
        if (document.getElementById("nofiPlayer").paused || document.getElementById("nofiPlayer").ended) {
            document.getElementById("nofiPlayer").play();
            hidePlayBt();
        }
        else{
            document.getElementById("nofiPlayer").pause();
            showPlayBt();
            
        }
    });
    
    /*btContent.change(function(){
        if(document.getElementById("nofiPlayer").ended){
            showPlayBt();   
        }
    });*/
    
    function showPauseBt(){
        $("#nofiPlayBt").removeClass("hiddenBt");
    }
    
    function hidePauseBt(){
        $("#nofiPlayBt").addClass("hiddenBt");
    }
    
    function showPlayBt(){
        $("#nofiPlayBt").removeClass("fa fa-pause-circle-o fa-5x hiddenBt").addClass("fa fa-play-circle-o fa-5x");
    }
    
    function hidePlayBt(){
        $("#nofiPlayBt").removeClass("fa fa-play-circle-o fa-5x").addClass("fa fa-pause-circle-o fa-5x hiddenBt");   
    }
    
    });
    
    function changePlayerSrc(source){
        document.getElementById("playerSource").setAttribute('src',source);
        document.getElementById("nofiPlayer").load();
        document.getElementById("nofiPlayer").play();
        jQuery("#nofiPlayBt").removeClass("fa fa-play-circle-o fa-5x").addClass("fa fa-pause-circle-o fa-5x hiddenBt");
    }