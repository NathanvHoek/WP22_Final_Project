<div id="main-image-div" class="center">
    <?php
    $json_file = file_get_contents("data/game/game_data.json");
    $game_data = json_decode($json_file, true);
    $round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
    $current_image = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["current_image"];
    echo "<img src='$current_image'>";
    ?>
</div>