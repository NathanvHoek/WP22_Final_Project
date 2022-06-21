<?php
if (isset($_POST['submit'])) {

    // Read articles
    $json_file = file_get_contents("../data/player_data.json");
    $articles = json_decode($json_file, true);

    // Generate article ID
    $article_id = 0;
    foreach ($articles as $key => $value){
        $article_id = $value['id'];
    }
    $article_id += 1;

    $articles[] = [
        'id' => $article_id,
        'date' => time(),
        'title' => "New player",
        'player_name' => "Hello",
        'article' => "Coool"
    ];

    // Save to external file
    $json_file = fopen('../data/player_data.json', 'w');
    fwrite($json_file, json_encode($articles));
    fclose($json_file);

    // Redirect to homepage
    header("Location: ../lobby.php");
    die();
}