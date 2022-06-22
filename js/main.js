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

function validatePlayer() {
    let username = $("#username").val()
    let avatar = $("")
}


function submitPlayerForm(){
    $("#add-player-form").submit(function (event) {

        let formData = {
            username: $("#username-input").val(),
            avatar: $("#avatar-input").val()
        };

        $.ajax({
            type: "POST",
            url: "./scripts/add_player.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
        event.preventDefault();
        setTimeout(function (){$(".player-overview").load(window.location.href + " .player-overview")}, 100)
    });
};

function checkUsername() {

}

$(function () {
    submitPlayerForm()
    $("#avatar-overview").hide()
    showAvatarsIcon()
    chooseAvatar()
    startGame()
    hideForm()
    chooseImage()
})
