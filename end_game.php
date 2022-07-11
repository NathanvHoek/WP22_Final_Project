<?php
session_start();
include "tpl/structure/start.php";
include "tpl/components/header.php";
?>


<?php
$json_file = file_get_contents("./data/game/game_data.json");
$game_data = json_decode($json_file, true);

$all_players = $game_data[$_SESSION["game_PIN"]]["player_data"];
$highest_score = 0;
$winner = [];
foreach ($all_players as $player => $info){
    if ($info["score"] >= $highest_score){
        $winner[$info["score"]][] = $player;
    }
}

$high_score = max(array_keys($winner));


if (count($winner[$high_score]) === 1) {
    $ultimate_winner = $winner[$high_score][0];
    $winner_avatar = $game_data[$_SESSION["game_PIN"]]["player_data"][$ultimate_winner]["player_avatar"];
    $winner_score = $game_data[$_SESSION["game_PIN"]]["player_data"][$ultimate_winner]["score"];
    echo "<h2>The ultimate grandmaster of the meme game is</h2>";
    echo "<div class='winner-div'>
            <img class='winner-avatar' src='$winner_avatar' alt=''>
            <p>$ultimate_winner</p>
            <p>$winner_score</p>
          </div>";

} else if (count($winner) > 1) {
    $winner_count = count($winner);
    echo "<h2>You guys are on fire! We have $winner_count winners!</h2>";
    foreach ($winner as $name => $avatar){
        echo "<div><img src='$avatar' alt=''><p>$name</p></div>";
    }
}
?>
<h2>An overview of all the masterpieces that have been produced</h2>

<?php
echo "<div class='memes-overview'>";
$all_rounds = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"];
foreach ($all_rounds as $round => $round_info){
    $main_image = $round_info["current_image"];
    $winner_name = key($round_info["winner"]);
    $winner_caption = $round_info["winner"][$winner_name];
    echo "<div class='final-winners'><h2>Round $round</h2><p>$winner_name</p><img src='$main_image' alt=''><p>$winner_caption</p></div>";
}
echo "</div>";
?>


<?php
include "tpl/structure/end.php"
?>
