<?php
session_start();

if (!empty($_POST['username']) && !empty($_POST['avatar'])) {

    $game_PIN = $_POST["room_PIN"];

    $json_file = file_get_contents("../data/game/game_data.json");
    $game_data = json_decode($json_file, true);


    // Add player to json file
    $game_data[$game_PIN]["player_data"][$_POST["username"]] =
        [
            "player_avatar" => $_POST["avatar"],
            "status" => "active",
            "score" => 0,
            "captions" => [],
            "current_round" => 1
        ];

    $game_data[$game_PIN]["judge"]["all_players"][] = $_POST["username"];

    // Save to external file
    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);

    $_SESSION["username"] = $_POST["username"];
}