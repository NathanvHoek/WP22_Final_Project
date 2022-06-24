<?php
include "tpl/head.php"
?>

<?php
if(isset($_POST['join-the-game'])){
header("Location: http://www.example.com/page.php");
exit;
}
?>

<div class="container">
    <div class="start-header">
        <h1>WHAT DO YOU MEME?!</h1>
    </div>

    <div class="start-buttons">
        <button id="start-game"> <a href="create_room.php">Start a new game</a></button>
        <p>------ OR -----</p>
        <form action="create_room.php" method="post">
            <label for="join-code">Join a game</label>
            <input type="number" name="join-code" id="join-code" placeholder="Enter you code here">
            <button type="submit" id="pin-join-button" class="inactive">Join</button>
        </form>


    </div>

    <button><a href="index_test.php">Game explanation</a></button>
</div>


<?php
include "tpl/end.php"
?>
