<?php
$json_file = file_get_contents("./data/game/game_data.json");
$game_data = json_decode($json_file, true);
?>