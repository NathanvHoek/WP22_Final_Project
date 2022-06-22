<?php
session_start();
if (!empty($_POST['username']) && !empty($_POST['avatar'])) {
    // Read articles
    $json_file = file_get_contents("../data/player_data.json");
    $players = json_decode($json_file, true);

    $players[] = [
        'player_id' => 4,
        'player_name' => $_POST["username"],
        "player_avatar" => $_POST["avatar"],
        "is_judge" => false,
        'player_images' => [],
    ];

    // Save to external file
    $json_file = fopen('../data/player_data.json', 'w');
    fwrite($json_file, json_encode($players));
    fclose($json_file);

    $_SESSION["username"] = $_POST["username"];
}