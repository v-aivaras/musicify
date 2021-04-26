$(document).ready(function() {

    // Show hide login/register form
    $("#hideLogin").click(function() {
        $("#loginForm").hide();
        $("#registerForm").show();
    });

    $("#hideRegister").click(function() {
        $("#registerForm").hide();
        $("#loginForm").show();
    });

});