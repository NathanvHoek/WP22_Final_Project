<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waiting room</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js"></script>
</head>

<body>

<div class="container">
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

//sleep(2);

//header("Location: ../game.php");
//die(); ?>

</div>


</body>
</html>