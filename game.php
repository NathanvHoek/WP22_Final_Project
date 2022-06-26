<?php
session_start();
include "tpl/head.php"
?>

<?php
// Check whether player is the judge
$player_name = $_SESSION["username"];

$json_file_game = file_get_contents("data/game/game_data.json");
$games = json_decode($json_file_game, true);
$current_game_data = $games[$_SESSION["game_PIN"]];

$judge = $current_game_data["judge"]["current_judge"];


// If player is not the judge, show normal player screen
if ($player_name == $judge){
    include "tpl/judge.php";
}

// If player is the judge, show special judge screen
else {
    include "tpl/player.php";
}

?>


<?php
include "tpl/end.php"
?>