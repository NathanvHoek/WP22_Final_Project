<div class="judge-main-image">
    <?php
    $json_file = file_get_contents("data/images.json");
    $articles = json_decode($json_file, true);
    $text_index = array_rand($articles["images"]);
    $text = $articles["current_image"];
    echo "<img src='$text'>";
    ?>
</div>