<?php
session_start();
include "tpl/structure/start.php";
?>
    <div class="jumbotron">
        <div class="text-center">
            <img src="media/logo/wdym_logo_ex_sm.png" class="rounded" alt="small logo">
        </div>
    </div>

    <div class="distribute-cards-container">
        <div class="header-loading">
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
    </div>


<?php
// Process and start new game
    include "./tpl/components/json/open_game_data.php";
    $status = $game_data[$_SESSION["game_PIN"]]["status"];
    $key = array_keys($game_data[$_SESSION["game_PIN"]]["status"])[0];

    if ($game_data[$_SESSION["game_PIN"]]["status"][$key] == "continued") {

        // Change status to active (other players won't overwrite the distribution when their script is called)
        $game_data[$_SESSION["game_PIN"]]["status"] = "active";

        // Set total rounds
        $total_rounds = $_POST["timesJudge"] * count($game_data[$_SESSION["game_PIN"]]["player_data"]);
        $game_data[$_SESSION["game_PIN"]]["round"]["max_rounds"] = $total_rounds;

        // Create first round
        $game_data[$_SESSION["game_PIN"]]["round"]["round_info"] =
            ["1" =>
            ["round_status" => "proceeding",
                "current_image" => "",
                "submitted" => [],
                "winner" => []]];

        // Open file with all captions
        $json_file_cap = file_get_contents("data/content/captions.json");
        $captions_json = json_decode($json_file_cap, true);
        $captions = $captions_json["all_captions"];

        // Count amount of players and therefore amount of captions to be retrieved
        $players = $game_data[$_SESSION["game_PIN"]]["player_data"];
        $player_count = count($players);
        $caption_amount = 7; // Fixed amount of cards
        $caption_array = array();

        // Get an array with all captions randomly selected
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
            $game_data[$_SESSION["game_PIN"]]["player_data"][$player]["captions"] = $player_captions;
        }

        // Set judges initial values
        $all_players = array_keys($players);
        $game_data[$_SESSION["game_PIN"]]["judge"]["all_players"] = $all_players;
        $game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"] = $all_players;
        $game_data[$_SESSION["game_PIN"]]["judge"]["current_judge"] = array_pop($game_data[$_SESSION["game_PIN"]]["judge"]["remaining_judges"]);

        // Write to JSON file
        include "./tpl/components/json/close_game_data.php";
        header("refresh:3; url= game.php");
    }

    $_SESSION["round"] = 1;

header("refresh:3; url= game.php");

include "tpl/structure/end.php";
?>