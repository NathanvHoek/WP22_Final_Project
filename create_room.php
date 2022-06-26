
<?php
session_start();
include "tpl/head.php"; ?>

<?php

if (empty($_POST["join-code"])){
    echo "<div class='header-loading'
    <h1>Creating a room...</h1></div>";

    $game_PIN = mt_rand(1111111, 9999999);
    echo "<div class='room-number'>$game_PIN</div>";
    $_SESSION["game_PIN"] = $game_PIN;


    // Read articles
    $json_file = file_get_contents("./data/game/player_data.json");
    $images = json_decode($json_file, true);

    $images[$game_PIN] = [];

    // Save to external file
    $json_file = fopen('./data/game/player_data.json', 'w');
    fwrite($json_file, json_encode($images));
    fclose($json_file);
}

else {
    echo "<div class='header-loading'
    <h1>Joining a room...</h1></div>";
    $_SESSION["game_PIN"] = $_POST["join-code"];
}

?>

<div class="loader"></div>



<?php
header("refresh:2; url= ./lobby.php");
include "tpl/end.php";
?>
