function resize() {
    var htmlEle = document.documentElement; 
    var htmlWidth = window.innerWidth;
    htmlEle.style.fontSize = 100 * (htmlWidth / 750) + 'px'; 
} resize(); 