<?php
include "./tpl/components/dashboard.php" ;
    $json_file = file_get_contents("data/content/images.json");
    $images = json_decode($json_file, true);
?>

<!-- Judge sees this div first -->
<div id="choose-image-div" class="center">
    <div id="choose-main-img">
        <ul id="choose-main-image-btns" class="center">
            <li class="left-btn" data-tab-target="#judge-img-container">Images</li>
            <li class="mid-btn" data-tab-target="#judge-gif-container">GIF</li>
            <li class="right-btn" data-tab-target="#judge-upload-container">Upload image</li>
        </ul>

        <!-- Tab with images -->
        <div class="judge-images active-div" id="judge-img-container" data-tab-content>
            <div class="scroll">
                <?php
                $image_dir = "./media/img/*";
                foreach (glob($image_dir) as $img) {
                    echo "<div class='image-container'><img src=$img class='choose-picture'></div>";
                }
                ?>
            </div>
        </div>

        <!-- Tab with GIFs -->
        <div class="judge-images" id="judge-gif-container" data-tab-content>
            <div class="scroll">
                <?php
                $gif_dir = "./media/gif/*";
                foreach (glob($gif_dir) as $gif) {
                    echo "<div class='image-container'><img src=$gif class='choose-picture'></div>";
                }
                ?>
            </div>
        </div>

        <!-- Tab with upload own picture -->
        <div class="judge-images" id="judge-upload-container" data-tab-content>
            <form id="upload-image" class="center" enctype="multipart/form-data">
                <div class='preview image-container'>
                    <img class="choose-picture" src="" id="img" width="100" height="100">
                </div>
                <div >
                    <input type="file" id="file" name="file" />
                    <input type="button" class="button" value="Upload" id="but_upload">
                </div>
            </form>
        </div>


        <form id="choose-main-image">
            <input type="text" id="game_PIN" name="game_PIN" value="<?= $_SESSION["game_PIN"] ?>" hidden>
            <input type="text" id="main-image" name="main-image" hidden>
            <div id="choice">
                <button id="choose-image" class="btn btn-primary" name="choose-image" disabled>Choose image</button>
            </div>
        </form>

    </div>
</div>

<?php
include "tpl/components/main-image.php";
?>

<form id="choose-winner">
    <input type="text" id="winner-caption" hidden>
    <input type="text" id="winner-name" hidden>
    <input type="text" id="game_pin" value="<?= $_SESSION["game_PIN"] ?>" hidden>
    <button id="winner-caption-btn" class="btn btn-success">This is the winner</button>
</form>


<div id="selected-captions-overview">
     <?php
//     $json_file = file_get_contents("./data/game/game_data.json");
//     $game_data = json_decode($json_file, true);
//
//     $round = $game_data[$_SESSION["game_PIN"]]["round"]["number"];
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
         echo    "<span onclick='flipCard()' class='flip-card judge-cards'>";
         echo        "<div class='flip-card'>";
         echo            "<div class='card__face card__face--front judge-cards'>";
         echo                "<img src='media/logo/wdym_logo_small.png' alt='card_image' style='width:100px;height:100px;'>";
         echo            "</div>";
         echo            "<div onclick='selectWinner()' class='card__face card__face--back'><p>$caption</p><p hidden>$player</p></div>";
         echo        "</div>";
         echo    "</span>";
         echo "</div>";

     }
     echo "</div>";

     ?>
 </div>

 <?php include "tpl/components/show_winner.php";?>
