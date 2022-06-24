<div id="card-container-overview">
    <?php
    $json_file = file_get_contents("data/game_data.json");
    $data = json_decode($json_file, true);
    $current_captions = $data["caption_cards_current_round"];
    foreach ($current_captions as $name => $caption) {
        echo "<div class='card-overview'><p class='card'>$caption</p></div>";
    }
    //        ?>

</div>