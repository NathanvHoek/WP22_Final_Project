<?php
session_start();


if (!empty($_POST['username']) && !empty($_POST['avatar'])) {

    $room_PIN = $_POST["room_PIN"];

    $json_file = file_get_contents("../data/game/game_data.json");
    $game = json_decode($json_file, true);

    $game[$room_PIN]["player_data"][$_POST["username"]] =
        ["player_avatar" => $_POST["avatar"],
        "status" => "active",
        'captions' => []
    ];

    $game[$room_PIN]["judge"]["all_players"][] = $_POST["username"];

    // Save to external file
    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game));
    fclose($json_file);

    $_SESSION["username"] = $_POST["username"];
}