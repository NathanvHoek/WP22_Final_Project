<?php include "header.php" ?>

<div class="container">

    <div class="head">
        <h1>Hey, <?= $player_name ?>, you are a player!</h1>
        <img src="<?= $player_avatar ?>" alt="" id="avatar-button">
    </div>


    <div class="scores">
        <?php
        $json_file = file_get_contents("data/player_data.json");
        $articles = json_decode($json_file, true);
        foreach($articles as $player) {
            $player_name = $player["player_name"];
            $player_avatar = $player["player_avatar"];
            echo "<p class='score'>$player_name</p>";
        }
        ?>
    </div>


    <div class="maker">
        <?php
            $json_file = file_get_contents("data/images.json");
            $articles = json_decode($json_file, true);
            $text_index = array_rand($articles["images"]);
            $text = $articles["current_image"];
            echo "<img src='$text'>";
        ?>
    </div>


    <?php
    $json_file = file_get_contents("data/player_data.json");
    $articles = json_decode($json_file, true);
    $player_name = $articles["player_name"];
    $amount_of_players = count($articles);

    $cards = array();
    $json_file = file_get_contents("data/texts.json");
    $articles = json_decode($json_file, true);

    $count = 0;
    while ($count < 3) {
        $image_index = array_rand($articles["texts"]);
        $image = $articles["texts"][$image_index];
        if (!in_array($image, $cards)) {
            $cards[] = $image;
            $count++;
        }

    }
    ?>

    <div class="card-container">
        <div class="card">
            <p><?= $cards[0]?></p>

        </div>
        <div class="card">
            <p><?= $cards[1]?></p>
        </div>
        <div class="card">
            <p><?= $cards[2]?></p>
        </div>
    </div>

    <?php include "tpl/card-container.php" ?>
</div>