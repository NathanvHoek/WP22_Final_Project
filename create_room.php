
<?php
session_start();

include "tpl/head.php"; ?>

<?php
if (empty($_POST["join-code"])){

    echo "<h1>Create a room</h1>";

    // Create random room number and assign to session variable
    $game_PIN = mt_rand(1111111, 9999999);
    echo $game_PIN;
    $_SESSION["game_PIN"] = $game_PIN;


    // Open data file and write basic game structure to the file
    $json_file = file_get_contents("data/game/game_data.json");
    $game_data = json_decode($json_file, true);

    $game_data[$game_PIN] = [
        "status" => "inactive",
        "player_data" => [],
        "judge" => [
            "all_players" => [],
            "remaining_judges" => [],
            "current_judge" => ""
        ],
        "round" => [
            "status" => "in progress",
            "number" => 0,
        ],
        "current_image" => "",
        "caption_cards_submitted" => []
    ];

    // Save to external file
    $json_file = fopen('./data/game/game_data.json', 'w');
    fwrite($json_file, json_encode($game_data));
    fclose($json_file);
}

else {
    echo "<h1>Join a room</h1>";
    $_SESSION["game_PIN"] = $_POST["join-code"];
}

?>

<?php
header("refresh:2; url= ./lobby.php");
include "tpl/end.php";
?>
