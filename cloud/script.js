var menu = document.getElementById("id-menu");
if (document.addEventListener) {
  document.addEventListener('contextmenu', function(e) {
    menu.style.visibility = "visible";
    menu.style.marginLeft = e.clientX + 'px';
    menu.style.marginTop = e.clientY + 'px';
    e.preventDefault();
  }, false);
} else {  document.attachEvent('oncontextmenu', function() {
    menu.style.display = 'block';
    menu.style.marginLeft = e.clientX + 'px';
    menu.style.marginTop = e.clientY + 'px';
    window.event.returnValue = false;
  });
}


window.onload = function () {
    document.addEventListener("click",
        function () {
            document.getElementById("id-menu").style.visibility = "hidden";
        }
    );  
    document.addEventListener("scroll",
    function () {
            console.log("scroll");
            document.getElementById("id-menu").style.visibility = "hidden";
        }
    );
}