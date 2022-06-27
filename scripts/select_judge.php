<?php


// Open file and get data
$json_file = file_get_contents("../data/game/game_data.json");
$games = json_decode($json_file, true);

$game_data = $games[$_SESSION["game_PIN"]];

$judge_all_players = $game_data["judge"]["all_players"];
$judge_remaining = $game_data["judge"]["remaining_judges"];


// Candidate list is empty then copy from players list

if (empty($games[$_SESSION["game_PIN"]]["judge"]["remaining_judges"])) {
    $games[$_SESSION["game_PIN"]]["judge"]["remaining_judges"] = $games[$_SESSION["game_PIN"]]["judge"]["all_players"];
}


$games[$_SESSION["game_PIN"]]["judge"]["current_judge"] = array_pop($games[$_SESSION["game_PIN"]]["judge"]["remaining_judges"]);

//// Write change to file
$json_file = fopen('../data/game/game_data.json', 'w');
fwrite($json_file, json_encode($games));
fclose($json_file);
?>