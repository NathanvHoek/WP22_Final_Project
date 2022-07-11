<?php
$page_title = "What do you meme? - Online Game";
include "tpl/structure/start.php";
?>

    <div id="start-page"></div>
    <div class="jumbotron">
        <div class="text-center container-center">
            <img src="./media/logo/wdym_logo_small.png" class="rounded" alt="Logo What Do You Meme?">
        </div>
    </div>

    <div class="container-center">
        <form class="form-inline text-center start-buttons" action="./create_room.php" method="post">
            <a href="./create_room.php"><button type="button" id="start-game" class="btn btn-warning bold">START NEW GAME</button></a>
            <h2>OR</h2>
            <div class="form-group enter-room-code">
                <input type="number" name="join-code" id="join-code" class="form-control" placeholder="Enter a room code" required>
                <button type="submit" id="pin-join-btn" class="bold inactive btn btn-info" disabled>JOIN</button>
            </div>
        </form>
        <div class="center"><a class="scroll-down center" href="#about_game"><p>About the game</p><div class="arrow down"></div></a></div>
    </div>


    <div id="about_game" class="container-fluid container-center full-page">
        <div class="row">
            <div class="col-sm-7 align-right">
                <h2>About The Game</h2>
                <p>What Do You Meme is the party game for meme lovers! Find out who will be crowned
                    Meme Queen/King by competing with friends (or family if you’re brave) to match photo cards with caption cards,
                    creating your own outrageously funny meme combinations. It’s the perfect excuse to call up the crew,
                    and get everyone together for guaranteed laughs.</p>
                <div class="center"><img id="index_photo" src="media/photos/index_photo.jpeg" alt=""></div>
            </div>
        </div>
        <div class="center"><a class="scroll-down center" href="#game_explain"><p>Game explanation</p><div class="arrow down"></div></a></div>
    </div>


    <div id="game_explain" class="container-fluid bg-grey container-center full-page">
        <div class="row">
            <div class="col-sm-7">
                <h2>How to play</h2>
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
        <div class="center"><a class='scroll-down center' href="#about-us"><p>About the website</p><div class="arrow down"></div></a></div>
    </div>


    <div id="about-us" class="full-page">
        <div class="bg-light">
            <div class="container py-5">
                <div class="row h-100 align-items-center py-5">
                    <div class="col-lg-6">
                        <h2 class="display-4">About the website</h2>
                        <p class="font-italic text-muted">This website is an online adaption of the <i>What Do You Meme®</i>
                            adult card game. The card game was first published in 2016 by the same-titled new-age game company.
                            You can order the <i>What Do You Meme®</i> Core Game from
                            <a href="https://whatdoyoumeme.com/collections/featured/products/what-do-you-meme-core-game">here</a>.</p>

                    </div>
                </div>
            </div>
        </div>


        <div class="bg-light py-5">
            <div class="container py-5">
                <div class="row mb-4">
                    <div class="col-lg-5">
                        <h2 class="display-4 font-weight-light">Our team</h2>
                        <p class="font-italic text-muted">Meet the people who've made the online game possible.</p>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="media/photos/tariq_ballout.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Tariq Ballout</h5><span class="small text-uppercase text-muted">Front End Web Developer</span>
                            <ul class="social mb-0 list-inline mt-3">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="media/photos/nathan_van_hoek.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Nathan van Hoek</h5><span class="small text-uppercase text-muted">Project Manager - Backend Application Developer</span>
                            <ul class="social mb-0 list-inline mt-3">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="media/photos/simon_van_loon.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Simon van Loon</h5><span class="small text-uppercase text-muted">UI front end designer</span>
                            <ul class="social mb-0 list-inline mt-3">
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="center"><a class='scroll-up center' href="#start-page"><div class="arrow up"></div><p>Go all the way up</p></a></div>
    </div>


<?php
include "tpl/structure/end.php"
?>