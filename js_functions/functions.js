/**
 * Created by Khuja on 3/15/2017.
 */

$(document).ready(function(){
    // Add smooth scrolling to all links
    $(".navigation-bar").on('click', function(event){

        //Prevent default anchon click behavior
        event.preventDefault();

        //Store hash
        var hash = this.hash;

        //Using jQuery's animate() method to add smooth page scroll
        //The optional number (800) speicifies the number of miliseconds it takes to scroll to the specified area
        $('html, body').animate({
            scrollTop: $(hash).offset().top}, 1200, function(){
            //Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
        });
    });
});

function addBluring (idName) {
    $(document).ready(function(){
        $(idName).addClass("bluring");
    });
}

function removeBluring (idName) {
    $(document).ready(function(){
        $(idName).removeClass("bluring");
    });
}


$(window).scroll(function(event) {
    var scroll = $(window).scrollTop();
    if (scroll > 200) {
        addBluring("#jumbotron");
    }
    if (scroll <= 200) {
        removeBluring("#jumbotron");
    };
});