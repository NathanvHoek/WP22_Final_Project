
<?php
session_start();
include "tpl/head.php"; ?>

<h1>Create a room</h1>

<?php
$game_PIN = mt_rand(1111111, 9999999);
echo $game_PIN;
$_SESSION["game_PIN"] = $game_PIN;


// Read articles
$json_file = file_get_contents("./data/player_data.json");
$images = json_decode($json_file, true);

$images[] = [$game_PIN => []];

// Save to external file
$json_file = fopen('./data/player_data.json', 'w');
fwrite($json_file, json_encode($images));
fclose($json_file);
?>

<?php
header("refresh:2; url= ./lobby.php");
include "tpl/end.php";
?>
