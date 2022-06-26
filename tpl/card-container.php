<div id="card-container-overview">
    <?php
    $json_file = file_get_contents("data/game/game_data.json");
    $data = json_decode($json_file, true);
    $current_captions = $data[$_SESSION["game_PIN"]]["player_data"][$_SESSION["username"]]["captions"];
    foreach ($current_captions as $name => $caption) {
        echo "<div class='card'><p>$caption</p></div>";
    }
    //        ?>

</div>