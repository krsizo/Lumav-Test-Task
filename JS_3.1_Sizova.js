var box = document.getElementById("box");

var enabled = false;

function addMouseListener (){
    window.addEventListener('mousemove', function(e){
        var left = e.pageX+"px";
        var top =  e.pageY+'px';
        if (enabled === true) {
            box.style.left = left;
            box.style.top = top;
        }
    });
}


box.onclick = function() {
    if (enabled === true){
        box.style.top = 0 + "px";
        box.style.left = 0 + "px";
        enabled = false;
    }else{
        enabled = true;
    }
}


