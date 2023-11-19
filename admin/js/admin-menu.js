let sidebar= document.getElementById("sidebar");
let overlay= document.getElementById("overlay-div");
let mainDiv= document.getElementById("main-div");

function showSidebar() { 
    sidebar.classList.remove("display-none");
    overlay.classList.add("opacity-overlay");

}

function hideSidebar() {
    overlay.classList.remove("opacity-overlay");
    sidebar.classList.add("display-none");
}

function windowSizeChecker() {
    if(window.innerWidth <= 1182 && window.innerWidth > 0) {
        mainDiv.classList.add("col-md-12");
        sidebar.classList.add("sidebar-collapse");
        sidebar.classList.add("display-none");
        overlay.classList.remove("opacity-overlay");
    }
    if(window.innerWidth > 1182) {
        mainDiv.classList.remove("col-md-12");
        sidebar.classList.remove("sidebar-collapse");
        sidebar.classList.remove("display-none");
        overlay.classList.remove("opacity-overlay");
    }
}

window.onload= windowSizeChecker;
window.onresize= windowSizeChecker;