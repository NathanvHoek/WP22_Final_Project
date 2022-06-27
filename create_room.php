
<?php
session_start();

include "tpl/head.php"; ?>

<div class="jumbotron">
    <div class="text-center">
        <img src="media/logo/wdym_logo_ex_sm.png" class="rounded" alt="small logo">
    </div>
</div>

<?php
if (empty($_POST["join-code"])){
//<<<<<<< HEAD
    echo "<div class='header'>";
    echo "<h1>Creating a new room</h1>";
    echo "</div>";
//=======
    echo "<div class='header-loading'
    <h1>Creating a room...</h1></div>";
//>>>>>>> 457873aa3932af410666d1803e554a43154d4acd

    // Create random room number and assign to session variable
    $game_PIN = mt_rand(1111111, 9999999);
//<<<<<<< HEAD
//=======
    echo "<div class='room-number'>$game_PIN</div>";
//>>>>>>> 457873aa3932af410666d1803e554a43154d4acd
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
            "number" => 1,
            "round_info" => []
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
    echo "<div class='header-loading'
    <h1>Joining a room...</h1></div>";
    $_SESSION["game_PIN"] = $_POST["join-code"];
}

?>

<!--<<<<<<< HEAD-->
<!--=======-->
<div class="loader"></div>



<!-- 457873aa3932af410666d1803e554a43154d4acd-->
<?php
header("refresh:2; url= lobby.php");
include "tpl/end.php";
?>
