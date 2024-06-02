
<?php

include './model/config.php';

$result = $conn->query("SELECT * FROM gallery");

?>

<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from duruthemes.com/demo/html/nostop/dark-parallax-image/gallery-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2024 07:49:42 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Image Gallery</title>
    <link rel="shortcut icon" href="https://res.cloudinary.com/dhkh3kguy/image/upload/v1716719838/favicon_mcxew6.ico" />    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald&amp;family=Barlow:wght@300;400;500;600;700&amp;display=swap">
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
                    <li class="nav-item"> <a class="nav-link" href="index.html" >Home </a>  </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Events &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="blog.html" class="dropdown-item"><span>Ucoming Events</span></a></li>
                            <li><a href="blog2.html" class="dropdown-item"><span>Completed Events</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Gallery &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="gallery-image.html" class="dropdown-item"><span>Image Gallery</span></a></li>
                            <li><a href="gallery-video.html" class="dropdown-item"><span>Video Gallery</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">Equipments</a></li>

                    <li class="nav-item"><a class="nav-link " href="#">Pricing</a></li>
                   
                    
                   
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header Banner -->
    <section class="banner-header section-padding bg-img" data-overlay-dark="5" data-background="img/slider/1.jpg">
        <div class="v-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="animate-box" data-animate-effect="fadeInUp">Image Gallery</h6>
                        <h1 class="animate-box" data-animate-effect="fadeInUp">Image Gallery</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Gallery Image -->
    <section class="section-padding">
        <div class="container">
            <!-- <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="gallery-filter">
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".cardio">Cardio</li>
                        <li data-filter=".weight">Weight</li>
                        <li data-filter=".crossfit">Crossfit</li>
                    </ul>
                </div>
            </div> -->
            <div class="row gallery-items">
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-4 gallery-masonry-wrapper single-item cardio">
                    <a href="./Admin/Home/<?= $row['photo_path'] ?>" title="" class="gallery-masonry-item-img-link img-zoom">
                        <div class="gallery-box">
                            <div class="gallery-img"> <img src="./Admin/Home/<?= $row['photo_path'] ?>" class="img-fluid mx-auto d-block" alt="" style="width: 300px; height: 300px;"> </div>
                            <div class="gallery-masonry-item-img"></div>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>

                
                
                
               
            </div>
        </div>
    </section>
    
   
   
    
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

<!-- Mirrored from duruthemes.com/demo/html/nostop/dark-parallax-image/gallery-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 May 2024 07:49:42 GMT -->
</html>