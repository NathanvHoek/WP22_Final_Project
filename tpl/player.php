<h1 class="player-status-message">Hey, <?= $player_name ?>, you are a player!</h1>

<!--    <div class="scores">-->
<!--        --><?php
//        $json_file = file_get_contents("data/player_data.json");
//        $articles = json_decode($json_file, true);
//        foreach($articles as $player) {
//            $player_name = $player["player_name"];
//            $player_avatar = $player["player_avatar"];
//            echo "<p class='score'>$player_name</p>";
//        }
//        ?>
<!--    </div>-->


<div id="chosen-image">
    <?php
    $json_file = file_get_contents("data/game/game_data.json");
    $game_data = json_decode($json_file, true);
    $round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
    $current_image = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["current_image"];

    if (empty($current_image)){
        echo "Wait for the judge to choose a picture";
    } else {
        echo "<img src='$current_image'>";
    }
    ?>
</div>

<div id="selected-caption-div">
    <p id="selected-caption"></p>
</div>

<div id="submit-caption">
    <form>
        <input type="text" id="selected-caption-named" name="name" value="<?= $_SESSION["username"] ?>" hidden>
        <input type="text" id="round" name="name" value="<?= $_SESSION["round"] ?>" hidden>
        <input type="text" id="selected-caption-code" name="name" value="<?= $_SESSION["game_PIN"] ?>" hidden>
        <input type="text" id="selected-caption-input" name="caption" hidden>
        <button class="btn btn-primary" id="send-image">Send this gorgeous piece of artwork</button>
    </form>
</div>

<?php include "card-container.php" ?>

<div id="selected-captions-overview">
    <?php
    $json_file = file_get_contents("./data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    $round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
    $selected_captions = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["submitted"];
    $all_players = $game_data[$_SESSION["game_PIN"]]["player_data"];

    if (count($selected_captions) == count($all_players)-1) {
        echo "<p>All players have submitted their captions, now the jury decides which one is the winner</p>";
        echo "<div id='all-captions-final'>";
    } else {
        echo "<p>Not all player have submitted their captions</p>";
        echo "<div id='all-captions-streaming'>";
        }

    $card_id = 0;
    foreach ($selected_captions as $player => $info){
        $caption = $info["caption"];
        echo "<div class='scene scene--card' id='card_$card_id'>";
        echo "<input type='text id='card-player-name' value='$player' hidden>";
        echo    "<span class='flip-card'>";
        echo        "<div class='flip-card'>";
        echo            "<div class='card__face card__face--front'>";
        echo                "<img src='media/logo/wdym_logo_small.png' alt='card_image' style='width:100px;height:100px;'>";
        echo            "</div>";
        echo            "<div class='card__face card__face--back'><p>$caption</p></div>";
        echo        "</div>";
        echo    "</span>";
        echo "</div>";
        $card_id++;

        }
        echo "</div>";
    ?>

</div>
<?php include "show_winner.php";?>