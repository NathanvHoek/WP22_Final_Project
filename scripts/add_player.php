<?php
session_start();
if (!empty($_POST['username']) && !empty($_POST['avatar'])) {
    $room_PIN = $_POST["room_PIN"];

    // Read articles
    $json_file = file_get_contents("../data/game/player_data.json");
    $game = json_decode($json_file, true);

    $game[$room_PIN][] = [
        'player_id' => 4,
        'player_name' => $_POST["username"],
        "player_avatar" => $_POST["avatar"],
        "is_judge" => false,
        'player_images' => [],
    ];

    // Save to external file
    $json_file = fopen('../data/game/player_data.json', 'w');
    fwrite($json_file, json_encode($game));
    fclose($json_file);

    $_SESSION["username"] = $_POST["username"];
}