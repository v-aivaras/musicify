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

$(document).click(function(click) {
    let target = $(click.target);
    if(!target.hasClass("item") && !target.hasClass("optionsButton")) {
        hideOptionsMenu();
    }
});

$(window).scroll(function() {
    hideOptionsMenu();
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

function deletePlaylist(playlistId) {
    let confirmation = confirm("Are you sure you want to delete this playlist?");
    if(confirmation) {
        $.post("includes/handlers/ajax/deletePlaylist.php", {playlistId: playlistId})
        .done(function(error) {
            if(error != "") {
                alert(error);
                return;
            }
            openPage("yourMusic.php");
        });
    }
}

function hideOptionsMenu() {
    let menu = $(".optionsMenu");
    if(menu.css("display") != "none") {
        menu.css("display", "none");
    }
}

function showOptionsMenu(button) {
    let menu = $(".optionsMenu");
    let menuWidth = menu.width();

    let scrollTop = $(window).scrollTop();
    let elementOffset = $(button).offset().top;

    let top = elementOffset - scrollTop;
    let left = $(button).position().left;

    menu.css({"top": top + "px", "left": left - menuWidth + "px", "display": "inline"});
}