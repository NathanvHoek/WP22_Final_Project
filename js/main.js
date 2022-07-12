//////////////////////////////////////////////////////////////////
/////////////////////////// INDEX PAGE ///////////////////////////
//////////////////////////////////////////////////////////////////
function checkPIN() {
    let PIN = $("#join-code").val();
    let room_exists = false;
    $.getJSON("./data/game/game_data.json", function (json) {
        if (json[PIN] && json[PIN]["status"][""] === "inactive") {
            room_exists = true;
        }
        toggleJoinButton(room_exists)
    })
}

function toggleJoinButton(room_exists) {
    let join_button = $("#pin-join-btn")
    if (room_exists) {
        join_button.attr("disabled", false);
    } else {
        join_button.attr("disabled", true);
    }
}



//////////////////////////////////////////////////////////////////
/////////////////////////// LOBBY PAGE ///////////////////////////
//////////////////////////////////////////////////////////////////

function checkPlayerInput(){
    let PIN = $("#game-pin").val();
    let username = $("#username-input").val();
    let avatar = $("#avatar-input").val();
    $.getJSON("./data/game/game_data.json", function (json) {
        if (
            (username !== "") &&
            (username.length < 30) &&
            (!json[PIN]["player_data"][username]) &&
            (avatar !== "empty")
            ){
            console.log("YAYYYY")
            $("#join-game").attr("disabled", false);
        } else {
            console.log("NOOOOO")
            $("#join-game").attr("disabled", true);
        }
    })
}

function continueGameMinimumPlayers(){
    setInterval(function () {
        let PIN = $("#game-pin").val();
        $.getJSON("./data/game/game_data.json", function (json) {
            if (Object.keys(json[PIN]["player_data"]).length > 1){
                $("#start-game").attr("disabled", false);
            } else {
                $("#start-game").attr("disabled", true);
            }
        })
    }, 2000)
}

function openRoundDiv() {
    $("#amount-round-div").hide()
    $("#start-game").click(function () {
        let formData = {
            username: $("#username").val(),
            PIN: $("#game-pin").val()
        };

        $.ajax({
            type: "POST",
            url: "./scripts/continue_game.php",
            data: formData,
            dataType: "json",
            encode: true,
            success: function () {
            setTimeout(function () {
                $("#amount-round-div").load(location.href + " #round-data")
            }, 400);
            $("#amount-round-div").show()}
        })
    })
}

function syncRoundDiv(){
    let PIN = $("#game-pin").val();
    let roundSync = setInterval( function() {
        $.getJSON("./data/game/game_data.json", function (json) {
            let initiator = Object.keys(json[PIN]["status"])[0];
            let state = json[PIN]["status"][initiator];
            if (state === "continued" && initiator !== ""){
                $("#amount-round-div").load(location.href + " #round-data")
                $("#amount-round-div").show()
                $("#start-game").attr("disabled", true);
                clearInterval(roundSync)
            }
        })
    }
    , 1000)

}

// Selecting avatar
function showAvatarsIcon(){
    $("#avatar-box").hide();
    $("#choose-avatar-btn").click(function () {
        $("#avatar-box").show();
    });
}

function chooseAvatar(){
    $("#avatar-overview .small-avatars").click(function () {
        $("#avatar-overview .small-avatars").css("border", "5px solid white");
        $(this).css("border", "5px solid green");
        $("#submit-avatar").attr("disabled", false);
        $("#submit-avatar").data("image", $(this).attr('src'));
    })
}

function closeButtonAvatar() {
    $("#close-button").click(function () {
        $("#avatar-overview .small-avatars").css("border", "5px solid white");
        $("#submit-avatar").attr("disabled", true);
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


function hideForm(){
    $("#join-game").click(function (){
        $("#player-form").hide()
    })
}


function submitPlayerForm(){
    $("#join-game").click(function (event) {
            $("#username").val($("#username-input").val())

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
            $("#add-player-container").hide();

            setTimeout(function () {
                $(".player-overview-div").load(window.location.href + " .player-overview")
            }, 100)
            
            // setTimeout(function () {
            //     $.getJSON("./data/game/game_data.json", function (json) {
            //         console.log(json[$("#room-pin").val()]["player_data"])
            //         if (json[$("#room-pin").val()]["player_data"].length < 1){
            //             $("#start-game").attr("disabled", false);
            //         }
            // })
            // },100);
})}


//////////////////////////////////////////////////////////////////
/////////////////////////// JURY PAGE ////////////////////////////
//////////////////////////////////////////////////////////////////

function switchTabs() {
    const tabs = document.querySelectorAll('[data-tab-target]');
    const tabContents = document.querySelectorAll('[data-tab-content]')
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = document.querySelector(tab.dataset.tabTarget);
            tabContents.forEach(tabContent => tabContent.classList.remove('active-div'));
            target.classList.add('active-div');
        })
    })
}


function chooseMainImage(){
    $(".judge-images .choose-picture").click(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("#main-image").val("");
            $("#choose-image").attr("disabled", true)
        } else {
            let img_src = $(this).attr('src');
            $(".judge-images .choose-picture").removeClass("active");
            $(this).addClass("active");
            $("#main-image").val(img_src);
            $("#choose-image").attr("disabled", false)
        }
    })
}


function submitMainImage(){
    $("#main-image-div").hide()
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

        $("#selected-captions-overview").show();
        $("#main-image-div").load(window.location.href + " #main-image-div img").css("display", "block");
        $("#choose-image-div").hide();

    });
}

function uploadImage() {
    $("#but_upload").click(function(){
        let fd = new FormData();
        let files = $('#file')[0].files;
        let pin = $("#game-pin").val();
        console.log(pin)
        // Check file selected or not
        if(files.length > 0 ){
            fd.append('file', files[0]);
            fd.append('game_PIN', pin);

            $.ajax({
                url: './scripts/upload_img.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response !== 0){
                        $("#img").attr("src", response);
                        $(".preview img").show(); // Display image element
                    } else{
                        alert('file not uploaded');
                    }
                },
            });
        }else{
            alert("Please select a file.");
        }
})}

function copyToClipboard(){
    $("#copy-clipboard").click(function () {
        let input = document.body.appendChild(document.createElement("input"));
        input.value = $("#code").text();
        input.focus();
        input.select();
        document.execCommand('copy');
        input.parentNode.removeChild(input);
    })
}

function flipCard() {
    $(this).css("border", "3px red solid")
    $('.flip-card').click(function () {
            if (!$(this).hasClass("is-flipped")){
                $(this).addClass("is-flipped")
                let player = $(this).children(".card__face--back").children("p")[1].innerText;
                let formData = {
                    card_player: player,
                    game_PIN: $("#game_pin").val()
                };

                $.ajax({
                    type: "POST",
                    url: "./scripts/sync_card_status.php",
                    data: formData,
                    dataType: "json",
                    encode: true,
                })

                let all_cards = $("#all-captions-final").children("div");
                let complete = true;
                for (let i = 0; i < all_cards.length; i++){
                    if (!all_cards[i].children("span").hasClass("is-flipped"))
                        complete = false
                }

                if (complete === true){
                    $("#choose-winner").show()
                }
            }
    });
}

function selectWinner() {
    $("#all-captions-final .card__face--back").click(function () {
        console.log($(this))
        let selected_text = $(this).children("p")[0].innerText;
        let winner = $(this).children("p")[1].innerText;
        $("#all-captions-final .card__face--back").css("border", "3px solid purple")
        $(this).css("border", "3px solid green");
        $("#winner-caption").val(selected_text);
        $("#winner-name").val(winner);
        $("#choose-winner").show()
    })
}

function submitWinner() {
    $("#show-winner-div").hide()
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
        $("#show-winner-div").load(window.location.href + " #show-winner-div").show()
        // $("#show-winner").show()
    })
}


//////////////////////////////////////////////////////////////////
////////////////////////// PLAYER PAGE ///////////////////////////
//////////////////////////////////////////////////////////////////
function selectImage() {
        $(".card-container-overview .card").click(function () {
            if ($(".wait-judge").length === 0) {
                let selected_text = $(this).children("p")[0].innerText;
                $(".card-container-overview .card").css("border", "3px solid purple")
                $(this).css("border", "3px solid green");
                $("#selected-caption").text(selected_text);
                $("#selected-caption-input").val(selected_text)
                $("#submit-caption").show();
        }})
}

function submitImage() {
    $("#send-image").click(function (event) {
        let formData = {
            caption: $("#selected-caption-input").val(),
            name: $("#selected-caption-named").val(),
            code: $("#selected-caption-code").val()
        };

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


function sync_winner(){
    setInterval(function () {
        if ($("#show-winner-div").attr("display", "none")){
            $.getJSON("./data/game/game_data.json", function (json) {
                let PIN = $("#selected-caption-code").val();
                let round = json[PIN]["round"]["number"];
                let key = Object.keys(json[PIN]["round"]["round_info"][round]["winner"]).length;
                if (key === 1){
                    console.log(json[PIN]["round"]["round_info"][round]["winner"].length)
                    $("#show-winner-div").load(window.location.href + " #show-winner-div").show()
                }
            })
        }
    }, 1000)
}


function sync_cards() {
    setInterval(function () {
            if ($("#all-captions-final").length === 0){
                $("#selected-captions-overview").load(window.location.href + " #selected-captions-overview")
            } else {
                let all_cards = $('#all-captions-final').children('div');
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
}


function nextRound(){
    setInterval(function () {
            $.getJSON("data/game/game_data.json", function (json) {
                let PIN = $("#game-pin").val();
                let round = $("#round-num").val();
                let round_status = json[PIN]["round"]["round_info"][round]["round_status"];
                if (round_status === "finished"){
                    $("#next-round").submit()
                }
            })
    }, 1000)
}


//////////////////////////////////////////////////////////////////
////////////////////////////// MAIN //////////////////////////////
//////////////////////////////////////////////////////////////////

$(function () {

    // INDEX PAGE
    $("#join-code").keyup(function () {
        checkPIN();
    })

    // All function to be used in the lobby
    if (window.location.href.endsWith("lobby.php")){
        openRoundDiv()
        closeButtonAvatar()
        selectButtonAvatar()
        showAvatarsIcon()
        chooseAvatar()
        setInterval(function () {
                $(".player-overview-div").load(window.location.href + " .player-overview")}
            , 1000);

        setInterval(function () {
                $.getJSON("./data/game/game_data.json", function (json) {
                    let PIN = $("#game-pin").val();
                    // let key = Object.keys(json[PIN]["status"])[0]
                    if (json[PIN]["status"] === "active") {
                        $("#start-game-form").submit();
                    }
                })}
            , 500);



        copyToClipboard()
        submitPlayerForm()

        $("#username-input").keyup(function () {
            checkPlayerInput()
        });

        $("#cancel-submit button").click(function () {
            checkPlayerInput()
        });

        syncRoundDiv()
        continueGameMinimumPlayers()

    }



    setInterval(function () {
            $("#chosen-image").load(window.location.href + " #chosen-image")}
        , 2000);

    $("#submit-caption").hide();



    // JUDGE PAGE
    if (window.location.href.endsWith("game.php")){
        sync_winner()
        sync_cards()
        nextRound()
    }

    switchTabs()
    chooseMainImage()
    submitMainImage()
    selectWinner()
    submitWinner()
    $("#choose-winner").hide()
    $("#selected-captions-overview").hide()
    // $("#show-winner-div").hide()
    // flipCard()

    // PLAYER PAGE
    selectImage()
    submitImage()


    // Sync cards

    $("#judge-overview").hide()

    hideForm()

    uploadImage()
})
