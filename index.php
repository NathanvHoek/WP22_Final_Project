<?php
$title = "What do you meme?";
include "tpl/head.php";
include "tpl/header.php";
?>

    <!--Start or join the game-->


    <div>
        <form class="form-inline text-center" action="./create_room.php" method="post">
            <a href="create_room.php"><button type="button" id="start-game" class="btn btn-warning btn-lg" >Start new game</button></a>
            <h2 id="or_text">OR</h2>
            <div class="form-group">
                <input type="number" name="join-code" id="join-code" class="form-control" placeholder="Enter a room code" required>
                <div class="input-group-btn">
                    <button type="submit" id="pin-join-button" class="inactive btn btn-info" disabled>Join</button>
              </div>
            </div>
        </form>
    </div>


    <!--Explanation-->
    <div class="container-fluid"
    <div class="row">
        <div class="col-sm-7">
            <h2>About The Game</h2>
            <p>What Do You Meme is the party game for meme lovers! Find out who will be crowned
                Meme Queen/King by competing with friends (or family if you’re brave) to match photo cards with caption cards,
                creating your own outrageously funny meme combinations. It’s the perfect excuse to call up the crew,
                and get everyone together for guaranteed laughs.</p>
        </div>
    </div>
    </div>
    <div class="container-fluid bg-grey"
    <div class="row">
        <div class="col-sm-7">
            <h2>How to play</h2>
            <ul>
                <li>A game of What Do You Meme requires at least 3 players.</li>
                <li>Cards are shuffled and distributed among the players.</li>
                <li>A designated photo card is chosen for the round, and shown on the screen, and everyone except the judge chooses
                    a caption card to pair with the photo card. One player will be assigned as judge.</li>
                <li>The player whose card is picked by the judge receives 1 point!</li>
                <li>The player with the most points after all the rounds wins the game!</li>
            </ul>
        </div>
    </div>
    </div>


<?php
include "tpl/end.php"
?>