<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Theme Company</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-left">
                <li ><a class="navbar-active" href="#jumbotron">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
            </ul>
        </div>
    </div>
</nav>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>
<div class="jumbotron" id="jumbotron">
    <div class="text-center">
        <img src="media/logo/wdym_logo_small.png" class="breathing" alt="...">
    </div>
    <div>
    <form class="form-inline text-center">
        <button type="button" class="btn btn-warning btn-lg" >Start new game</button>
        <h2 id="or_text">OR</h2>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter a room code" required>
            <div class="input-group-btn">
                <button type="button" class="btn btn-info">Join</button>
            </div>
        </div>
    </form>
    </div>
</div>

<div class="container-fluid"
    <div class="row">
        <div class="col-sm-7">
            <h2>About The Game</h2>
            <p>What Do You Meme is the party game for meme lovers! Find out who will be crowned
            Meme Queen/King by competing with friends (or family if you’re brave) to match photo cards with caption cards,
            creating your own outrageously funny meme combinations. It’s the perfect excuse to call up the crew,
            and get everyone together for guaranteed laughs.</p>
        </div>
    </div>
</div>
<div class="container-fluid bg-grey"
<div class="row">
    <div class="col-sm-7">
        <h2>Quick Rules:</h2>
        <ul>
            <li>A game of What Do You Meme requires at least 3 players.</li>
            <li>Cards are shuffled and distributed among the players.</li>
            <li>A designated photo card is chosen for the round, and shown on the screen, and everyone except the judge chooses
                a caption card to pair with the photo card. One player will be assigned as judge.</li>
            <li>The player whose card is picked by the judge receives 1 point!</li>
            <li>The player with the most points after all the rounds wins the game!</li>
        </ul>
    </div>
</div>
</div>
<div class="container-fluid">
    <footer class="py-3 my-4">
        <ul class="nav text-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="index_test.php" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="about.php" class="nav-link px-2 text-muted">About</a></li>
        </ul>
        <p class="text-center text-muted">© 2022 Copyright:Tariq Ballout, Nathan van Hoek, Simon van Loon</p>
    </footer>
</div>



</body>
</html>