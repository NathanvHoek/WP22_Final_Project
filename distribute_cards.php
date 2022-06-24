<?php
include "tpl/head.php";
include "tpl/header.php";
?>

<div class="container">
    <h1>Distributing the captions cards...</h1>

    <?php
// Open player data info
$json_file_players = file_get_contents("data/player_data.json");
$players = json_decode($json_file_players, true);

// Open images file
$json_file_cap = file_get_contents("data/captions.json");
$captions_json = json_decode($json_file_cap, true);
$captions = $captions_json["texts"];
//print_r($captions_json);

// Get array with all captions for first round
$player_count = count($players);
$caption_amount = 7;
$caption_array = array();

$count = 0;
while ($count < ($player_count * $caption_amount)) {
    $cap_index = array_rand($captions);
    $caption = $captions[$cap_index];
    if (!in_array($caption, $caption_array)) {
        $caption_array[] = $caption;
        $count++;
    }
}


// Distribute cards over players
foreach ($players as $key => $value){
//    print_r($key);
//    print_r($value);
    $player_cap = [];
    for ($i = 0; $i < $caption_amount; $i++){
        $player_cap[] = array_pop($caption_array);
    }

    $players[$key]["player_images"] = array_replace($players[$key]["player_images"], $player_cap);
}

// Write to JSON file
$json_file = fopen('data/player_data.json', 'w');
fwrite($json_file, json_encode($players));
fclose($json_file);

header("refresh:3; url= ./game.php");
?>

</div>


<?php
include "tpl/end.php";
?>