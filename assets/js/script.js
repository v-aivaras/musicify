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

$(document).on("change", "select.playlist", function() {
    let select = $(this);
    let playlistId = $(this).val();
    let songId = select.prev(".songId").val();

    $.post("includes/handlers/ajax/addToPlaylist.php", {playlistId: playlistId, songId: songId})
    .done(function(error) {
        if(error != "") {
            alert(error);
            return;
        }
        hideOptionsMenu();
        select.val("");
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

function removeFromPlaylist(button, playlistId) {
    let songId = $(button).prevAll(".songId").val();
    $.post("includes/handlers/ajax/removeFromPlaylist.php", {playlistId: playlistId, songId: songId})
        .done(function(error) {
            if(error != "") {
                alert(error);
                return;
            }
            openPage("playlist.php?id=" + playlistId);
        });
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
    let songId = $(button).prevAll(".songId").val();
    let menu = $(".optionsMenu");
    let menuWidth = menu.width();
    menu.find(".songId").val(songId);

    let scrollTop = $(window).scrollTop();
    let elementOffset = $(button).offset().top;

    let top = elementOffset - scrollTop;
    let left = $(button).position().left;

    menu.css({"top": top + "px", "left": left - menuWidth + "px", "display": "inline"});
}

function updateEmail(emailClass) {
	let emailValue = $("." + emailClass).val();
	$.post("includes/handlers/ajax/updateEmail.php", { email: emailValue, username: userLoggedIn})
	.done(function(response) {
		$("." + emailClass).nextAll(".message").text(response);
	})
}

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
	var oldPassword = $("." + oldPasswordClass).val();
	var newPassword1 = $("." + newPasswordClass1).val();
	var newPassword2 = $("." + newPasswordClass2).val();

	$.post("includes/handlers/ajax/updatePassword.php", 
		{ oldPassword: oldPassword,
			newPassword1: newPassword1,
			newPassword2: newPassword2, 
			username: userLoggedIn})

	.done(function(response) {
		$("." + oldPasswordClass).nextAll(".message").text(response);
	})
}

function logout() {
    $.post("includes/handlers/ajax/logout.php", function() {
        location.reload();
    });
}