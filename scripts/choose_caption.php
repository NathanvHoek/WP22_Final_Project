<?php

if (!empty($_POST['caption'])) {
    $json_file = file_get_contents("../data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    $round = $game_data[$_POST["code"]]["round"]["number"];
    $game_data[$_POST["code"]]["round"]["round_info"][$round]["submitted"][$_POST["name"]] =
        ["caption" => $_POST["caption"],
    "status" => "closed"];

    // Save to external file
    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);
}