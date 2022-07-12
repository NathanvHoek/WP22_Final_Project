<?php

if (isset($_POST["username"])){
    $json_file = file_get_contents("../data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    unset($game_data[$_POST["PIN"]]["status"][""]);
    $game_data[$_POST["PIN"]]["status"][$_POST["username"]] = "continued";

    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);
}