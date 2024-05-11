<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Drop Down Navigation Menu | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="#">CodingLab</a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">
          <li><a href="#">HOME</a></li>
          <li>
            <a href="#">HTML & CSS</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Login Forms</a></li>
              <li><a href="#">Card Design</a></li>
            </ul>
          </li>
          <li><a href="#">ABOUT US</a></li>
          <li><a href="#">CONTACT US</a></li>
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
