<?php
session_start();
include "start.php";?>

    <div class="jumbotron">
        <div class="text-center">
            <img src="../media/logo/wdym_logo_ex_sm.png" class="rounded" alt="small logo">
        </div>
    </div>

<?php
// General procedures
$json_file = file_get_contents("../data/game/game_data.json");
$game_data = json_decode($json_file, true);
$game_PIN = $_SESSION["game_PIN"];

if (!$game_data[$game_PIN]["current_image"] == "clicked"){
    $game_data[$game_PIN]["round"]["number"]++;
    $_SESSION["round"] = $game_data[$game_PIN]["round"]["number"];
    $new_round = $game_data[$game_PIN]["round"]["number"];
    $game_data[$game_PIN]["round"]["round_info"][$_SESSION["round"]] =
        ["current_image" => "",
            "submitted" => [],
            "winner" => []];

    $game_data[$game_PIN]["current_image"] = "clicked";
    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);
    echo "<h1>Let's goooooo to round number $new_round</h1>";
    sleep(0.5);
    $json_file = file_get_contents("../data/game/game_data.json");
    $game_data = json_decode($json_file, true);
    $game_data[$game_PIN]["current_image"] = "unclicked";
    $json_file = fopen('../data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);

    include "../scripts/select_judge.php";

} else {
    echo "Yayyy";
    $game_data[$game_PIN]["round"]["number"]++;
}

header("refresh:1; url= ../game.php");

include "end.php";
?>