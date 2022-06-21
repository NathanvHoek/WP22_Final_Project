<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js"></script>
</head>

<body>


<?php
if (isset($_POST['choose-image'])) {
    // Read articles
    $json_file = file_get_contents("data/images.json");
    $images = json_decode($json_file, true);

    $images["current_image"] = $_POST["main-image"];
echo "hello";
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
        <form action="" method="post">
            <input type="text" id="main-image" name="main-image" hidden>
            <button type="submit" id="choose-image" name="choose-image">Choose image</button>
        </form>

    </div>

</body>
</html>