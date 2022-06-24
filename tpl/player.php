<?php include "header.php" ?>

<div class="container">

    <div class="head">
        <h1>Hey, <?= $player_name ?>, you are a player!</h1>
        <img src="<?= $player_avatar ?>" alt="" id="avatar-button">
    </div>


<!--    <div class="scores">-->
<!--        --><?php
//        $json_file = file_get_contents("data/player_data.json");
//        $articles = json_decode($json_file, true);
//        foreach($articles as $player) {
//            $player_name = $player["player_name"];
//            $player_avatar = $player["player_avatar"];
//            echo "<p class='score'>$player_name</p>";
//        }
//        ?>
<!--    </div>-->


    <div class="maker">
        <div>
            <?php
            $json_file = file_get_contents("data/images.json");
            $articles = json_decode($json_file, true);
            $text_index = array_rand($articles["images"]);
            $text = $articles["current_image"];
            echo "<img src='$text'>";
            ?>
            <div>
                <p id="selected-caption"></p>
            </div>
        </div>

        <div>
            <form>
                <input type="text" id="selected-caption-named" name="name" value="<?= $_SESSION["username"] ?>" hidden>
                <input type="text" id="selected-caption-input" name="caption" hidden>
                <div id="send-image">Send this gorgeous piece of artwork</div>
            </form>

        </div>
    </div>


    <?php

    // Get cards from player
    $json_file = file_get_contents("data/player_data.json");
    $players = json_decode($json_file, true);
    $current_user = $_SESSION["username"];

    $cards = array();
    foreach ($players as $player){
        if ($player["player_name"] == $current_user) {
            $cards = $player["player_images"];
            break;
        }
    }

    ?>

    <div class="card-container">
        <?php
        foreach ($cards as $card) {
            echo "<div class='card'>
                <p>$card</p>
              </div>";
        }
        ?>
    </div>



    <?php include "tpl/card-container.php" ?>
</div>