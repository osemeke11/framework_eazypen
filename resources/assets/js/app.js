/**
 * Created by eazypen on 1/11/2018.
 */
var App = {

    menuToggleFunction: function(e) {
        e.preventDefault();
        var menuSM = document.querySelector("#mobile-nav");
        if(menuSM.style.display == "block"){menuSM.style.display = "none";}
        else {menuSM.style.display = "block";}
        if(this.classList.contains("fa-navicon")){
            this.classList.remove("fa-navicon");
            this.classList.add("fa-close");
        }else {
            this.classList.add("fa-navicon");
            this.classList.remove("fa-close");
        }
    },

    // Sticky Navigation
    stickyNav: function () {
        var header = document.getElementById("header");
        var scrollTop = window.scrollY;
        if (scrollTop > "300") {
            header.style.position = "fixed";
            header.style.backgroundColor = "#424242";
        }
        else {
            header.style.position = "absolute";
            header.style.backgroundColor = "transparent";
        }
    },

    // Show Go to Top function
    showGoToTop: function () {
        var scrollTop = window.scrollY;
        var gototop = document.getElementById("gototop");
        if (scrollTop > '300') {
            gototop.style.bottom = "5%";
        }
        else {
            gototop.style.bottom = "-60px";
        }
    },
    // Url Function
    gotourl: function(url){
        return window.location.protocol + "//" + window.location.host + url;
    }
};