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

function openPage(url) {
    if(timer != null) {
        clearTimeout(timer);
    }

    if(url.indexOf("?") == -1) {
        url = url + "?";
    }
    let encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
}

function createPlaylist() {
    let playlistName = prompt("Please enter the name of your playlist");

    if(alert != null) {
        $.post("includes/handlers/ajax/createPlaylist.php", {name: playlistName, username: userLoggedIn})
        .done(function(error) {
            if(error != "") {
                alert(error);
                return;
            }
            openPage("yourMusic.php");
        });
    }
}