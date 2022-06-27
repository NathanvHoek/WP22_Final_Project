<?php
session_start();
include "tpl/head.php";
?>
    <div class="jumbotron">
        <div class="text-center">
            <img src="media/logo/wdym_logo_ex_sm.png" class="rounded" alt="small logo">
        </div>
    </div>

    <div class="distribute-cards-container">
    <div class="header">
        <h1>Distributing the captions cards...</h1>
    </div>

    <div id="card-animation">
        <?php
        for ($i=1; $i < 7; $i++){
            echo "<div class='cards' id='card$i'>";
            echo "<img src='media/logo/wdym_logo_small.png' alt='card' style='width:100%'>";
            echo "</div>";
        }
        ?>
    </div>


<?php
    $json_file_players = file_get_contents("data/game/game_data.json");
    $games = json_decode($json_file_players, true);

    $status = $games[$_SESSION["game_PIN"]]["status"];
    echo $games[$_SESSION["game_PIN"]]["round"]["round_info"];

    if ($games[$_SESSION["game_PIN"]]["status"] == "inactive") {
        // Change status to active (other players won't overwrite the distribution when their script is called)
        $games[$_SESSION["game_PIN"]]["status"] = "active";

        // Open images file
        $json_file_cap = file_get_contents("data/content/captions.json");
        $captions_json = json_decode($json_file_cap, true);
        $captions = $captions_json["all_captions"];

        // Open player data info
        $players = $games[$_SESSION["game_PIN"]]["player_data"];

        // Create first round
        $games[$_SESSION["game_PIN"]]["round"]["round_info"] =
            ["1" =>
            ["current_image" => "",
                "submitted" => [],
                "winner" => []]];

        // Get array with all captions for first round
        $player_count = count($players);
        $caption_amount = 7;
        $caption_array = array();
//
        $count = 0;
        while ($count < ($player_count * $caption_amount)) {
            $cap_index = array_rand($captions);
            $caption = $captions[$cap_index];
            if (!in_array($caption, $caption_array)) {
                $caption_array[] = $caption;
                $count++;
            }
        }
        // Distribute cards over players
        foreach ($players as $player => $player_data){
            $player_captions = [];
            for ($i = 0; $i < $caption_amount; $i++){
                $player_captions[] = array_pop($caption_array);
            }
            $games[$_SESSION["game_PIN"]]["player_data"][$player]["captions"] = $player_captions;
        }

        // Set judge all_player names
        $game_data = $games[$_SESSION["game_PIN"]];
        $players = $games[$_SESSION["game_PIN"]]["player_data"];

        $all_players = [];
        foreach ($players as $player_name => $value){
            $all_players[] = $player_name;
        }

        $games[$_SESSION["game_PIN"]]["judge"]["all_players"] = $all_players;
        $games[$_SESSION["game_PIN"]]["judge"]["remaining_judges"] = $all_players;
        $games[$_SESSION["game_PIN"]]["judge"]["current_judge"] = array_pop($games[$_SESSION["game_PIN"]]["judge"]["remaining_judges"]);


        // Write to JSON file
        $json_file = fopen('data/game/game_data.json', 'w');
        fwrite($json_file, json_encode($games));
        fclose($json_file);
        header("refresh:3; url= game.php");

        }
?>


<?php
header("refresh:3; url= game.php");
?>

<?php
include "tpl/end.php";
?>