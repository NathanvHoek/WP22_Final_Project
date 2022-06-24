<?php

if (!empty($_POST['caption'])) {
    // Read articles
    $json_file = file_get_contents("../data/game/game_data.json");
    $images = json_decode($json_file, true);

    $images["caption_cards_current_round"][$_POST["name"]] = $_POST["caption"];

    // Save to external file
    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($images));
    fclose($json_file);
}