//////////////////////////////////////////////////////////////////
/////////////////////////// INDEX PAGE ///////////////////////////
//////////////////////////////////////////////////////////////////

function toggleJoinButton(room_exists, PIN) {
    let join_button = $("#pin-join-button")
    console.log(PIN)
    if (room_exists){
            join_button.attr("disabled", false);
    }
    else {
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
       console.log(typeof PIN)
       toggleJoinButton(room_exists, PIN)
    })

}


//////////////////////////////////////////////////////////////////
/////////////////////////// LOBBY PAGE ///////////////////////////
//////////////////////////////////////////////////////////////////

// Selecting avatar
function showAvatarsIcon(){
    $("#choose-avatar-btn").click(function () {
        $("#avatar-box").show();
    });
}

function chooseAvatar(){
    $("#avatar-overview .small-avatars").click(function () {
        $("#avatar-overview .small-avatars").css("border", "5px solid white");
        $(this).css("border", "5px solid green");
        $("#submit-avatar").data("image", $(this).attr('src'))
    })
}

function closeButtonAvatar() {
    $("#close-button").click(function () {
        $("#avatar-overview .small-avatars").css("border", "5px solid white");
        $("#avatar-box").hide();
    })
}

function selectButtonAvatar() {
    $("#submit-avatar").click(function () {
        let img_src = $(this).data("image");
        $("#avatar").attr("src", img_src);
        $("#avatar-input").val(img_src);
        $("#avatar-box").hide();
    })
}

function startGameButton(){
    $("#start-game").click(function () {
        $.getJSON("./data/game/game_data.json", function (json) {

        })
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
}

//////////////////////////////////////////////////////////////////
/////////////////////////// JURY PAGE ////////////////////////////
//////////////////////////////////////////////////////////////////

function chooseImage(){
    $(".judge-images .choose-picture").click(function () {
        let img_src = $(this).attr('src');
        $(".judge-images .choose-picture").removeClass("active");
        $(this).addClass("active");
        $("#main-image").val(img_src);
    })
}

function showChoice(){
    $("#choose-buttons").hide();
    $("#choose-image").click(function () {
        if ($("#main-image").val() !== "")
            $("#choose-buttons").show();
        })
}

function submitMainImage(){
    // $("#selected-captions-overview").hide()
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
        $("#chosen-image").show()
        $("#selected-captions-overview").show()
        $("#choose-main-image").hide()

    });
}

function flipCard() {
    $('.flip-card').click(function () {
        $(this).addClass("is-flipped")
        let player = $(this).children(".card__face--back").children("p")[1].innerText;
        let formData = {
            card_player: player,
            game_PIN: $("#game_pin").val()
        };
        console.log(formData)
        $.ajax({
            type: "POST",
            url: "./scripts/sync_card_status.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
        event.preventDefault();
    });
}

function selectWinner() {
    // $("#choose-winner").hide()
    $("#all-captions-final .card__face--back").click(function () {
        let selected_text = $(this).children("p")[0].innerText;
        let winner = $(this).children("p")[1].innerText;
        $("#all-captions-final .card__face--back").css("border", "3px solid black")
        $(this).css("border", "3px solid green");
        $("#winner-caption").val(selected_text);
        $("#winner-name").val(winner);
        $("#choose-winner").show()

    })
}

function submitWinner() {
    $("#show-winner").hide()
    $("#next-round").hide()
    $("#winner-caption-btn").click(function (event) {
        let formData = {
            caption: $("#winner-caption").val(),
            room_PIN: $("#game_pin").val(),
            name: $("#winner-name").val()
        };
        console.log(formData)
        $.ajax({
            type: "POST",
            url: "./scripts/choose_winner.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
        event.preventDefault();
        $("#show-winner").load(window.location.href + " #show-winner").show()
        // $("#show-winner").show()
    })
}

//////////////////////////////////////////////////////////////////
////////////////////////// PLAYER PAGE ///////////////////////////
//////////////////////////////////////////////////////////////////
function selectImage() {

    $(".card-container-overview .card").click(function () {
        let selected_text = $(this).children("p")[0].innerText;
        $(".card-container-overview .card").css("border", "3px solid purple")
        $(this).css("border", "3px solid green");
        $("#selected-caption").text(selected_text);
        $("#selected-caption-input").val(selected_text)
        $("#submit-caption").show();
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
        $(".card-container-overview").hide()
        $("#send-image").hide()

    });
}

function sync_cards(){
    let all_cards = $('#all-captions-final').children('div');
    setInterval(function () {
        $.getJSON("./data/game/game_data.json", function (json) {
            let PIN = $("#selected-caption-code").val();
            let round = json[PIN]["round"]["number"];
            let images = json[PIN]["round"]["round_info"][round]["submitted"]
            for ([player, info] of Object.entries(images)){
                if (info["status"] === "open"){
                    for (let i = 0; i < all_cards.length; i++){
                        let name = all_cards[i].firstChild.value;
                        if (player === name) {
                            console.log("YASSS")
                            let id = $("#" + all_cards[i].id);
                            id.children("span").addClass("is-flipped");
                            // console.log($("#" +id).children("span"))
                            id.children("span").children('div').addClass("is-flipped");
                        }
                    }
                }
            }
        })
    }, 2000)
}

function sync_winner(){
    setInterval(function () {
        if ($("#show-winner").attr("display", "none")){
            $.getJSON("./data/game/game_data.json", function (json) {
                let PIN = $("#selected-caption-code").val();
                let round = json[PIN]["round"]["number"];
                let key = Object.keys(json[PIN]["round"]["round_info"][round]["winner"]).length;
                if (key === 1){
                    console.log("YAYYYY")
                    console.log(json[PIN]["round"]["round_info"][round]["winner"].length)
                    $("#show-winner").load(window.location.href + " #show-winner").show()
                }
            })
        }
    }, 1000)
}


//////////////////////////////////////////////////////////////////
////////////////////////////// MAIN //////////////////////////////
//////////////////////////////////////////////////////////////////

$(function () {

    // Index page
    $("#join-code").keyup(function () {
        checkPIN();
    })


    // Lobby page
    closeButtonAvatar()
    selectButtonAvatar()
    $("#username-input").keyup(function () {
        checkUsername()
    });

    $("#judge-overview").hide()

    hideForm()
    chooseImage()

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
    // setInterval(function () {
    //         $("#selected-captions-overview").load(window.location.href + " #selected-captions-overview")}
    //     , 2000);

    setInterval(function () {
        if ($("#all-captions-final").length === 0){
            $("#selected-captions-overview").load(window.location.href + " #selected-captions-overview")
        } else {
            let all_cards = $('#all-captions-final').children('div');
            console.log("WORKING")
            $.getJSON("./data/game/game_data.json", function (json) {
                let PIN = $("#selected-caption-code").val();
                let round = json[PIN]["round"]["number"];
                let images = json[PIN]["round"]["round_info"][round]["submitted"]
                for ([player, info] of Object.entries(images)){
                    if (info["status"] === "open"){
                        for (let i = 0; i < all_cards.length; i++){
                            let name = all_cards[i].firstChild.value;
                            if (player === name) {
                                let id = $("#" + all_cards[i].id);
                                id.children("span").addClass("is-flipped");
                                id.children("span").children('div').addClass("is-flipped");
                            }
                        }
                    }
                }
            })
        }
        }
        , 500);


    submitWinner()
    selectWinner()
    selectImage()
    submitImage()
    submitMainImage()

    // Player functions
    // $("#next-round").hide()
    $("#submit-caption").hide();

    // Judge functions


    // flipCard()
    // sync_cards()
    showChoice()
    sync_winner()


    setInterval(function () {
        let all_cards = $('#all-captions-final').children('div');
        console.log("WORKING")
        $.getJSON("./data/game/game_data.json", function (json) {
            let PIN = $("#selected-caption-code").val();
            let round = json[PIN]["round"]["number"];
            let images = json[PIN]["round"]["round_info"][round]["submitted"]
            for ([player, info] of Object.entries(images)){
                if (info["status"] === "open"){
                    for (let i = 0; i < all_cards.length; i++){
                        let name = all_cards[i].firstChild.value;
                        if (player === name) {
                            let id = $("#" + all_cards[i].id);
                            id.children("span").addClass("is-flipped");
                            id.children("span").children('div').addClass("is-flipped");
                        }
                    }
                }
            }
        })
    }, 500)

    setInterval(function () {
        $.getJSON("./data/game/game_data.json", function (json) {
            let PIN = $("#selected-caption-code").val();
            let status = json[PIN]["current_image"];
            if (status === "clicked"){
                $("#next-round").submit()
            }
            // let rounds = Object.keys(images).length
            // if
            // for ([player, info] of Object.entries(images)){
            //     if (info["status"] === "open"){
            //         for (let i = 0; i < all_cards.length; i++){
            //             let name = all_cards[i].firstChild.value;
            //             if (player === name) {
            //                 console.log("YASSS")
            //                 let id = $("#" + all_cards[i].id);
            //                 id.children("span").addClass("is-flipped");
            //                 // console.log($("#" +id).children("span"))
            //                 id.children("span").children('div').addClass("is-flipped");
            //             }
            //         }
            //     }
            // }
        })
    }, 100)

})
