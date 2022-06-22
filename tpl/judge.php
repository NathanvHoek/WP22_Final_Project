
<?php
if (isset($_POST['choose-image'])) {
    // Read articles
    $json_file = file_get_contents("data/images.json");
    $images = json_decode($json_file, true);

    $images["current_image"] = $_POST["main-image"];

    // Save to external file
    $json_file = fopen('data/images.json', 'w');
    fwrite($json_file, json_encode($images));
    fclose($json_file);
}

?>

<h1>You are the judge! Choose an image</h1>
<div class="judge-images">
    <?php
    $json_file = file_get_contents("data/images.json");
    $articles = json_decode($json_file, true);
    foreach ($articles["images"] as $img) {
        echo "<img src=media/img/$img class='choose-picture'>";
    }
    ?>


</div>
<form action="" method="post">
    <input type="text" id="main-image" name="main-image" hidden>
    <button type="submit" id="choose-image" name="choose-image">Choose image</button>
</form>
</body>
</html>