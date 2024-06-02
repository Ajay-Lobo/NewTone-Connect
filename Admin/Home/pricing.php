<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit;
}

include_once '../model/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Sanitize and validate input data
    
    $membership_name = htmlspecialchars($_POST['membership_name'], ENT_QUOTES, 'UTF-8');
    $membership_price = filter_input(INPUT_POST, 'membership_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_NUMBER_INT);
    $extra_duration = filter_input(INPUT_POST, 'extra_duration', FILTER_SANITIZE_NUMBER_INT);

    if ($_POST['action'] == 'add') {
        // Validate the membership name and numbers
        if (strlen($membership_name) <= 3) {
            $_SESSION['error'] = 'Membership name must be more than 3 characters!';
        } elseif ($membership_price < 0 || $duration < 0 || $extra_duration < 0) {
            $_SESSION['error'] = 'Numbers must not be negative!';
        } else {
            // Prepare an SQL query
            $sql = "INSERT INTO pricing (membership_name, membership_price, duration, extra_duration) VALUES (?, ?, ?, ?)";

            // Prepare and bind
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdii", $membership_name, $membership_price, $duration, $extra_duration);

            // Execute the query
            if ($stmt->execute()) {
                $_SESSION['success'] = 'Data inserted successfully!';
            } else {
                $_SESSION['error'] = 'Failed to insert data!';
            }

            // Close the statement
            $stmt->close();
        }
    } elseif ($_POST['action'] == 'edit') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        // Prepare an SQL query
        $sql = "UPDATE pricing SET membership_name = ?, membership_price = ?, duration = ?, extra_duration = ? WHERE pay_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdiii", $membership_name, $membership_price, $duration, $extra_duration, $id);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Data updated successfully!';
        } else {
            $_SESSION['error'] = 'Failed to update data!';
        }

        // Close the statement
        $stmt->close();
    } elseif ($_POST['action'] == 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        // Prepare an SQL query
        $sql = "DELETE FROM pricing WHERE pay_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Data deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete data!';
        }

        // Close the statement
        $stmt->close();
    }

    // Redirect to avoid resubmission
    header("location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch data from the database
$sql = "SELECT * FROM pricing";
$result = $conn->query($sql);
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
.centered-table th, .centered-table td {
    text-align: center;
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
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Gallery &nbsp;<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="gallery-image.html" class="dropdown-item"><span>Image Gallery</span></a></li>
                            <li><a href="gallery-video.html" class="dropdown-item"><span>Video Gallery</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="about.html">Equipments</a></li>

                    <li class="nav-item"><a class="nav-link active" href="#">Pricing</a></li>

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
                        <p>PRICING</p>
                        <h2>Our Pricing</h2>
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
            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Price</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
       
              <div class="mb-3">
                <input type="text" class="form-control" name="membership_name" placeholder="Name of the Memebership" required>
              </div>
               <div class="mb-3">
                <input type="number" class="form-control" name="membership_price" placeholder="Price of the Memebership" min="0" required>
              </div>
               <div class="mb-3">
                <input type="number" class="form-control" name="duration" placeholder="Duration for the Membership" min="0" required>
              </div>
               <div class="mb-3">
                <input type="number" class="form-control" name="extra_duration" placeholder="Extra time for the Memebership" min="0"> 
              </div>
                <input type="submit" class="btn btn-success" value="Submit">
                <input type="reset" class="btn" value="Clear">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
    <!--Editmodal-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #31343b; border: none;">
                <div class="modal-header" style="border-bottom: none; display: flex; justify-content: center;">
                    <h1 class="modal-title fs-5 text-danger" id="editModalLabel">Edit Membership</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_membership_name">Membership Name:</label>
                            <input type="text" name="membership_name" id="edit_membership_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_membership_price">Price:</label>
                            <input type="number" name="membership_price" id="edit_membership_price" step="0.01" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_duration">Duration (in days):</label>
                            <input type="number" name="duration" id="edit_duration" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_extra_duration">Extra Duration (in days):</label>
                            <input type="number" name="extra_duration" id="edit_extra_duration" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update Membership</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 
<!--Dislpay-->
<section class="pricing-section pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($result->num_rows > 0): ?>
                        <table class="table table-dark table-striped centered-table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Membership Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Extra Duration</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <th scope="row"><?= $row['pay_id'] ?></th>
                                        <td><?= $row['membership_name'] ?></td>
                                        <td><?= $row['membership_price'] ?></td>
                                        <td><?= $row['duration'] ?></td>
                                        <td><?= $row['extra_duration'] ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $row['pay_id'] ?>" data-name="<?= $row['membership_name'] ?>" data-price="<?= $row['membership_price'] ?>" data-duration="<?= $row['duration'] ?>" data-extra="<?= $row['extra_duration'] ?>" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-pencil-alt"></i> Edit</button>
                                            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" style="display:inline;">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?= $row['pay_id'] ?>">
                                                &nbsp;&nbsp;

                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">No pricing data available.</div>
                    <?php endif; ?>
                </div>
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
});

$(document).ready(function() {
           

            // Populate edit modal with data
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var duration = $(this).data('duration');
                var extra = $(this).data('extra');

                $('#edit_id').val(id);
                $('#edit_membership_name').val(name);
                $('#edit_membership_price').val(price);
                $('#edit_duration').val(duration);
                $('#edit_extra_duration').val(extra);
            });
        });

    </script>

</body>


</html>