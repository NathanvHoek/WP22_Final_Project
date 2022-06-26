<?php
session_start();
include "tpl/head.php";
include "tpl/header.php";
?>

<div class="container">
    <h1>Distributing the captions cards...</h1>

    <?php
    $json_file_players = file_get_contents("data/game/game_data.json");
    $games = json_decode($json_file_players, true);

    $status = $games[$_SESSION["game_PIN"]]["status"];

    if ($games[$_SESSION["game_PIN"]]["status"] == "inactive") {
//        echo "Changing the cards";
        // Change status to active (other players won't overwrite the distribution when their script is called)
        $games[$_SESSION["game_PIN"]]["status"] = "active";

        // Open images file
        $json_file_cap = file_get_contents("data/content/captions.json");
        $captions_json = json_decode($json_file_cap, true);
        $captions = $captions_json["all_captions"];

        // Open player data info
        $players = $games[$_SESSION["game_PIN"]]["player_data"];

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
            print_r($games[$_SESSION["game_PIN"]]["player_data"][$player]["captions"]);
            $games[$_SESSION["game_PIN"]]["player_data"][$player]["captions"] = $player_captions;
        }

//        print_r($players);

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

</div>
<?php
header("refresh:3; url= game.php");
?>

<?php
include "tpl/end.php";
?>