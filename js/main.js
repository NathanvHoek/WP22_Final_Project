/////////////////////////////////////
//////////// INDEX PAGE /////////////
/////////////////////////////////////

function toggleJoinButton(room_exists) {
    let join_button = $("#pin-join-button")
    if (room_exists){
            join_button.addClass('active');
            join_button.removeClass('inactive');
            join_button.attr("disabled", false);
    }

    else {
        join_button.addClass('inactive');
        join_button.removeClass('active');
        join_button.attr("disabled", true);
    }
}

function checkPIN() {
    let PIN = $("#join-code").val();
    let room_exists = false;
    $.getJSON("data/game/game_data.json", function (json) {
       if (json[PIN]) {
           room_exists = true;
       }
       toggleJoinButton(room_exists)
    })

}


/////////////////////////////////////
//////////// LOBBY PAGE /////////////
/////////////////////////////////////

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
    $("#start-game").click(function () {
        console.log("Start game")
    })
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

//////////////////////////////////////
///////////// JURY PAGE //////////////
//////////////////////////////////////
function chooseImage(){
    $(".judge-images .choose-picture").click(function () {
        let img_src = $(this).attr('src');
        $("#main-image").val(img_src);
    })
}

function submitMainImage(){
    $("#choose-main-image").submit(function (event) {
        let formData = {
            main_image: $("#main-image").val(),
            game_PIN: $("#game_PIN").val()
        };
        console.log(formData)

        $.ajax({
            type: "POST",
            url: "./scripts/choose_image.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
        event.preventDefault();
        console.log(formData)
        setTimeout(function (){$(".judge-main-image").load(window.location.href + " .judge-main-image")}, 10)
        $("#judge-overview").show()
        $("#choose-main-image").hide()

    });
}

// SELECT THE WINNER OF THE GAME
function selectWinner() {
    $("#judge-choose-winner .card").click(function () {
        console.log("Yayyy");
        // let selected_text = $(this).children("p")[0].innerText;
        //
        // $("#card-container-overview .card").css("border", "3px solid black")
        // $(this).css("border", "3px solid green");
        // document.getElementById("selected-caption").innerText = selected_text;
        // $("#selected-caption-input").val(selected_text)
        // return true;
    })
}


//////////////////////////////////////
//////////// PLAYER PAGE /////////////
//////////////////////////////////////
function selectImage() {
    $("#card-container-overview .card").click(function () {
        console.log("Yayyy");
        let selected_text = $(this).children("p")[0].innerText;

        $("#card-container-overview .card").css("border", "3px solid black")
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
            name: $("#selected-caption-named").val(),
            code: $("#selected-caption-code").val()
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
        setTimeout(function (){$(".judge-main-image").load(window.location.href + " .judge-main-image")}, 100)
        $("#selected-captions-overview").show()
        $("#card-container-overview").hide()
        $("#send-image").hide()

    });
}

//////////// MAIN FUNCTION //////////////
$(function () {
    $("#username-input").keyup(function () {
        checkUsername()
    });

    closeButton()
    // checkUsername()
    $("#judge-overview").hide()
    submitMainImage()


    hideForm()
    chooseImage()



    $("#join-code").keyup(function () {
       checkPIN();
    })

    // Lobby functions
    if (window.location.href.endsWith("lobby.php")){
        setInterval(function () {
                $(".player-overview").load(window.location.href + " .player-overview")}
            , 2000);

        setInterval(function () {
                $.getJSON("data/game/game_data.json", function (json) {
                    let PIN = $("#join-code").val();
                    if (json[PIN]["status"] === "active") {
                        $("#start-game-form").submit();
                    }
                })}
            , 500);
    }

    submitPlayerForm()
    $("#avatar-box").hide()
    showAvatarsIcon()
    chooseAvatar()
    startGame()
    setInterval(function () {
            $("#chosen-image").load(window.location.href + " #chosen-image")}
        , 2000);
    setInterval(function () {
            $("#selected-captions-overview").load(window.location.href + " #selected-captions-overview")}
        , 2000);


    // Player functions
    selectImage()
    submitImage()
    selectWinner()

})
