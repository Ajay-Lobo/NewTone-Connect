<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../login.php");
    exit;
  }
  include('../Navbar/index.php');

  include('../../model/config.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $conn is your database connection
    $imageName = $_POST['image_name'];
    // Check if file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
      $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
      $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

      // Check file extension
      if (in_array($file_extension, $allowed_types)) {
        // Read image data into a variable
        $img_data = file_get_contents($_FILES['image']['tmp_name']);

        // Prepare SQL statement to insert image into database
        $stmt = $conn->prepare("INSERT INTO gallery (photo,photoname) VALUES (?,?)");
        $stmt->bind_param("bb", $img_data, $imageName);

        // Execute SQL statement
        if ($stmt->execute()) {
          $upload_message = "Image uploaded successfully.";
        } else {
          $upload_message = "Error uploading image: " . $conn->error;
        }

        // Close statement
        $stmt->close();
      } else {
        $upload_message = "Invalid file type. Allowed types are: jpg, jpeg, png, gif";
      }
    } else {
      $upload_message = "Error uploading image: " . $_FILES["image"]["error"];
    }
  }


  // Fetch images from database
  $sql = "SELECT id, photo,photoname FROM gallery";
  $result = $conn->query($sql);

  // Close connection
  $conn->close();
  ?>

  <br>

  <div class="texto">
    <h1>Gallery</h1>&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn  px-4 py-2 rounded-3 fs-6" style="background-color: #50ec96;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i></button>
  </div>


  <div class="container">
    <?php if (isset($upload_message)) { ?>
      <div id="uploadMessage" class="alert alert-success" role="alert"><?php echo $upload_message; ?></div>
    <?php } ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #31343b; border: none;">
          <div class="modal-header" style="border-bottom: none; display: flex; justify-content: center;"> <!-- Centering the text -->
            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Image Upload</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" class="form-control" id="image-name" name="image_name" placeholder="Name of the Image">
              </div>
              <div class="mb-3">
                <label for="image-file" class="col-form-label">Insert Image</label>
                <input type="file" class="form-control" id="image-file" name="image" required>
              </div>
              <div class="modal-footer justify-content-center" style="border-top: none;">
                <input type="submit" class="btn btn-success" value="Upload Image">
                <input type="reset" class="btn btn-secondary" value="Clear">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>






  <br>

  <table>
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Name of Photo</th>
      <th></th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["photo"]) . "' width='100' height='100'></td>";
        echo "<td>" . $row["photoname"] . "</td>";
        echo "<td>
        <a href='edit.php?id=" . $row["id"] . "' style='background-color:#ff8206; color: white; padding: 5px 10px; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease; text-decoration: none; margin-right: 5px;'>
            <i class='fa fa-edit'></i>&nbsp;&nbsp;Edit
        </a>
        <a href='delete.php?id=" . $row["id"] . "' style='background-color:#ff0505; color: white; padding: 5px 10px; border-radius: 5px; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease; text-decoration: none; margin-right: 5px;'>
            <i class='fa fa-trash'></i>&nbsp;&nbsp;Delete
        </a>
    </td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='3'>No images found.</td></tr>";
    }
    ?>
  </table>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script>
    setTimeout(function() {
      var uploadMessage = document.getElementById('uploadMessage');
      if (uploadMessage) {
        uploadMessage.style.display = 'none';
      }
    }, 3000);
    window.onload = function() {
      document.getElementById('image-file').value = '';
    };
  </script>
</body>

</html>