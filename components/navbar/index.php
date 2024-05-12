

<!DOCTYPE html>
<!-- Designed by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <!-- Googlefont Poppins CDN Link -->
  <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap' rel='stylesheet'>

  <style>
    /* Color Variables */
    :root {
      --primary-color: #000000; /* Black background */
      --text-color: #ffffff; /* White text */
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    nav {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 70px;
      background-color: var(--primary-color); /* Set nav background color to black */
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
      z-index: 99;
    }

    nav .navbar {
      height: 100%;
      max-width: 1250px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: auto;
      padding: 0 50px;
    }

    .navbar .logo a {
      font-size: 30px;
      color: var(--text-color);
      text-decoration: none;
      font-weight: 600;
    }
    .logo img {
      width: 250px;
    }

    nav .navbar .nav-links {
      line-height: 70px;
      height: 100%;
    }

    nav .navbar .links {
      display: flex;
    }

    nav .navbar .links li {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: space-between;
      list-style: none;
      padding: 0 14px;
    }

    nav .navbar .links li a {
      height: 100%;
      text-decoration: none;
      white-space: nowrap;
      color: var(--text-color);
      font-size: 15px;
      font-weight: 500;
    }

    .links li:hover .htmlcss-arrow,
    .links li:hover .js-arrow {
      transform: rotate(180deg);
    }

    nav .navbar .links li .arrow {
      height: 100%;
      width: 22px;
      line-height: 70px;
      text-align: center;
      display: inline-block;
      color: var(--text-color);
      transition: all 0.3s ease;
    }

    nav .navbar .links li .sub-menu {
      position: absolute;
      top: 70px;
      left: 0;
      line-height: 40px;
      background: var(--primary-color);
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
      border-radius: 0 0 4px 4px;
      display: none;
      z-index: 2;
    }

    nav .navbar .links li:hover .htmlCss-sub-menu,
    nav .navbar .links li:hover .js-sub-menu {
      display: block;
    }

    .navbar .links li .sub-menu li {
      padding: 0 22px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navbar .links li .sub-menu a {
      color: var(--text-color);
      font-size: 15px;
      font-weight: 500;
    }

    .navbar .links li .sub-menu .more-sub-menu {
      position: absolute;
      top: 0;
      left: 100%;
      border-radius: 0 4px 4px 4px;
      z-index: 1;
      display: none;
    }

    .links li .sub-menu .more:hover .more-sub-menu {
      display: block;
    }

    .navbar .search-box {
      position: relative;
      height: 40px;
      width: 40px;
    }

    .navbar .search-box i {
      position: absolute;
      height: 100%;
      width: 100%;
      line-height: 40px;
      text-align: center;
      font-size: 22px;
      color: var(--text-color);
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .navbar .search-box .input-box {
      position: absolute;
      right: calc(100% - 40px);
      top: 80px;
      height: 60px;
      width: 300px;
      background: var(--primary-color);
      border-radius: 6px;
      opacity: 0;
      pointer-events: none;
      transition: all 0.4s ease;
    }

    .navbar.showInput .search-box .input-box {
      top: 65px;
      opacity: 1;
      pointer-events: auto;
      background: var(--primary-color);
    }

    .search-box .input-box::before {
      content: '';
      position: absolute;
      height: 20px;
      width: 20px;
      background: var(--primary-color);
      right: 10px;
      top: -6px;
      transform: rotate(45deg);
    }

    .search-box .input-box input {
      position: absolute;
      top: 50%;
      left: 50%;
      border-radius: 4px;
      transform: translate(-50%, -50%);
      height: 35px;
      width: 280px;
      outline: none;
      padding: 0 15px;
      font-size: 16px;
      border: none;
    }

    .navbar .nav-links .sidebar-logo {
      display: none;
    }

    .navbar .bx-menu {
      display: none;
    }

    .sidebar-opened {
      background-color: #000000; /* Black background */
    }

    .sidebar-opened a {
      color: #ffffff; /* White text */
    }

    .sidebar-opened .logo {
      left: 250px;
    }

    @media (max-width: 920px) {
      nav .navbar {
        max-width: 100%;
        padding: 0 25px;
      }

      nav .navbar .logo a {
        font-size: 27px;

      }

      nav .navbar .links li {
        padding: 0 10px;
        white-space: nowrap;
      }

      nav .navbar .links li a {
        font-size: 15px;
      }
    }

    @media (max-width: 800px) {
      .navbar .bx-menu {
        display: block;
      }

      nav .navbar .nav-links {
        position: fixed;
        top: 0;
        left: -100%;
        display: block;
        max-width: 270px;
        width: 100%;
        line-height: 40px;
        padding: 20px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.5s ease;
        z-index: 1000;
      }

      .navbar .nav-links .sidebar-logo {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .sidebar-logo .logo-name {
        font-size: 25px;
        color: var(--text-color);
      }

      .sidebar-logo i,
      .navbar .bx-menu {
        font-size: 25px;
        color: var(--text-color);
      }
      nav .navbar .links {
        display: block;
        margin-top: 20px;
      }

      nav .navbar .links li .arrow {
        line-height: 40px;
      }

      nav .navbar .links li {
        display: block;
      }

      nav .navbar .links li .sub-menu {
        position: relative;
        top: 0;
        box-shadow: none;
        display: none;
      }

      nav .navbar .links li .sub-menu li {
        border-bottom: none;
      }

      .navbar .links li .sub-menu .more-sub-menu {
        display: none;
        position: relative;
        left: 0;
      }

      .navbar .links li .sub-menu .more-sub-menu li {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .links li:hover .htmlcss-arrow,
      .links li:hover .js-arrow {
        transform: rotate(0deg);
      }

      .navbar .links li .sub-menu .more-sub-menu {
        display: none;
      }

      .navbar .links li .sub-menu .more span {
        display: flex;
        align-items: center;
      }

      .links li:hover .htmlCss-sub-menu,
      .links li:hover .js-sub-menu {
        display: none;
      }

      .navbar .nav-links.show1 .links .htmlCss-sub-menu,
      .navbar .nav-links.show3 .links .js-sub-menu,
      .navbar .nav-links.show2 .links .more .more-sub-menu {
        display: block;
      }

      .navbar .nav-links.show1 .links .htmlcss-arrow,
      .navbar .nav-links.show3 .links .js-arrow {
        transform: rotate(180deg);
      }

      .navbar .nav-links.show2 .links .more-arrow {
        transform: rotate(90deg);
      }
    }

    @media (max-width: 370px) {
      nav .navbar .nav-links {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
<nav>
  <div class="navbar">
    <i class='bx bx-menu'></i>
    <div class="logo">
      <a href="#">
        <img src="../assets/logo-1.png" alt="Logo">
      </a>
    </div>
    <div class="nav-links">
      <div class="sidebar-logo">
        <i class='bx bx-x' ></i>
      </div>
      <ul class="links">
        <?php if(isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
          <!-- Navbar items for admin -->
          <li><a href="#">HOME</a></li>
          <li>
            <a href="#">EVENTS</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow'></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="#">UPCOMING EVENTS</a></li>
              <li><a href="#">COMPLETED EVENTS</a></li>
            </ul>
          </li>
          <li><a href="#">GALLERY</a></li>
          <li><a href="#">BROCHURE</a></li>
          <li><a href="#">ADMISSION</a></li>
        <?php else: ?>
          <!-- Navbar items for non-admin users -->
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Pricing</a></li>
          <li><a href="#">Contact</a></li>
        <?php endif; ?>
        <?php if(isset($_SESSION['username'])): ?>
          <!-- Common Navbar items for logged in users -->
          <li class="user-profile">
            <a href="#">
              <?php echo $_SESSION['username']; ?>
            </a>
            <i class='bx bxs-user-circle arrow'></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="../Logout/index.php">LOGOUT</a></li>
              <li><a href="#">PROFILE</a></li>
            </ul>
          </li>
        <?php else: ?>
          <!-- Navbar items for non-logged in users -->
          <li><a href="#">User</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>



<script>
  let navLinks = document.querySelector(".nav-links");
  let menuOpenBtn = document.querySelector(".navbar .bx-menu");
  let menuCloseBtn = document.querySelector(".nav-links .bx-x");

  menuOpenBtn.onclick = function() {
    navLinks.style.left = "0";
    // Hide the menu open button
    menuOpenBtn.style.display = "none";
    // Show the menu close button
    menuCloseBtn.style.display = "block";
    // Add class to change background color and text color
    navLinks.classList.add("sidebar-opened");
  }

  menuCloseBtn.onclick = function() {
    navLinks.style.left = "-100%";
    // Show the menu open button
    menuOpenBtn.style.display = "block";
    // Hide the menu close button
    menuCloseBtn.style.display = "none";
    // Remove class to revert background color and text color
    navLinks.classList.remove("sidebar-opened");
  }

  // sidebar submenu open close js code
  let htmlcssArrow = document.querySelector(".htmlcss-arrow");
  htmlcssArrow.onclick = function() {
    navLinks.classList.toggle("show1");
  }

  let moreArrow = document.querySelector(".more-arrow");
  moreArrow.onclick = function() {
    navLinks.classList.toggle("show2");
  }

  let jsArrow = document.querySelector(".js-arrow");
  jsArrow.onclick = function() {
    navLinks.classList.toggle("show3");
  }
</script>
</body>
</html>
