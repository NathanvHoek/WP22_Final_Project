function showAvatarsIcon(){
    $("#choose-avatar-btn").click(function () {
        $("#avatar-overview").toggle();
    });
}

function chooseAvatar(){
    $("#avatar-overview .small-avatars").click(function () {
        let img_src = $(this).attr('src');
        $("#avatar").attr("src", img_src);
        $("#avatar-input").val(img_src);
    })
}

function chooseImage(){
    $(".judge-images .choose-picture").click(function () {
        console.log("Hello");
        let img_src = $(this).attr('src');
        $("#main-image").val(img_src);
    })
}

function startGame(){
    let player_count = $("#avatar-overview .small-avatars").children.length
    let start_button = $("#start-game a").click(function () {
        start_button.disabled = player_count < 3;
    });
}

function hideForm(){
    $("#welcome-player").hide()
    $("#join-game").click(function (){
        $("#welcome-player").show()
        $("#player-form").hide()
    })
}

// function validateUsername() {
//     let username = $("username").val()
//     let all_players = $.getJSON('data/player_data.json')
// }

$(function () {
    $("#avatar-overview").hide()
    showAvatarsIcon()
    chooseAvatar()
    startGame()
    hideForm()
    chooseImage()
})
