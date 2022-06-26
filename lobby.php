<?php
session_start();
?>

<?php
include "tpl/head.php";
?>

<?php $lobby_room_PIN = $_SESSION["game_PIN"]?>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-left">
                    <li ><a href="index_test.php">HOME</a></li>
                    <li><a href="#services">ABOUT US</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index_test.php"">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lobby</li>
        </ol>
    </nav>
    <div class="jumbotron">
        <div class="text-center">
            <img src="media/logo/wdym_logo_ex_sm.png" class="rounded" alt="...">
        </div>
    </div>


<div class="lobby_container">
<!--    Lijkt niet te werken-->
<!--    <h1>--><?//= $lobby_room_PIN ?><!--</h1>-->
    <div class="add-player">

        <div id="welcome-player">
            Hello there <?= $_POST["username"] ?>
        </div>

        <div id="player-form">
            <form id="add-player-form">
                <div id="choose-avatar-btn">
                    <img src="media/avatars/no_avatar.jpeg" alt="" id="avatar">
                </div>
                <input type="text" id="room-pin" value="<?=$lobby_room_PIN?>" hidden>
                <input type="text" id="avatar-input" name="avatar-src" hidden>
                <input type="text" name="username" id="username-input" class="form-control" placeholder="Type your username here">
                <button id="join-game" class="btn btn-info" name="join-game">Join the game!</button>
            </form>
        </div>
    </div>



    <div class="avatar-select" id="avatar-box">
        <div id="avatar-overview">
            <?php
            $json_file = file_get_contents("data/content/images.json");
            $images_json = json_decode($json_file, true);
            $images_array = $images_json["images"];
            for ($i=0; $i < count($images_array); $i++){
                $image = $images_array[$i];
                echo "<img class='small-avatars' src='media/img/$image'>";
            }
            ?>
        </div>
        <div id="cancel-submit">
            <button>Cancel</button>
            <button>Select this avatar</button>
        </div>
    </div>

<!--    Overview with all the players, gets reloaded on submit new player -->
    <div class="player-overview">
        <?php
        $json_file = file_get_contents("data/game/player_data.json");
        $all_games = json_decode($json_file, true);
        $lobby = $all_games[$lobby_room_PIN];

        $amount_of_players = count($lobby);
        for ($i=0; $i < $amount_of_players; $i++) {
            $player = $lobby[$i]["player_name"];
            $avatar = $lobby[$i]["player_avatar"];
            echo "<div class='player-div'><img src='$avatar' class='player-icon'></div><p>$player</p>";
        }
        ?>

        <button id="start-game" class="btn btn-light article_edit"><a href="distribute_cards.php"> Start the game</a></button>

    </div>

</div>


<?php
include "tpl/end.php"
?>