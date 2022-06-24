<?php
include "tpl/head.php"
?>

<div class="container">
    <div class="start-header">
        <h1>WHAT DO YOU MEME?!</h1>
    </div>

    <div class="start-buttons">
        <button id="start-game"> <a href="create_room.php">Start a new game</a></button>
        <p>------ OR -----</p>
        <label for="join-code">Join a game</label>
        <input type="text" name="join-code" id="join-code" placeholder="Enter you code here">
        <button>Join</button>
    </div>

    <button><a href="index_test.php">Game explanation</a></button>
</div>

<script src="js/main.js"></script>

<?php
include "tpl/end.php"
?>
