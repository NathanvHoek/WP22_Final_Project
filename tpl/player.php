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
        <div id="chosen-image">
            <?php
            $json_file = file_get_contents("data/game/game_data.json");
            $game_data = json_decode($json_file, true);
            $current_image = $game_data[$_SESSION["game_PIN"]]["current_image"];

            if (empty($current_image)){
                echo "Wait for the judge to choose a picture";
            } else {
                echo "<img src='$current_image'>";
            }


            ?>

        </div>
        <div>
            <p id="selected-caption"></p>
        </div>
        <div>
            <form>
                <input type="text" id="selected-caption-named" name="name" value="<?= $_SESSION["username"] ?>" hidden>
                <input type="text" id="selected-caption-code" name="name" value="<?= $_SESSION["game_PIN"] ?>" hidden>
                <input type="text" id="selected-caption-input" name="caption" hidden>
                <div id="send-image">Send this gorgeous piece of artwork</div>
            </form>

        </div>
    </div>

    <?php include "tpl/card-container.php" ?>
    <div id="selected-captions-overview">
        <p>Hello</p>
        <?php
        $selected_captions = $game_data[$_SESSION["game_PIN"]]["caption_cards_submitted"];
        foreach ($selected_captions as $player => $caption){
            echo $caption;
        }
        ?>
    </div>

</div>