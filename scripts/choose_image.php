<?php

if (!empty($_POST['main_image'])) {
    // Read articles
    $json_file = file_get_contents("../data/content/images.json");
    $images = json_decode($json_file, true);

    $images["current_image"] = $_POST["main_image"];

    // Save to external file
    $json_file = fopen('../data/content/images.json', 'w');
    fwrite($json_file, json_encode($images));
    fclose($json_file);
}