<?php

include './model/config.php';

$result = $conn->query("SELECT * FROM upcoming_events where iscompleted=0");

?>

<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from duruthemes.com/demo/html/nostop/dark-parallax-image/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2024 07:48:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Fitness HQ</title>
    <link rel="shortcut icon" href="https://res.cloudinary.com/dhkh3kguy/image/upload/v1716719838/favicon_mcxew6.ico" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald&amp;family=Barlow:wght@300;400;500;600;700&amp;display=swap">
    <link rel="stylesheet" href="css/plugins.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Mouse cursor -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="index.html"> <img src="https://res.cloudinary.com/dhkh3kguy/image/upload/v1716719775/logo-gym_a7qmbd.png" class="logo-img" alt=""> </a>
                <!-- <a class="logo" href="index.html"> <h2>NO<span>STOP</span></h2> </a> -->
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"> <a class="nav-link active " href="#" >Home </a>  </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Events &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="upcoming-event.php" class="dropdown-item"><span>Ucoming Events</span></a></li>
                            <li><a href="completed-events.php" class="dropdown-item"><span>Completed Events</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Gallery &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="gallery-image.php" class="dropdown-item"><span>Image Gallery</span></a></li>
                            <!-- <li><a href="gallery-video.html" class="dropdown-item"><span>Video Gallery</span></a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="equipments.php">Equipments</a></li>

                    <li class="nav-item"><a class="nav-link" href="pricing.php">Pricing</a></li>
                   
                    
                   
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Parallax Image -->
    <div class="parallax-header valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/12.jpg">
        <div class="container">
            <div class="row content-justify-center">
                <div class="col-md-12 text-center">
                    <div class="v-middle">
                        <h6>Welcome to Fitness HQ</h6>
                        <h1>Be A Happier, Healthier,<br><span>Stronger You</span></h1>
                        <p>Achieve your health & fitness goals at any stage.</p>
                        <a href="pricing.php" class="btn-1 button-1">JOIN NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30">
                    <div class="section-title2">About Us</div>
                    <div class="section-title">The story behind <span>our gym</span></div>
                    <p class="mb-30">Quisque tortor risus, pharetra ut venenatis ac, rutrum eget ante fusce in convallis nibh felis rana hendrerit diam rhoncus eget sonec dictum acus element sifend nisa efficitur venenatis.</p>
                    <ul class="list-unstyled list">
                        <li>
                            <div class="list-icon"> <span class="ti-check"></span> </div>
                            <div class="list-text">
                                <p>Over 15 years of experience</p>
                            </div>
                        </li>
                        <li>
                            <div class="list-icon"> <span class="ti-check"></span> </div>
                            <div class="list-text">
                                <p>Certified Trainers</p>
                            </div>
                        </li>
                        <li>
                            <div class="list-icon"> <span class="ti-check"></span> </div>
                            <div class="list-text">
                                <p>Exceptional work quality</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="about-img">
                        <div class="img"> <img src="img/about.jpg" class="img-fluid" alt=""> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video -->
    <section class="video-wrapper video section-padding bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/10.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-title3">Be Inspired</div>
                    <div class="section-title">Explore Life <span>Gym</span></div>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-12">
                    <a class="vid" href="https://youtu.be/pJsWKy9y1Cg">
                        <div class="vid-butn"> <span class="icon"> <i class="ti-control-play"></i> </span> </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Classes -->
    <section class="classes section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-title3">Our Services</div>
                    <div class="section-title"><span>Special</span>ization</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/classes/1.jpg" alt=""> </div>
                            <div class="con">
                                <h5><a href="pricing.php">Personal Training</a></h5>
                                <div class="line"></div>
                                <div class="icon">
                                    <a href="pricing.php"><i class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/classes/2.jpg" alt=""> </div>
                            <div class="con">
                                <h5><a href="equipments.php">Fitness Class</a></h5>
                                <div class="line"></div>
                                <div class="icon">
                                    <a href="equipments.php"><i class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/classes/3.jpg" alt=""> </div>
                            <div class="con">
                                <h5><a href="equipments.php">Steam Class</a></h5>
                                <div class="line"></div>
                                <div class="icon">
                                    <a href="equipments.php"><i class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="item">
                            <div class="position-re o-hidden"> <img src="img/classes/4.jpg" alt=""> </div>
                            <div class="con">
                                <h5><a href="classes-single.html">Online Training</a></h5>
                                <div class="line"></div>
                                <div class="icon">
                                    <a href="classes-single.html"><i class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/classes/8.jpg" alt=""> </div>
                            <div class="con">
                                <h5><a href="classes-single.html">Cardio Fitness</a></h5>
                                <div class="line"></div>
                                <div class="icon">
                                    <a href="classes-single.html"><i class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="item">
                            <div class="position-re o-hidden"> <img src="img/classes/9.jpg" alt=""> </div>
                            <div class="con">
                                <h5><a href="classes-single.html">Crossfit Training</a></h5>
                                <div class="line"></div>
                                <div class="icon">
                                    <a href="classes-single.html"><i class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog -->
    <section class="blog section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-title3">Exclusives</div>
                    <div class="section-title"><span>Ucoming</span>Events</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">

                    <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="./Admin/Home/<?= $row['event_poster'] ?>" alt="" style="width: 500px; height: 400px;">
                                <div class="date">
                                    <a href="post.html"> <span><?= $row['event_month'] ?></span> <i><?= $row['event_day'] ?></i> </a>
                                </div>
                            </div>
                            <div class="con"> <span class="category">
                                    <a href="upcoming-event.php"> <?= $row['event_name'] ?></a>
                                </span>
                                <h5><a href="upcoming-event.php"><?= $row['event_title'] ?></a></h5>
                            </div>
                        </div>

                        <?php endwhile; ?>
                <?php endif; ?>

                        <!-- <div class="item">
                            <div class="position-re o-hidden"> <img src="img/slider/9.jpg" alt="">
                                <div class="date">
                                    <a href="post.html"> <span>Jun</span> <i>10</i> </a>
                                </div>
                            </div>
                            <div class="con"> <span class="category">
                                    <a href="blog.html">Fitness</a>
                                </span>
                                <h5><a href="post.html">Upper Body Plyometric Exercises</a></h5>
                            </div>
                        </div>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/slider/3.jpg" alt="">
                                <div class="date">
                                    <a href="post.html"> <span>Jun</span> <i>15</i> </a>
                                </div>
                            </div>
                            <div class="con"> <span class="category">
                                    <a href="blog.html">Training</a>
                                </span>
                                <h5><a href="post.html">What Is Tempo Training?</a></h5>
                            </div>
                        </div>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/slider/14.jpg" alt="">
                                <div class="date">
                                    <a href="post.html"> <span>Jun</span> <i>25</i> </a>
                                </div>
                            </div>
                            <div class="con"> <span class="category">
                                    <a href="blog.html">Fitness</a>
                                </span>
                                <h5><a href="post.html">Dumbbell Chest Press Variations</a></h5>
                            </div>
                        </div>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/slider/2.jpg" alt="">
                                <div class="date">
                                    <a href="post.html"> <span>Jun</span> <i>25</i> </a>
                                </div>
                            </div>
                            <div class="con"> <span class="category">
                                    <a href="blog.html">Trainers</a>
                                </span>
                                <h5><a href="post.html">The Best Online Tools For Trainers</a></h5>
                            </div>
                        </div>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="img/slider/4.jpg" alt="">
                                <div class="date">
                                    <a href="post.html"> <span>Jun</span> <i>30</i> </a>
                                </div>
                            </div>
                            <div class="con"> <span class="category">
                                    <a href="blog.html">Fitness</a>
                                </span>
                                <h5><a href="post.html">Creative Gym Equipment Swaps</a></h5>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testiominals -->
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/4.jpg" data-overlay-dark="4">
            <div class="container">
                <div class="row">
                    <!-- Free Trial Training -->
                    <div class="col-md-6 mb-30">
                        <div class="ready v-middle">
                            <h4>Wanna Join US</h4>
                            <p>Make an appointment today for your free and non-binding trial session with or without one of our personal trainers.</p> 
                            <a href="contact.php" class="btn-1 button-1">Contact Us</a>
                        </div>
                    </div>
                    <!-- Testiominals -->
                    <div class="col-md-5 offset-md-1">
                        <div class="testimonials-box">
                            <h4>What <span>Clients</span> Say</h4>
                            <div class="owl-carousel owl-theme">
                                <div class="item"> <span class="quote"><img src="img/quot.png" alt=""></span>
                                    <p>Lorem luctus nulla a scelerisque ultricies miss elonas nisa drana aliquamen the placerat quis risus onthase vitae tesus in the duzse vitaeni asthe nesue the duru in fermen.</p>
                                    <div class="info">
                                        <div class="author-img"> <img src="img/team/1.jpg" alt=""> </div>
                                        <div class="cont">
                                            <h6>Jason Brown</h6> <span>Customer Review</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item"> <span class="quote">
                                        <img src="img/quot.png" alt="">
                                    </span>
                                    <p>Lorem luctus nulla a scelerisque ultricies miss elonas nisa drana aliquamen the placerat quis risus onthase vitae tesus in the duzse vitaeni asthe nesue the duru in fermen.</p>
                                    <div class="info">
                                        <div class="author-img"> <img src="img/team/2.jpg" alt=""> </div>
                                        <div class="cont">
                                            <h6>Emily White</h6> <span>Customer Review</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients -->
    <section class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="owl-carousel owl-theme">
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/lotto.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/life-fitness.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/brunswick.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Insta -->
    <div class="insta">
        <div class="container-fluid flex">
            <div class="img">
                <a href="#0"> <img src="img/slider/1.jpg" alt=""> </a> <i class="ti-instagram"></i>
            </div>
            <div class="img">
                <a href="#0"> <img src="img/slider/2.jpg" alt=""> </a> <i class="ti-instagram"></i>
            </div>
            <div class="img">
                <a href="#0"> <img src="img/slider/3.jpg" alt=""> </a> <i class="ti-instagram"></i>
            </div>
            <div class="img">
                <a href="#0"> <img src="img/slider/4.jpg" alt=""> </a> <i class="ti-instagram"></i>
            </div>
            <div class="img">
                <a href="#0"> <img src="img/slider/5.jpg" alt=""> </a> <i class="ti-instagram"></i>
            </div>
            <div class="follow">
                <a href="gallery-image.php" class="text-bg"> <span><i class="ti-gallery"></i>&nbsp; Gallery</span></a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="wrap">
                            <h4>Contact</h4>
                            <div class="wrap-text">0665 Broadway NY, New York 10001
                                <br>United States of America
                            </div>
                            <div class="wrap-phone">Phone: +1 203-123-0606</div>
                            <div class="wrap-mail">info@nostop.com</div>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-1">
                        <div class="opening-hours">
                            <h4>Opening Hours</h4>
                            <ul>
                                <li>
                                    <div class="tit">Monday - Friday</div>
                                    <div class="dots"></div> <span>06:00 - 22:00</span>
                                </li>
                                <li>
                                    <div class="tit">Saturday</div>
                                    <div class="dots"></div> <span>08:00 - 17:00</span>
                                </li>
                                <li>
                                    <div class="tit">Sunday</div>
                                    <div class="dots"></div> <span>Closed</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-1">
                        <div class="wrap">
                            <h4>Subscribe</h4>
                            <div class="row subscribe">
                                <div class="col-md-12">
                                    <p>Subscribe to take advantage of our campaigns and gift certificates.</p>
                                    <form>
                                        <input type="text" name="search" placeholder="Your email" required>
                                        <button>Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copyright">
                            <p>2024 © All rights reserved. Designed by <a href="#" target="_blank">Nishanth</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="footer-social"> <a href="#"><i class="ti-instagram"></i></a> <a href="#"><i class="ti-twitter"></i></a> <a href="#"><i class="ti-youtube"></i></a> <a href="#"><i class="ti-facebook"></i></a> </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.min.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.isotope.v3.0.2.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scrollIt.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/YouTubePopUp.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- Mirrored from duruthemes.com/demo/html/nostop/dark-parallax-image/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2024 07:49:34 GMT -->
</html>