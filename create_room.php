<?php
session_start();
include "./tpl/structure/start.php";
include "./tpl/components/header.php";

if (empty($_POST["join-code"])){
    echo "<div class='header-loading'>
                <h1>Creating a room...</h1>
          </div>";

    // Create random room number and assign to session variable
    $game_PIN = mt_rand(1111111, 9999999);
    $_SESSION["game_PIN"] = $game_PIN;

    // Open data file and write basic game structure to the file
    $json_file = file_get_contents("./data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    $game_data[$game_PIN] = [
        "status" => ["" => "inactive"],
        "player_data" => [],
        "judge" => [
            "all_players" => [],
            "remaining_judges" => [],
            "current_judge" => ""
        ],
        "round" => [
            "number" => 1,
            "max_rounds" => 0,
            "round_info" => []
        ]
    ];

    // Save to external file
    $json_file = fopen('./data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);
}

else {
    $game_PIN = $_POST["join-code"];
    echo "<div class='header-loading'>
                <h1>Joining room $game_PIN...</h1>
          </div>";

    $_SESSION["game_PIN"] = $game_PIN;
}
?>

<div class="loader"></div>

<?php
header("refresh:3; url= ./lobby.php");
include "./tpl/structure/end.php";
?>
