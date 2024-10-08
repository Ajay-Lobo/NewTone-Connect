<?php
include_once './model/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    if ($action == 'upload') {
        $fname = $_POST['fname'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO upcoming_events (fname, email, phone, subjects, messages) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fname, $email, $phone, $subject, $message);

        $stmt->execute();
        $stmt->close();
    }  
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Contact Us</title>
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
                    <li class="nav-item"> <a class="nav-link " href="index.html" >Home </a>  </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Events &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="blog.html" class="dropdown-item"><span>Ucoming Events</span></a></li>
                            <li><a href="blog.html" class="dropdown-item"><span>Completed Events</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Gallery &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="gallery-image.html" class="dropdown-item"><span>Image Gallery</span></a></li>
                            <li><a href="gallery-video.html" class="dropdown-item"><span>Video Gallery</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">Equipments</a></li>

                    <li class="nav-item"><a class="nav-link" href="pricing.html">Pricing</a></li>
                   
                    
                   
                    <li class="nav-item"><a class="nav-link active" href="#">Contact</a></li>
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
                        <h6 class="animate-box" data-animate-effect="fadeInUp">Get in touch</h6>
                        <h1 class="animate-box" data-animate-effect="fadeInUp">Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact -->
    <section class="contact section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-60 animate-box" data-animate-effect="fadeInUp">
                    <h5>Do you have questions about specific training courses, <span>the center or the team?</span></h5>
                    <p class="mb-30">Praesent sed nisl ullamcorper the drana duru metus utah phare mavna busnini viventa the ornare ipsum.</p>
                    <div class="con">
                        <div class="icon">
                            <span class="flaticon-phone-call"></span>
                        </div>
                        <div class="con-content">
                            <p class="text"><a href="tel:+12031230606">+1 203-123-0606</a></p>
                        </div>
                    </div>
                    <div class="con">
                        <div class="icon">
                            <span class="flaticon-envelope"></span>
                        </div>
                        <div class="con-content">
                            <p class="text"><a href="mailto:info@the-gym.com">info@the-gym.com</a></p>
                        </div>
                    </div>
                    <div class="con">
                        <div class="icon">
                            <span class="flaticon-pin"></span>
                        </div>
                        <div class="con-content">
                            <div class="text">0665 Broadway NY, New York 10001
                                <br>United States of America
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1 animate-box" data-animate-effect="fadeInUp">
                    <div class="form-box">
                        <h5>Get in touch</h5>
                        <form method="post" class="contact__form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- Form message -->
    <div class="row">
        <!-- <div class="col-12">
            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
        </div> -->
    </div>
    <!-- Form elements -->
    <div class="row">
        <div class="col-md-12 form-group">
            <input name="fname" type="text" placeholder="Your Name *" required>
        </div>
        <div class="col-md-6 form-group">
            <input name="email" type="email" placeholder="Your Email *" required>
        </div>
        <div class="col-md-6 form-group">
            <input name="phoneno" type="text" placeholder="Your Number *" required>
        </div>
        <div class="col-md-12 form-group">
            <input name="subject" type="text" placeholder="Subject *" required>
        </div>
        <div class="col-md-12 form-group">
            <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
        </div>
        <div class="col-md-12 mt-15">
            <input name="action" type="hidden" value="submit">
            <input type="submit" value="Submit">
        </div>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
                      
                     
             
   
   
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
                        <div class="footer-social"> <a href="#"><i class="ti-instagram"></i></a> <a href="#"><i class="ti-twitter"></i></a> <a href="#"><i class="ti-youtube"></i></a> <a href="#"><i class="ti-pinterest"></i></a> </div>
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


</html>