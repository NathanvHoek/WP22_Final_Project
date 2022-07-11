<?php
session_start();
include "./tpl/structure/start.php";
include "./tpl/components/header.php";
?>

<?php
// Check whether player is the judge
$player_name = $_SESSION["username"];

$json_file_game = file_get_contents("data/game/game_data.json");
$games = json_decode($json_file_game, true);
$current_game_data = $games[$_SESSION["game_PIN"]];

$judge = $current_game_data["judge"]["current_judge"];

if ($judge == $player_name){
    include "./tpl/components/player/judge.php";
} else {
    include "./tpl/components/player/player.php";
}
?>

<?php
include "./tpl/components/data.php";
include "./tpl/structure/end.php";
?>