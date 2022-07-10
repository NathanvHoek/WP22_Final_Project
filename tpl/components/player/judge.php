 <div class="head">
     <h1 class="header">Hey, <?= $player_name ?>, you are the judge!</h1>
 </div>


 <div id="choose-main-image">
     <div class="judge-images">
         <?php
         $json_file = file_get_contents("data/content/images.json");
         $articles = json_decode($json_file, true);
         foreach ($articles["images"] as $img) {
             echo "<img src=media/img/$img class='choose-picture'>";
         }
         ?>
     </div>

     <form id="choose-main-image">
         <input type="text" id="game_PIN" name="game_PIN" value="<?= $_SESSION["game_PIN"] ?>" hidden>
         <input type="text" id="main-image" name="main-image" hidden>
         <div id="choice">
             <button id="choose-image" class="btn btn-primary" name="choose-image" disabled>Choose image</button>
         </div>

     </form>

 </div>

 <?php include "meme-card.php" ?>

 <form id="choose-winner">
     <input type="text" id="winner-caption" hidden>
     <input type="text" id="winner-name" hidden>
     <input type="text" id="game_pin" value="<?= $_SESSION["game_PIN"] ?>" hidden>
     <button id="winner-caption-btn" class="btn btn-success">This is the winner</button>
 </form>

 <div id="selected-captions-overview">

     <?php
     $json_file = file_get_contents("./data/game/game_data.json");
     $game_data = json_decode($json_file, true);

     $round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
     $selected_captions = $game_data[$_SESSION["game_PIN"]]["round"]["round_info"][$round]["submitted"];
     $all_players = $game_data[$_SESSION["game_PIN"]]["player_data"];

     if (count($selected_captions) == count($all_players)-1) {
         echo "<div id='selected-update'><p>All players have submitted their captions, now you decide which one is the funniest</p></div>";
         echo "<div id='all-captions-final'>";
     } else {
         echo "<div id='selected-update'><p>Not all player have submitted their captions</p></div>";
         echo "<div id='all-captions-streaming'>";
     }

     foreach ($selected_captions as $player => $info){
         $caption = $info["caption"];
         echo "<div class='scene scene--card'>";
         echo    "<span onclick='flipCard()' class='flip-card'>";
         echo        "<div class='flip-card'>";
         echo            "<div class='card__face card__face--front'>";
         echo                "<img src='media/logo/wdym_logo_small.png' alt='card_image' style='width:100px;height:100px;'>";
         echo            "</div>";
         echo            "<div class='card__face card__face--back'><p>$caption</p><p hidden>$player</p></div>";
         echo        "</div>";
         echo    "</span>";
         echo "</div>";

     }
     echo "</div>";

     ?>
 </div>

 <?php include "show_winner.php";?>
