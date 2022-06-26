<div class="judge-main-image">
    <p>Noiceee</p>
    <?php
    $json_file = file_get_contents("data/game/game_data.json");
    $game_data = json_decode($json_file, true);
    $main_image = $game_data[$_SESSION["game_PIN"]]["current_image"];
    echo "<img src='$main_image'>";
    echo $_SESSION["game_PIN"];
    echo $main_image;
//    echo $_SESSION["game_PIN"]["current_image"];
    ?>
</div>