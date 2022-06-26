<?php
session_start();
?>

<?php
include "tpl/head.php";
include 'tpl/header.php';
?>

<?php $lobby_room_PIN = $_SESSION["game_PIN"]?>

<div class="container">
    <h1><?= $lobby_room_PIN ?></h1>
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
                <input type="text" name="username" id="username-input" placeholder="Type your username here">
                <button id="join-game" name="join-game">Join the game!</button>
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
        $json_file = file_get_contents("data/game/game_data.json");
        $all_games = json_decode($json_file, true);

        $players = $all_games[$lobby_room_PIN]["player_data"];

        foreach ($players as $player => $player_info) {
            $avatar = $player_info["player_avatar"];
            echo "<div class='player-div'><img src='$avatar' class='player-icon'></div><p>$player</p>";
        }
        ?>

        <form id="start-game-form" action="start_game.php" method="post">
            <input type="text" id="join-code" value="<?= $lobby_room_PIN ?>" hidden>
            <button id="start-game" class="btn btn-light article_edit">Start the game</button>
        </form>

    </div>
</div>


<?php
include "tpl/end.php"
?>