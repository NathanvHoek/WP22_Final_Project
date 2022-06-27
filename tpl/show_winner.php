<div id="show-winner">
    <?php
$json_file = file_get_contents("data/game/game_data.json");
$game_data = json_decode($json_file, true);

$round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
$winner = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["winner"];
$winner_name = key($winner);
$winner_caption = $winner[$winner_name];
$image = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["current_image"];
echo "<p>The winner is $winner_name</p>";
echo "<img src='$image'>";
echo "<p>$winner_caption</p>"
?>
    <form id="next-round" action="tpl/next_round.php" method="post">
        <button type="submit" class="btn btn-primary">Go to next round</button></a>
    </form>

</div>


