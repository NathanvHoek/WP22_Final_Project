<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            $json_file = file_get_contents("data/images.json");
            $articles = json_decode($json_file, true);
            $text_index = array_rand($articles["images"]);
            $text = $articles["current_image"];
            echo "<img src='$text'>";
        ?>

        <?php
            $json_file = file_get_contents("data/player_data.json");
            $articles = json_decode($json_file, true);
            $player_name = $articles["player_name"];
            $amount_of_players = count($articles)
        ?>
    </div>
    <?php
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
</div>


</body>
</html>