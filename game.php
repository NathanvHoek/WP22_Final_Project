<?php
session_start();
include "tpl/head.php"
?>
    <div class="jumbotron">
        <div class="text-center">
            <img src="media/logo/wdym_logo_ex_sm.png" class="rounded" alt="small logo">
        </div>
    </div>

<?php
// Check whether player is the judge
$player_name = $_SESSION["username"];

$json_file_game = file_get_contents("data/game/game_data.json");
$games = json_decode($json_file_game, true);
$current_game_data = $games[$_SESSION["game_PIN"]];

$judge = $current_game_data["judge"]["current_judge"];


// If player is not the judge, show normal player screen
if ($player_name == $judge){
    include "tpl/judge.php";
}


// If player is the judge, show special judge screen
else {
    include "tpl/player.php";
}

?>

    <script>
        window.onbeforeunload = function(){
            return 'Are you sure you want to leave?';
        };
    </script>

<?php
include "tpl/end.php"
?>