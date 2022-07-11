<?php
$json_file = file_get_contents("data/game/game_data.json");
$game_data = json_decode($json_file, true);

$player_avatar = $game_data[$_SESSION["game_PIN"]]["player_data"][$_SESSION["username"]]["player_avatar"];
$round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
if ($_SESSION["username"] == $game_data[$_SESSION["game_PIN"]]["judge"]["current_judge"]){
    $status = "judge";
} else {
    $status = "player";
}
?>



<div id="dashboard">
    <div id="round-number-div">
        <div id="round-number">
            <p class="no-margin"><?= $round ?></p>
        </div>
    </div>

    <div class="vl"></div>

    <div id="dashboard-player" class="center">

        <div id="player-info">
            <p class="no-margin dashboard-player"><?= $_SESSION["username"] ?></p>
            <p class="no-margin dashboard-player">Status: <?= $status ?></p>
            <p class="no-margin dashboard-player">Score: <?= $game_data[$_SESSION["game_PIN"]]["player_data"][$_SESSION["username"]]["score"] ?></p>
        </div>
        <div id="dashboard-player-avatar"><img src="<?= $player_avatar ?>" alt=""></div>
    </div>

    <div class="vl"></div>

    <div id="other-players">
        <?php
        $players = $game_data[$_SESSION["game_PIN"]]["player_data"];
        foreach ($players as $player => $info){
            if ($player != $_SESSION["username"]){
                $avatar = $info["player_avatar"];
                $score = $info["score"];
                echo "<div class='other-player-avatar' data-tooltip='$player\nScore: $score'><img src='$avatar'></div>";
            }
        }
        ?>
    </div>
</div>