
var limg = 890;
var rimg = 0;
var intervalID;

var prev = function(){
    var l = document.getElementById('d_content_top_lcenter');
    var r = document.getElementById('d_content_top_rcenter');
    limg -= 100;
    rimg += 100;
    if(limg <= 0){
        window.clearInterval(intervalID);
        l.style.width = 0 + "px";
        r.style.width = 890 + "px";
        return;
    }
    l.style.width = limg + "px";
    r.style.width = rimg + "px";
    
}

var next = function(){
    var l = document.getElementById('d_content_top_lcenter');
    var r = document.getElementById('d_content_top_rcenter');
    limg += 100;
    rimg -= 100;
    if(limg >= 890){
        window.clearInterval(intervalID);
        l.style.width = 890 + "px";
        r.style.width = 0 + "px";
        return;
    }
    l.style.width = limg + "px";
    r.style.width = rimg + "px";
}

function start(p){
    if(p == 'p')
        intervalID = window.setInterval(prev,1);
    else
        intervalID = window.setInterval(next,1);
}



