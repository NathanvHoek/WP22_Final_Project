/////////////////////////////////////
//////////// INDEX PAGE /////////////
/////////////////////////////////////

function toggleJoinButton(room_exists) {
    if (room_exists){
            $("#pin-join-button").addClass('active');
            $("#pin-join-button").removeClass('inactive');
            $("#pin-join-button").attr("disabled", false);
    }

    else { console.log("Not available")
        $("#pin-join-button").addClass('inactive');
        $("#pin-join-button").removeClass('active');
        $("#pin-join-button").attr("disabled", true);
    }
}

function checkPIN() {
    let PIN = $("#join-code").val();
    let room_exists = false;
    $.getJSON("data/game/player_data.json", function (json) {
       if (json[PIN]) {
           room_exists = true;
       }
       toggleJoinButton(room_exists)
    })

}


/////////////////////////////////////
//////////// LOBBY PAGE /////////////
/////////////////////////////////////

// ---------- AVATARS ----------
function showAvatarsIcon(){
    $("#choose-avatar-btn").click(function () {
        $("#avatar-box").toggle();
    });
}

function chooseAvatar(){
    $("#avatar-overview .small-avatars").click(function () {
        let img_src = $(this).attr('src');
        $("#avatar").attr("src", img_src);
        $("#avatar-input").val(img_src);
    })
}

function closeButton() {
    $("#close-button").click(function () {
        $(this).parent("div").hide();
    })
}

function startGame(){
    let player_count = $("#avatar-overview .small-avatars").children.length
    let start_button = $("#start-game a").click(function () {
        start_button.disabled = player_count < 3;
    });
}

// ---------- ADD PLAYER FORM ----------
function hideForm(){
    $("#welcome-player").hide()
    $("#join-game").click(function (){
        $("#welcome-player").show()
        $("#player-form").hide()
    })
}

// async function checkUsername() {
//     let username = $("#username-input").val()
//     let response = await fetch("data/player_data.json");
//     let players = await response.json();
//
//     for (let i = 0; i < players.length; i++) {
//         let player_name = players[i]["player_name"];
//         if (username === player_name) {
//             $("#username-input").css("border", "3px solid red");
//             return false;
//         }
//         else if (username === ""){
//             $("#username-input").css("border", "1px solid green");
//             return false;
//         }
//         // else {
//         //     $("#username-input").css("border", "1px solid green");
//         //     return true;
//         // }
//     }
// // });
// }

function submitPlayerForm(){
    $("#join-game").click(function (event) {
            let formData = {
                room_PIN: $("#room-pin").val(),
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
            $("#avatar-box").hide();

            setTimeout(function () {
                $(".player-overview").load(window.location.href + " .player-overview")
            }, 100)
    });
};


///////////// JURY PAGE //////////////
function chooseImage(){
    $(".judge-images .choose-picture").click(function () {
        let img_src = $(this).attr('src');
        $("#main-image").val(img_src);
    })
}

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
        setTimeout(function (){$(".judge-main-image").load(window.location.href + " .judge-main-image")}, 10)
        $("#judge-overview").show()
        $("#choose-main-image").hide()

    });
}

function selectImage() {
    $(".card-container .card").click(function () {
        let selected_text = $(this).children("p")[0].innerText;
        $(".card-container .card").css("border", "3px solid black")
        $(this).css("border", "3px solid green");
        document.getElementById("selected-caption").innerText = selected_text;
        $("#selected-caption-input").val(selected_text)
        return true;
    })
}

function submitImage() {
    $("#send-image").click(function (event) {

        let formData = {
            caption: $("#selected-caption-input").val(),
            name: $("#selected-caption-named").val()
        };
        console.log(formData)

        $.ajax({
            type: "POST",
            url: "./scripts/choose_caption.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
        event.preventDefault();
        setTimeout(function (){$("#judge-overview").load(window.location.href + " #judge-overview")}, 100)
        $("#judge-overview").show()
        $(".card-container").hide()
        $("#send-image").hide()

    });
}

//////////// MAIN FUNCTION //////////////
$(function () {
    $("#username-input").keyup(function () {
        checkUsername()
    })

    closeButton()
    // checkUsername()
    $("#judge-overview").hide()
    submitMainImage()

    startGame()
    hideForm()
    chooseImage()
    selectImage()
    submitImage()

    $("#join-code").keyup(function () {
       checkPIN();
    })

    // Lobby functions
    setInterval(function () {
        $(".player-overview").load(window.location.href + " .player-overview")}
    , 2000);

    submitPlayerForm()
    $("#avatar-box").hide()
    showAvatarsIcon()
    chooseAvatar()

    // if ($("#pin-join-button").hasClass('active')){
    //     $("#pin-join-button").click(function () {
    //         let formData = {
    //             room_PIN: $("#join-code").val(),
    //         };
    //
    //         $.ajax({
    //             type: "POST",
    //             url: "create_room.php",
    //             data: formData,
    //             dataType: "json",
    //             encode: true,
    //             success: window.location.href = "create_room.php"
    //         })
    //     })
    // }
})
