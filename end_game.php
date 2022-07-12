<?php
session_start();
include "tpl/structure/start.php";
include "tpl/components/header.php";
include "./tpl/components/json/open_game_data.php";

echo "<div class='center-vl'>";
echo "<div class='header-loading'><h2>An overview of all the masterpieces that have been produced by all of you guys <3</h2></div>";
echo "<div class='memes-overview'>";
$all_rounds = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"];
foreach ($all_rounds as $round => $round_info){
    $main_image = $round_info["current_image"];
    $winner_name = key($round_info["winner"]);
    $winner_caption = $round_info["winner"][$winner_name];
    echo "<div class='final-winners'><h2>Round $round</h2><p>$winner_name</p><img src='$main_image' alt=''><p>$winner_caption</p></div>";
}
echo "</div>";
echo "</div>";
?>


<?php
include "tpl/structure/end.php"
?>
