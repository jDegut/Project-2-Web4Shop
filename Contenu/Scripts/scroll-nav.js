window.onscroll = function() {navScroll()};
 
function navScroll() {
    var x = document.body.scrollTop || document.documentElement.scrollTop;
    if (x > 10){
      document.getElementById("menu").style.opacity = "0.2";
      document.getElementById("menu").style.transition = "opacity 0.2s";
    } else {
    document.getElementById("menu").style.opacity = "1";
    }   
  
    if((window.innerHeight + window.scrollY) > document.body.scrollHeight - 20) {
      document.getElementById("footer").style.opacity = "1";
      document.getElementById("footer").style.transition = "opacity 0.2s";
    }else {
      document.getElementById("footer").style.opacity = "0";
    }
}