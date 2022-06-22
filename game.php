<?php
session_start();
include "tpl/head.php"
?>

<?php
// Check whether player is the judge
$is_judge = false;

// If player is not the judge, show normal player screen
if (!$is_judge){
    include "tpl/player.php";
    echo $_SESSION["username"];
}

// If player is the judge, show special judge screen
else {
    include "tpl/judge.php";
}

?>


<?php
include "tpl/end.php"
?>