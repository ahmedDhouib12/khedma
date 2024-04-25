$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
 });
 
// Define a function to redirect to login.html
function redirectToLogin() {
    window.location.href = 'login.html';
}
