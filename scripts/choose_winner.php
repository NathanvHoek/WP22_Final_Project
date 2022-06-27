<?php

if (!empty($_POST["caption"])){
    $room_PIN = $_POST["room_PIN"];

    $json_file = file_get_contents("../data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    $round = $game_data[$room_PIN]["round"]["number"];
    $game_data[$room_PIN]["round"]["round_info"][$round]["winner"][$_POST["name"]] = $_POST["caption"];

    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);


}