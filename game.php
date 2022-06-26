<?php
session_start();
include "tpl/head.php"
?>

<?php
// Check whether player is the judge
$player_name = $_SESSION["username"];
$json_file_players = file_get_contents("data/player_data.json");
$players = json_decode($json_file_players, true);

foreach ($players as $player) {
    if ($player["player_name"] == $player_name) {
        $this_player = $player;
        break;
        }
}

$is_judge = true;
$player_name = $this_player["player_name"];
$player_avatar = $this_player["player_avatar"];
$player_judge = $this_player["is_judge"];
$player_images = $this_player["player_images"];

// If player is not the judge, show normal player screen
if (!$is_judge){
    echo $player_name;
    echo $player_avatar;
    echo $player_judge;
    echo $player_images;
    include "tpl/player.php";

}

// If player is the judge, show special judge screen
else {
    include "tpl/judge.php";
    echo $player_name;
    echo $player_avatar;
    echo $player_judge;
    echo $player_images;
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