<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">
    <div class="head">
        <h1>Pick the best image</h1>
        <h2>Choose an image</h2>
    </div>
    <?php echo $_SESSION["username"];?>
    <div class="scores">
        <?php
        $json_file = file_get_contents("data/player_data.json");
        $articles = json_decode($json_file, true);
        foreach($articles as $player) {
            $player_name = $player["player_name"];
            echo "<p class='score'>$player_name</p>";
        }
        ?>
    </div>

    <div class="maker">
        <?php
            $cards = array();
            $json_file = file_get_contents("data/images.json");
            $articles = json_decode($json_file, true);

            $count = 0;
            while ($count < 3) {
                $image_index = array_rand($articles["images"]);
                $image = $articles["images"][$image_index];
                if (!in_array($image, $cards)) {
                    $cards[] = $image;
                    $count++;
            }

        }
        ?>

        <?php
            $json_file = file_get_contents("data/images.json");
            $articles = json_decode($json_file, true);
            $text_index = array_rand($articles["images"]);
            $text = $articles["images"][$text_index];
            echo "<img src='media/img/$text'>";
        ?>

        <?php
            $json_file = file_get_contents("data/player_data.json");
            $articles = json_decode($json_file, true);
            $player_name = $articles["player_name"];
            $amount_of_players = count($articles)
        ?>
    </div>

    <div class="card-container">
        <div class="card">
            <img src="media/img/<?=$cards[0]?>" alt="no">
        </div>
        <div class="card">
            <img src="media/img/<?=$cards[1]?>" alt="no">
        </div>
        <div class="card">
            <img src="media/img/<?=$cards[2]?>" alt="no">
        </div>
    </div>
</div>


</body>
</html>