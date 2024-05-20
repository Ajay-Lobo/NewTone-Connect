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

  //navbar
  include('../Navbar/index.php');
  //database config
  include('../../model/config.php');
//image errors
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
//cloudinary creditionals

  require '../../vendor/autoload.php';
  $cloud_name = 'dhkh3kguy';
  $api_key = '267416774326211';
  $api_secret = 'ZrDX3Jjrpgq6p1Tu6T9ZbkVhF-8';
  //certificate include
  $ca_bundle_path = dirname(__DIR__, 2) . '/cacert.pem';
//image upload
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file_tmp_path = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    $public_id = pathinfo($file_name, PATHINFO_FILENAME); // Use the file name (without extension) as public ID

    $timestamp = time();
    $signature = hash('sha1', "public_id=$public_id&timestamp=$timestamp$api_secret");

    $upload_url = "https://api.cloudinary.com/v1_1/$cloud_name/image/upload";

    $data = [
      'file' => new CURLFile($file_tmp_path),
      'api_key' => $api_key,
      'timestamp' => $timestamp,
      'signature' => $signature,
      'public_id' => $public_id // Include the custom public ID
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $upload_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_CAINFO, $ca_bundle_path); // Use the CA bundle file

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
      die('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);

    $response_data = json_decode($response, true);

    if (isset($response_data['secure_url'])) {
      $image_url = $response_data['secure_url'];
      $image_name = $_POST['image_name'];

      // Prepare SQL statement to insert image into database
      $stmt = $conn->prepare("INSERT INTO gallery (photo, photoname) VALUES (?, ?)");
      $stmt->bind_param("ss", $image_url, $image_name);

      // Execute SQL statement
      if ($stmt->execute()) {
        $upload_message = "Image uploaded successfully.";
      } else {
        $upload_message = "Error uploading image: " . $conn->error;
      }

      // Close statement
      $stmt->close();
    } else {
      $upload_message = "Error uploading image to Cloudinary.";
    }
  }
//delete row
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
      $delete_message = "Image deleted successfully.";
    } else {
      $delete_message = "Error deleting image: " . $conn->error;
    }

    $stmt->close();
  }
//edit image
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $image_name = $_POST['edit_image_name'];

    if (isset($_FILES['edit_file']) && $_FILES['edit_file']['error'] === UPLOAD_ERR_OK) {
      $file_tmp_path = $_FILES['edit_file']['tmp_name'];
      $file_name = $_FILES['edit_file']['name'];
      $public_id = pathinfo($file_name, PATHINFO_FILENAME);

      $timestamp = time();
      $signature = hash('sha1', "public_id=$public_id&timestamp=$timestamp$api_secret");

      $upload_url = "https://api.cloudinary.com/v1_1/$cloud_name/image/upload";

      $data = [
        'file' => new CURLFile($file_tmp_path),
        'api_key' => $api_key,
        'timestamp' => $timestamp,
        'signature' => $signature,
        'public_id' => $public_id
      ];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $upload_url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_VERBOSE, 1);
      curl_setopt($ch, CURLOPT_CAINFO, $ca_bundle_path);

      $response = curl_exec($ch);
      if (curl_errno($ch)) {
        die('Curl error: ' . curl_error($ch));
      }
      curl_close($ch);

      $response_data = json_decode($response, true);

      if (isset($response_data['secure_url'])) {
        $image_url = $response_data['secure_url'];

        $stmt = $conn->prepare("UPDATE gallery SET photo = ?, photoname = ? WHERE id = ?");
        $stmt->bind_param("ssi", $image_url, $image_name, $edit_id);

        if ($stmt->execute()) {
          $update_message = "Image updated successfully.";
        } else {
          $update_message = "Error updating image: " . $conn->error;
        }

        $stmt->close();
      } else {
        $update_message = "Error uploading new image to Cloudinary.";
      }
    } else {
      $stmt = $conn->prepare("UPDATE gallery SET photoname = ? WHERE id = ?");
      $stmt->bind_param("si", $image_name, $edit_id);

      if ($stmt->execute()) {
        $update_message = "Image name updated successfully.";
      } else {
        $update_message = "Error updating image name: " . $conn->error;
      }

      $stmt->close();
    }
  }



  // Fetch all the data from database
  $sql = "SELECT id, photo, photoname FROM gallery";
  $result = $conn->query($sql);

  // Close connection
  $conn->close();
  ?>

  <br>
<!-- green toggle button -->
  <div class="texto">
    <h1>Gallery</h1>&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn  px-4 py-2 rounded-3 fs-6" style="background-color: #50ec96;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i></button>
  </div>
<!-- error messages -->
  <div class="container">
    <?php if (isset($upload_message)) { ?>
      <div id="uploadMessage" class="alert alert-success" role="alert"><?php echo $upload_message; ?></div>
    <?php } ?>
    <?php if (isset($delete_message)) { ?>
      <div id="deleteMessage" class="alert alert-danger" role="alert"><?php echo $delete_message; ?></div>
    <?php } ?>
    <?php if (isset($update_message)) { ?>
      <div id="updateMessage" class="alert alert-success" role="alert"><?php echo $update_message; ?></div>
    <?php } ?>
  <!-- add modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #31343b; border: none;">
          <div class="modal-header" style="border-bottom: none; display: flex; justify-content: center;">
            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Image Upload</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" class="form-control" id="image-name" name="image_name" placeholder="Name of the Image" required>
              </div>
              <div class="mb-3">
                <label for="image-file" class="col-form-label">Insert Image</label>
                <input type="file" class="form-control" id="image-file" name="file" required>
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
<!-- delete modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background-color: #31343b; border: none;">
          <div class="modal-header" style="border-bottom: none;">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this image?
          </div>
          <div class="modal-footer"  style="border-top: none;">
            <form id="deleteForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <input type="hidden" name="delete_id" id="delete_id">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- edit modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="edit_id" id="edit_id">
              <div class="mb-3">
                <label for="edit-image-name" class="col-form-label">Image Name</label>
                <input type="text" class="form-control" id="edit-image-name" name="edit_image_name" required>
              </div>
              <div class="mb-3">
                <label for="edit-image-file" class="col-form-label">Upload New Image (optional)</label>
                <input type="file" class="form-control" id="edit-image-file" name="edit_file">
              </div>
              <div class="mb-3">
                <label>Current Image</label>
                <div id="current-image-container"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Image</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <br>
<!-- display table -->
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name of Photo</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td><img src='" . $row["photo"] . "' width='100' height='100'></td>";
          echo "<td>" . $row["photoname"] . "</td>";
          echo "<td>
          <button class='btn btn-warning edit-btn' data-id='" . $row["id"] . "' data-name='" . $row["photoname"] . "' data-photo='" . $row["photo"] . "' data-bs-toggle='modal' data-bs-target='#editModal'><i class='fa fa-edit'></i> Edit</button>

                  <button class='btn btn-danger' data-id='" . $row["id"] . "' data-bs-toggle='modal' data-bs-target='#deleteModal'><i class='fa fa-trash'></i> Delete</button>
                </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No images found.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script>
    setTimeout(function() {
      var uploadMessage = document.getElementById('uploadMessage');
      if (uploadMessage) {
        uploadMessage.style.display = 'none';
      }
    
    var deleteMessage = document.getElementById('deleteMessage');
      if (deleteMessage) {
        deleteMessage.style.display = 'none';
      }
      var updateMessage = document.getElementById('updateMessage');
      if (updateMessage) {
        updateMessage.style.display = 'none';
      }
    }, 3000);

    document.addEventListener('DOMContentLoaded', function() {
      var deleteModal = document.getElementById('deleteModal');
      deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var deleteIdInput = document.getElementById('delete_id');
        deleteIdInput.value = id;
      });

      var editModal = document.getElementById('editModal');
      editModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var photo = button.getAttribute('data-photo');

        var editIdInput = document.getElementById('edit_id');
        var editNameInput = document.getElementById('edit-image-name');
        var currentImageContainer = document.getElementById('current-image-container');

        editIdInput.value = id;
        editNameInput.value = name;
        currentImageContainer.innerHTML = "<img src='" + photo + "' width='100' height='100'>";
      });
    });
  </script>
</body>

</html>
