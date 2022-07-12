<?php
session_start();
include "tpl/structure/start.php";
include "tpl/components/header.php";


$json_file = file_get_contents("./data/game/game_data.json");
$game_data = json_decode($json_file, true);
$game_PIN = $_SESSION["game_PIN"];
$max_round = $game_data[$game_PIN]["round"]["max_rounds"];

if ($_SESSION["round"] == $max_round) {
    // Update score winner
    $winner = key($game_data[$game_PIN]["round"]["round_info"][$_SESSION["round"]]["winner"]);
    $game_data[$game_PIN]["player_data"][$winner]["score"] = $game_data[$game_PIN]["player_data"][$winner]["score"] + 1;
    echo "That was the game!";
    $game_data[$game_PIN]["round"]["round_info"][$_SESSION["round"]]["round_status"] = "finished";
    header("refresh:3; url= end_game.php");
    $json_file = fopen('data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);
    die();
}

else if ($_SESSION["round"] + 1 == $max_round){
    echo "Let's go to the last round";
}


// If your current round + 1 is not the same as the round in JSON file, you are the first to click it
if ($_SESSION["round"] + 1 !== ($game_data[$game_PIN]["round"]["number"])) {
    $game_data[$game_PIN]["round"]["round_info"][$_SESSION["round"]]["round_status"] = "finished";
    $next_round = $game_data[$game_PIN]["round"]["number"] + 1;
    $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] = $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] + 1;
    $game_data[$game_PIN]["round"]["number"] = $next_round;

    // Create a new round
    $game_data[$game_PIN]["round"]["round_info"][$next_round] =
        ["round_status" => "proceeding",
            "current_image" => "",
            "submitted" => [],
            "winner" => []];

    echo "<h1>Let's goooooo to round number $next_round</h1>";
    $game_data[$game_PIN]["round"]["round_info"][$next_round]["players"][] = $_SESSION["username"];
    $_SESSION["round"] = $_SESSION["round"] + 1;

    // Update judge
    $judge_all_players = $game_data[$game_PIN]["judge"]["all_players"];
    $judge_remaining = $game_data[$game_PIN]["judge"]["remaining_judges"];

    if (empty($game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"])) {
        $game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"] = $game_data[$_SESSION["game_PIN"]]["judge"]["all_players"];
    }

    $game_data[$_SESSION["game_PIN"]]["judge"]["current_judge"] = array_pop($game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"]);


    // Update score winner
    $winner = key($game_data[$game_PIN]["round"]["round_info"][$next_round - 1 ]["winner"]);
    $game_data[$game_PIN]["player_data"][$winner]["score"] = $game_data[$game_PIN]["player_data"][$winner]["score"] + 1;


    // Update cards
}

else {
    echo "Yayyy";
    $_SESSION["round"] = $_SESSION["round"] + 1;
    $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] = $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] + 1;
}

$json_file = fopen('data/game/game_data.json', 'w');
fwrite($json_file, json_encode($game_data));
fclose($json_file);


header("refresh:3; url= game.php");

include "tpl/structure/end.php";
?>