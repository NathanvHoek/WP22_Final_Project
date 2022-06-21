<?php
// Open player data info
$json_file_players = file_get_contents("data/player_data.json");
$players = json_decode($json_file_players, true);

// Open images file
$json_file_img = file_get_contents("data/images.json");
$articles = json_decode($json_file_img, true);


$player_count = count($players);
$card_starting_nr = 2;
$cards = array();

$count = 0;
while ($count < $player_count * $card_starting_nr) {
    $image_index = array_rand($articles["images"]);
    $image = $articles["images"][$image_index];
    if (!in_array($image, $cards)) {
        $cards[] = $image;
        $count++;
    }

}
//print_r($cards);
foreach ($players as $key => $value){
//    print_r($player);
    print_r($key);
    print_r($value);
    $player_img = [];
    for ($i = 0; $i < $card_starting_nr; $i++){
        $player_img[] = array_pop($cards);
    }
    $players[$key]["player_images"] = array_replace($players[$key]["player_images"], $player_img);
}

$json_file = fopen('data/player_data.json', 'w');
fwrite($json_file, json_encode($players));
fclose($json_file);

header("Location: ../game.php");
die();
