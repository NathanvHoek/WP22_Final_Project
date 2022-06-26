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
        <img src="media/logo/wdym_logo_small.png" class="rounded" alt="...">
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
<footer class="text-center text-lg-start bg-light text-muted">


    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Useful links
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Pricing</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Settings</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Orders</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Help</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Contact
                    </h6>
                    <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                    <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
<div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:Tariq Ballout, Nathan van Hoek, Simon van Loon
</div>
</footer>


</body>
</html>