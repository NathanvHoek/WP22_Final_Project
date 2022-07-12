<?php
session_start();
include "./tpl/structure/start.php";
include "./tpl/components/header.php";
include "./tpl/components/json/open_game_data.php";

$game_PIN = $_SESSION["game_PIN"];
$max_round = $game_data[$game_PIN]["round"]["max_rounds"];

// When last round has ended, this if statement will only be executed
if ($_SESSION["round"] == $max_round) {
    // Message for going to overview
    echo "<div class='header-loading'><h1>Now let's us take a look at all the beautiful creations</h1></div>";

    // Update score winner
    $winner = key($game_data[$game_PIN]["round"]["round_info"][$_SESSION["round"]]["winner"]);
    $game_data[$game_PIN]["player_data"][$winner]["score"] = $game_data[$game_PIN]["player_data"][$winner]["score"] + 1;

    //  Finish this round
    $game_data[$game_PIN]["round"]["round_info"][$_SESSION["round"]]["round_status"] = "finished";

    include "./tpl/components/json/close_game_data.php";
    header("refresh:3; url= end_game.php");
    die();
} else {
    $next_round = $game_data[$game_PIN]["round"]["number"] + 1;

    // If second last round, show specific message, otherwise show what round it goes next
    if ($_SESSION["round"] + 1 == $max_round){
        echo "<div class='header-loading'><h1>Let's go to the last round</h1></div>";
    } else {
        echo "<div class='header-loading'><h1>Let's goooooo to round number $next_round</h1></div>";
    }

    // If your current round + 1 is not the same as the round in JSON file, you are the first to click it
    if ($_SESSION["round"] + 1 !== ($game_data[$game_PIN]["round"]["number"])) {
        // Change game status to finished
        $game_data[$game_PIN]["round"]["round_info"][$_SESSION["round"]]["round_status"] = "finished";

        // Update round numbers on players and general
        $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] = $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] + 1;
        $game_data[$game_PIN]["round"]["number"] = $next_round;
        $_SESSION["round"] = $_SESSION["round"] + 1;

        // Create a new round data structure
        $game_data[$game_PIN]["round"]["round_info"][$next_round] =
            ["round_status" => "proceeding",
                "current_image" => "",
                "submitted" => [],
                "winner" => []];

        // Update judge
        $judge_all_players = $game_data[$game_PIN]["judge"]["all_players"];
        $judge_remaining = $game_data[$game_PIN]["judge"]["remaining_judges"];
        if (empty($game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"])) {
            $game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"] = $game_data[$_SESSION["game_PIN"]]["judge"]["all_players"];
        }
        $game_data[$_SESSION["game_PIN"]]["judge"]["current_judge"] = array_pop($game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"]);

        // Update score of the winner
        $winner = key($game_data[$game_PIN]["round"]["round_info"][$next_round - 1 ]["winner"]);
        $game_data[$game_PIN]["player_data"][$winner]["score"] = $game_data[$game_PIN]["player_data"][$winner]["score"] + 1;
    }

    // If not first to click it, only update own Session round
    else {
        $_SESSION["round"] = $_SESSION["round"] + 1;
        $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] = $game_data[$game_PIN]["player_data"][$_SESSION["username"]]["current_round"] + 1;
    }
}

include "./tpl/components/json/close_game_data.php";
header("refresh:3; url= game.php");
include "tpl/structure/end.php";
?>