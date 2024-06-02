<?php
session_start();

include_once '../model/config.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';


    if ($action == 'upload') {
        //   $photo_name = $_POST['image_name'] ?? '';
        $event_category = $_POST['event_category'] ?? '';
        $event_name = $_POST['event_name'] ?? '';
        $event_date = $_POST['event_date'] ?? '';
        $event_month = date('m', strtotime($event_date));
        $event_year = date('Y', strtotime($event_date));
        $event_day = date('d', strtotime($event_date));

        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
            $file_tmp_path = $_FILES["photo"]["tmp_name"];
            $file_name = basename($_FILES["photo"]["name"]);
            $file_size = $_FILES["photo"]["size"];
            $file_type = $_FILES["photo"]["type"];

            $target_dir = "uploads/events/";
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is an actual image or fake image
            $check = getimagesize($file_tmp_path);
            if ($check !== false) {
                // Check if file already exists
                if (!file_exists($target_file)) {
                    // Check file size (limit to 5MB)
                    if ($file_size <= 5000000) {
                        // Allow certain file formats
                        if (in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                            if (move_uploaded_file($file_tmp_path, $target_file)) {
                                // Insert into database
                                $stmt = $conn->prepare("INSERT INTO upcoming_events (event_name,event_title,event_poster,event_date,event_day,event_month,	event_year) VALUES (?, ?,?,?, ?, ?, ?)");
                                $stmt->bind_param("sssssss", $event_category, $event_name, $target_file, $event_date, $event_day, $event_month, $event_year);

                                if ($stmt->execute()) {
                                    $_SESSION['success'] = "The file " . htmlspecialchars($file_name) . " has been uploaded.";
                                } else {
                                    $_SESSION['error'] = "Error uploading the file.";
                                }
                                $stmt->close();
                            } else {
                                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                            }
                        } else {
                            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        }
                    } else {
                        $_SESSION['error'] = "Sorry, your file is too large.";
                    }
                } else {
                    $_SESSION['error'] = "Sorry, file already exists.";
                }
            } else {
                $_SESSION['error'] = "File is not an image.";
            }
        } else {
            $_SESSION['error'] = "No file was uploaded or there was an error with the upload.";
        }
    } elseif ($action == 'edit') {
        $event_id = $_POST['id'] ?? '';
        $event_category = $_POST['event_category'] ?? '';
        $event_name = $_POST['event_name'] ?? '';
        $event_date = $_POST['event_date'] ?? '';
        $event_month = date('m', strtotime($event_date));
        $event_year = date('Y', strtotime($event_date));
        $event_day = date('d', strtotime($event_date));

        $stmt = $conn->prepare("UPDATE upcoming_events SET event_name=?, event_title=?, event_date=?, event_day=?, event_month=?, event_year=? WHERE event_id=?");
        $stmt->bind_param("ssssssi", $event_category, $event_name, $event_date, $event_day, $event_month, $event_year, $event_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Record updated successfully.";
        } else {
            $_SESSION['error'] = "Error updating record.";
        }
        $stmt->close();
    } elseif ($action == 'delete') {
        $event_id = $_POST['id'] ?? '';

        $stmt = $conn->prepare("SELECT event_poster FROM upcoming_events WHERE event_id=?");
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $stmt->bind_result($photo_path);
        $stmt->fetch();
        $stmt->close();

        if (unlink($photo_path)) {
            $stmt = $conn->prepare("DELETE FROM upcoming_events WHERE event_id=?");
            $stmt->bind_param("i", $event_id);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Record deleted successfully.";
            } else {
                $_SESSION['error'] = "Error deleting record.";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Error deleting file.";
        }
    }
}

$result = $conn->query("SELECT * FROM upcoming_events");
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Fitness HQ</title>
    <link rel="shortcut icon" href="https://res.cloudinary.com/dhkh3kguy/image/upload/v1716719838/favicon_mcxew6.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald&amp;family=Barlow:wght@300;400;500;600;700&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/plugins.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .centered-table th,
        .centered-table td {
            text-align: center;
        }

        .table-container {
            max-height: 400px;
            /* Adjust this value based on the height of your rows */
            overflow-y: auto;
            display: block;
        }
    </style>
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
                    <li class="nav-item"> <a class="nav-link" href="index.php"> Home </a> </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Events &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="blog.html" class="dropdown-item"><span>Ucoming Events</span></a></li>
                            <li><a href="blog.html" class="dropdown-item"><span>Completed Events</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Gallery &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item"><span>Image Gallery</span></a></li>
                            <li><a href="gallery-video.html" class="dropdown-item"><span>Video Gallery</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link active" href="about.html">Equipments</a></li>

                    <li class="nav-item"><a class="nav-link " href="#">Pricing</a></li>

                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?> &nbsp;<i class="ti-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="gallery-image.html" class="dropdown-item"><span>Profile</span></a></li>
                            <li><a href="../Logout/index.php" class="dropdown-item"><span>Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-title bg-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-content">
                        <p>Events</p>
                        <h2>Ucoming Event</h2>
                        <button type="button" class="btn rounded-3 fs-6" style="background-color: #50ec96; padding: 10px 20px;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!--Addmodal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #31343b; border: none;">
                <div class="modal-header" style="border-bottom: none; display: flex; justify-content: center;">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Event Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="upload">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="event_category" placeholder="Event Category" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="event_name" placeholder="Event Name" required>
                        </div>

                        <div class="mb-3">
                            <input type="file" class="form-control" name="photo" accept="image/*" required>
                            <span style="color:red; ">File must be less than 2MB</span>

                        </div>
                        <div class="mb-3">
                            <label for="event_date">Event Date:</label>
                            <input type="date" class="form-control" name="event_date" placeholder="Event Date" required min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+2 years')); ?>">
                        </div>

                        <input type="submit" class="btn btn-success" value="Upload">
                        <input type="reset" class="btn" value="Clear">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Editmodal-->
    <!--Editmodal-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #31343b; border: none;">
            <div class="modal-header" style="border-bottom: none; display: flex; justify-content: center;">
                <h1 class="modal-title fs-5 text-danger" id="editModalLabel">Edit Event Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_event_category">Event Category:</label>
                        <input type="text" name="event_category" id="edit_event_category" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_event_name">Event Name:</label>
                        <input type="text" name="event_name" id="edit_event_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_event_date">Event Date:</label>
                        <input type="date" name="event_date" id="edit_event_date" class="form-control" required>
                   
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Update Event Details</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!--Display-->
    <section class="gallery-section pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($result->num_rows > 0) : ?>
                        <div class="table-container">

                            <table class="table table-dark table-striped centered-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Event Category</th>
                                        <th scope="col">Event Name</th>
                                        <th scope="col">Event Poster</th>
                                        <th scope="col">Event Date</th>
                                        <th scope="col">Actions</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <th scope="row"><?= $row['event_id'] ?></th>
                                            <td><?= $row['event_name'] ?></td>
                                            <td><?= $row['event_title'] ?></td>
                                            <td><img src="<?= $row['event_poster'] ?>" alt="<?= $row['event_title'] ?>" style="width: 100px; height: 150px;"></td>
                                            <td><?= $row['event_date'] ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $row['event_id'] ?>" data-category="<?= $row['event_name'] ?>" data-name="<?= $row['event_title'] ?>" data-date="<?= $row['event_date'] ?>" data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </button>
                                                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" style="display:inline;">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="id" value="<?= $row['event_id'] ?>">
                                                    &nbsp;&nbsp;
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">No Events data available.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <footer>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       $(document).ready(function() {
    <?php if (isset($_SESSION['error'])) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo $_SESSION['error']; ?>',
        });
        <?php unset($_SESSION['error']); ?>
    <?php } elseif (isset($_SESSION['success'])) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?php echo $_SESSION['success']; ?>',
        });
        <?php unset($_SESSION['success']); ?>
    <?php } ?>

    // Populate edit modal with data
    $('.edit-btn').on('click', function() {
        var id = $(this).data('id');
        var category = $(this).data('category');
        var name = $(this).data('name');
        var date = $(this).data('date');

        $('#edit_id').val(id);
        $('#edit_event_category').val(category);
        $('#edit_event_name').val(name);
        $('#edit_event_date').val(date);
    });
});

    </script>

</body>

</html>