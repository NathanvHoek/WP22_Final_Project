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


function submitPlayerForm(){
    $("#add-player-form").submit(function (event) {

        // Check input
        if (checkUsername()){
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
        }
    });
};

function submitMainImage(){
    $("#choose-main-image").submit(function (event) {
        // Check input
        let formData = {
            main_image: $("#main-image").val()
        };

        $.ajax({
            type: "POST",
            url: "./scripts/choose_image.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
        event.preventDefault();
        setTimeout(function (){$(".judge-main-image").load(window.location.href + " .judge-main-image")}, 100)
        $("#judge-overview").show()
        $("#choose-main-image").hide()

    });
}

function checkUsername() {
    let username = $("#username-input")
    let usernames = []
    fetch("data/player_data.json")
        .then(response => response.json())
        .then(data => {
            for (let player of Object.keys(data)) {
                usernames.push(data[player]["player_name"])
            }
        });
    return !usernames.includes(username);
}

$(function () {
    // checkUsername()
    $("#judge-overview").hide()
    submitMainImage()
    submitPlayerForm()
    $("#avatar-overview").hide()
    showAvatarsIcon()
    chooseAvatar()
    startGame()
    hideForm()
    chooseImage()
})
