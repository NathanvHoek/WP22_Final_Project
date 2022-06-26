<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</head>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-left">
                <li ><a href="../index_test.php">HOME</a></li>
                <li><a href="#services">ABOUT US</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">



    <div class="head">
        <h1>Hey, <?= $player_name ?>, you are the judge!</h1>
        <img src="<?= $player_avatar ?>" alt="" id="avatar-button">
    </div>

<!--    <div class="scores" hidden>-->
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

    <div id="choose-main-image">
        <div class="judge-images">
            <?php
            $json_file = file_get_contents("data/images.json");
            $articles = json_decode($json_file, true);
            foreach ($articles["images"] as $img) {
                echo "<img src=media/img/$img class='choose-picture'>";
            }
            ?>
        </div>
        <div>
            You choose:
            Are you sure?
        </div>

        <form id="choose-main-image">
            <input type="text" id="main-image" name="main-image" hidden>
            <button type="submit" id="choose-image" name="choose-image">Choose image</button>
        </form>
    </div>

    <div id="judge-overview">
        <?php include "meme-card.php" ?>
        <?php include "card-container.php" ?>
    </div>

</div>