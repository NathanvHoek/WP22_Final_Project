<div id="show-winner-div">
    <?php
    $json_file = file_get_contents("data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    $round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
    $winner = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["winner"];
    $winner_name = key($winner);
    $winner_caption = $winner[$winner_name];
    $image = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["current_image"];
    $max_round = $game_data[$_SESSION["game_PIN"]]["round"]["max_rounds"];
    echo "<div id='show-winner'>";
    echo "<p>The winner is $winner_name</p>";
    echo "<img src='$image'>";
    echo "<p>$winner_caption</p>";
    echo "</div>";

    echo "<form id='next-round' action='next_round.php' method='post'>";
    if ($_SESSION["round"] == $max_round) {
        echo "<button type='submit' class='btn btn-primary'>Go to overview</button></a>";
    } else {
        echo "<button type='submit' class='btn btn-primary'>Go to next round</button></a>";
    }
    echo "</form>";
    ?>

</div>


