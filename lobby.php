<?php
session_start();

$game_PIN = $_SESSION["game_PIN"];
$page_title = "WDYM - Waiting room $game_PIN";

include "tpl/structure/start.php";

include "tpl/components/header.php";
?>

<div class="background">
    <div id="lobby-header" class="center">
        <h1 id="room-number-text" class="bold center">Room number: <span id="code"> <?= $game_PIN ?></span><button id="copy-clipboard">Copy code</button></h1>
            <button id="start-game" class="btn btn-light article_edit bold" disabled>Continue to game</button>
    </div>

    <div id="add-player-container" class="center">
        <form id="add-player-form" class="center">
            <div id="choose-avatar-btn" class="center">
                <img src="media/avatars/no_avatar.jpeg" alt="" id="avatar">
            </div>

            <input type="text" id="room-pin" name="game_pin" value="<?= $game_PIN ?>" hidden>
            <input type="text" id="avatar-input" name="avatar" value="empty" hidden>

            <input type="text" name="username" id="username-input" placeholder="Type your username here">
            <button id="join-game" class="btn btn-info bold" name="join-game" disabled>Join the game!</button>
        </form>
    </div>

    <!--    Hidden box with avatars -->
    <div id="avatar-box" class="avatar-select card-body">
        <div id="avatar-overview">
            <?php
            $avatar_dir = "./media/avatars/*";
            foreach (glob($avatar_dir) as $avatar){
                if (!strpos($avatar, "no_avatar.jpeg"))
                    echo "<img class='small-avatars' src='$avatar'>";
            }
            ?>
        </div>
        <div id="cancel-submit">
            <button id="close-button" class="btn btn-danger">Cancel</button>
            <button id="submit-avatar" class="btn btn-success">Select this avatar</button>
        </div>
    </div>


<!--    Overview with all the players, gets reloaded on submit new player -->
    <div class="player-overview-div">
        <div class="player-overview">
            <?php
            $json_file = file_get_contents("data/game/game_data.json");
            $game_data = json_decode($json_file, true);

            $players = $game_data[$game_PIN]["player_data"];

            foreach ($players as $player => $player_info) {
                $avatar = $player_info["player_avatar"];
                echo "<div class='player-div'>";
                echo "<img src='$avatar' class='player-icon'>";
                echo "<p>$player</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

<div id="amount-round-div">
    <div id="round-data">
        <?php
        $decider = array_keys($game_data[$game_PIN]["status"])[0];
        if ($decider == $_SESSION["username"]){
            echo "<h3>How many rounds do you want to play?</h3>";
            $count_players = count($game_data[$game_PIN]["player_data"]);
            echo "<p>There are $count_players, every player should be the judge for this many times:</p>";

            echo "<form action='start_game.php' method='post' id='start-game-form'>";
            echo "<input type='number' name='timesJudge' id='timesJudge' max='5' min='1' value='1'>";
            echo "<button type='submit'>Start the game</button>";
        } else {
            echo "<h3>$decider has clicked the continue button and decides how many rounds there will be played</h3>";
            echo "<form action='start_game.php' method='post' id='start-game-form' hidden>";
        }
        echo "</form>";
        ?>
    </div>

</div>

<?php
include "tpl/components/data.php";
include "tpl/structure/end.php";
?>







<!--    <script>-->
<!--        window.onbeforeunload = function(){-->
<!--            return 'Are you sure you want to leave?';-->
<!--        };-->
<!--    </script>-->