<div class="container">
    <div class="row home-page-row">
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']) : ?>
            <div class="card">
                <div class="card-header">MOST RECENT POSTS</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if (isset($allPosts) && $allPosts) : ?>
                            <?php foreach ($allPosts as $Post) : ?>
                                <li class="list-group-item">
                                    <a href="?controller=Post&action=read&post_id=<?= $Post['post_id']; ?>"><?= $Post['post_title']; ?></a><br>
                                    <small> created
                                        by <?= $Post['first_name']; ?> <?= $Post['last_name']; ?></small>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="dashboardcard button-center">
                                <blockquote class="author-bio">You have no posts yet... </blockquote>
                            </div>
                            <div class="button-center">
                                <a href="index.php?controller=Post&action=create" class="btn-custom btn btn-center">Let's get started!</a>
                            </div>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">MOST RECENT IMAGES</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if (isset($allImages) && $allImages) : ?>
                            <?php foreach ($allImages as $Image) : ?>
                                <li class="list-group-item">
                                    <a href="?controller=Image&action=viewAll"<? $Image['image_title'];?><?=$Image['image_title']?><br></a>
                                
                                    <small> Image added 
                                        by <?= $Image['first_name']; ?> <?= $Image['last_name']; ?></small>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="dashboardcard button-center">
                                <blockquote class="author-bio">No images in the gallery... </blockquote>
                            </div>
                            <div class="button-center">
                                <a href="index.php?controller=Image&action=upload" class="btn-custom btn btn-center">Let's get started!</a>
                            </div>
                        <?php endif ?>

                    </ul>
                </div>
            </div>

        <?php else : ?>

            <div class="card">
                <div class="card-header">
                    JOIN US
                </div>
                <div class="card-body">
                    <p class="card-text">Follow the link below to register to our blog</p>
                </div>
                <div class="card-footer">
                    <a href="index.php?controller=User&action=registerUser"
                       class="btn btn-custom"><i class="fas fa-user-plus"></i> REGISTER</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    LOGIN
                </div>
                <div class="card-body">
                    <p class="card-text">If you're already registered, follow the link below to login</p>

                </div>
                <div class="card-footer">
                    <a href="index.php?controller=User&action=logIn"
                       class="btn btn-custom"><i class="fas fa-sign-in-alt"></i> LOGIN</a>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>

<div class="card card-team">
    <div class="card-header">
        MEET THE TEAM
    </div>

    <div class="card-body">
        <div id="meet-the-team-carousel" class="carousel slide" data-ride="carousel" data-interval="5000">

            <div class="carousel-inner">
                <div class="carousel-item">
                    <div class="wrapper-team">
                        <div class="wrapper-team-image">
                            <img class="img-responsive" style="border-radius: 50%;" width="150px" height="150px"
                                 src="views/images/carousel/paula.jpg"
                                 alt="First slide - Paula">
                        </div>
                        <div class="wrapper-team-description">
                            <div class="team-description-title">
                                <h1>Paula</h1>
                            </div>
                            <div class="team-description-text">
                                <blockquote class="author-bio">Makes awesome cinnamon swirls, and holds the record for
                                    the first 'get into techer' to get a job.
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="wrapper-team">
                        <div class="wrapper-team-image">
                            <img class="img-responsive" style="border-radius: 50%;" width="150px" height="150px"
                                 src="views/images/carousel/emma.jpg"
                                 alt="Second slide - Emma">
                        </div>
                        <div class="wrapper-team-description">
                            <div class="team-description-title">
                                <h1>Emma</h1>
                            </div>
                            <div class="team-description-text">
                                <blockquote class="author-bio">Usually found adhered to a rock (In the sky or underground)</blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="wrapper-team">
                        <div class="wrapper-team-image">
                            <img class="img-responsive" style="border-radius: 50%;" width="150px" height="150px"
                                 src="views/images/carousel/lucy.jpg"
                                 alt="Third slide - Lucy">
                        </div>
                        <div class="wrapper-team-description">
                            <div class="team-description-title">
                                <h1>Lucy</h1>
                            </div>
                            <div class="team-description-text">
                                <blockquote class="author-bio"> Enjoys very garlicy food (Keep your distance!)</blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="wrapper-team">
                        <div class="wrapper-team-image">
                            <img class="img-responsive" style="border-radius: 50%;" width="150px" height="150px"
                                 src="views/images/carousel/louise.jpg"
                                 alt="Fourth slide - Louise">
                        </div>
                        <div class="wrapper-team-description">
                            <div class="team-description-title">
                                <h1>Louise</h1>
                            </div>
                            <div class="team-description-text">
                                <blockquote class="author-bio"> Often trying to find parking spaces for her exceptionally large electric bike </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active">
                    <div class="wrapper-team">
                        <div class="wrapper-team-image">
                            <img class="img-responsive" style="border-radius: 50%;" width="150px" height="150px"
                                 src="views/images/carousel/alex.jpg"
                                 alt="Fifth slide - Alex">
                        </div>
                        <div class="wrapper-team-description">
                            <div class="team-description-title">
                                <h1>Alex</h1>
                            </div>
                            <div class="team-description-text">
                                <blockquote class="author-bio"> Tells friends she's getting into Tech.. <br> "Can you fix my printer?" <br> "Can you design me a website??" </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="wrapper-team">
                        <div class="wrapper-team-image">
                            <img class="img-responsive" style="border-radius: 50%;" width="150px" height="150px"
                                 src="views/images/carousel/gillian.jpeg"
                                 alt="Sixth slide - Gillian">
                        </div>
                        <div class="wrapper-team-description">
                            <div class="team-description-title">
                                <h1>Gillian</h1>
                            </div>
                            <div class="team-description-text">
                                <blockquote class="author-bio"> Feeling more tired after this course than she did from
                                    running Stirling Marathon last year.
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
