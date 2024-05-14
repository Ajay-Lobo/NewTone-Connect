<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="style.css" />
    <style>
       
        
    </style>
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
    // Check if file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Check file extension
        if (in_array($file_extension, $allowed_types)) {
            // Read image data into a variable
            $img_data = file_get_contents($_FILES['image']['tmp_name']);

            // Prepare SQL statement to insert image into database
            $stmt = $conn->prepare("INSERT INTO gallery (photo) VALUES (?)");
            $stmt->bind_param("b", $img_data);

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "Image uploaded successfully.";
            } else {
                echo "Error uploading image: " . $conn->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Invalid file type. Allowed types are: jpg, jpeg, png, gif";
        }
    } else {
        echo "Error uploading image: " . $_FILES["image"]["error"];
    }
}

// Fetch images from database
$sql = "SELECT id, photo,photoname FROM gallery";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>
<br>

<!-- <div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

    <div class="row">
      <h2>Upload Images</h2>
      <div class="input-group input-group-icon">
      <input type="file" name="image" placeholder="Image"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
        <button type="submit" name="submit">Upload</button>
      </div>

  </form>
  </div>
</div> -->
<br>
<br>
<div class="texto">
<h1>Gallery</h1>&nbsp;&nbsp;&nbsp;&nbsp;
  <button class="addButton" id="addButton">+</button>
</div>
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Insert Image</h2>
    <form id="imageForm" method="post" action="insert_image.php" enctype="multipart/form-data">
      <input type="file" name="image" id="image" required>
      <button type="submit">Upload Image</button>
    </form>
  </div>
</div>
  <br>
        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name of Photo</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["photo"]) . "' width='100' height='100'></td>";
                    echo "<td>" . $row["photoname"] . "</td>";

                    echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No images found.</td></tr>";
            }
            ?>
        </table>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("addButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>
