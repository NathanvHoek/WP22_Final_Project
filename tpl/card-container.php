<div id="card-container">
    <?php
    $json_file = file_get_contents("data/game_data.json");
    $data = json_decode($json_file, true);
    $current_captions = $data["caption_cards_current_round"];
    for ($i=0; $i < count($current_captions); $i++) {
        $caption = $current_captions[$i];
//            echo $caption;
        echo "<div class='card'><p>$caption</p></div>";
    }
    //        ?>

</div>