<?php
$json_file = fopen('./data/game/game_data.json', 'w');
fwrite($json_file, json_encode($game_data));
fclose($json_file);
?>