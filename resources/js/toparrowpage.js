// Get the button
let mybutton = document.getElementById("topArrow");
        
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
        
function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        mybutton.style.display="inline";
        setTimeout(function(){ //using setTimeout function
            mybutton.style.display ='none'; //dissappearing the button again after 3000ms or 3 seconds
            }
            ,1500);
        }
    else {
        mybutton.style.display = "none";
    }
}