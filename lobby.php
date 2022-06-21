<?php
session_start();
$_SESSION["username"] = $_POST["username"]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waiting room</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js"></script>
</head>

<body>
<!--Add a new player-->
<?php
if (isset($_POST['join-game']) && $_POST['username'] !== "" && $_POST['acatar-src'] !== "") {
    // Read articles
    $json_file = file_get_contents("data/player_data.json");
    $players = json_decode($json_file, true);
    $player_one = $players[0];


    $players[] = [
        'player_id' => 4,
        'player_name' => $_POST["username"],
        "player_avatar" => $_POST["avatar-src"],
        "player_dealer" => false,
        "player_imager" => false,
        'player_images' => [],
    ];

    // Save to external file
    $json_file = fopen('data/player_data.json', 'w');
    fwrite($json_file, json_encode($players));
    fclose($json_file);
}
//    // Redirect to homepage
//    header("Location: ../lobby.php");
//    die();
//}
?>


<div class="container">
    <div class="head">
        <h1>These are all the players: Welcome <?php echo $_SESSION["username"];?></h1>
    </div>

    <div class="add-player">
        <div id="welcome-player">
            Hello there
        </div>
        <div id="player-form">
            <form action="" method="post">
                <div id="choose-avatar-btn">
                    <img src="media/avatars/no_avatar.jpeg" alt="" id="avatar">
                </div>
                <input type="text" id="avatar-input" name="avatar-src" hidden>
                <input type="text" name="username" id="username-input" placeholder="Type your username here">
                <!--            <button id="avatar-button">Choose avatar</button>-->
                <button type="submit" id="join-game" name="join-game">Join the game!</button>
            </form>
        </div>

    </div>
    <div class="avatar-select" id="avatar-overview">
        <?php
        $json_file = file_get_contents("data/images.json");
        $images_json = json_decode($json_file, true);
        $images_array = $images_json["images"];
        for ($i=0; $i < count($images_array); $i++){
            $image = $images_array[$i];
            echo "<img class='small-avatars' src='media/img/$image'>";
        }
        ?>
    </div>


    <div class="player-overview">
        <?php
        $json_file = file_get_contents("data/player_data.json");
        $articles = json_decode($json_file, true);
        $player_name = $articles["player_name"];
        $amount_of_players = count($articles);
        for ($i=0; $i < $amount_of_players; $i++) {
            $player = $articles[$i]["player_name"];
            $avatar = $articles[$i]["player_avatar"];
            echo "<div class='player-div'><img src='$avatar' class='player-icon'></div><p>$player</p>";
        }
        ?>

        <form action="scripts/distribute_cards.php" method="POST">
            <input type="hidden" name="id" value="%s" />
            <button type="submit" id="start-game" class="btn btn-light article_edit"><a href="game.php"> Start the game</a></button>
        </form>


    </div>

</div>


</body>
</html>