<?php

if (!empty($_POST['main_image'])) {
    $json_file = file_get_contents("../data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    $round = $game_data[$_POST["game_PIN"]]["round"]["number"];
    $game_data[$_POST["game_PIN"]]["round"]["round_info"][$round]["current_image"] = $_POST["main_image"];

    // Save to external file
    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);
}