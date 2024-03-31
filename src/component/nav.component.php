<?php
  // Check if session is not already started
  if (session_status() == PHP_SESSION_NONE) {
      session_start(); // Start the session
  }

  // Now, check if the user is logged in and set the variables.
  $isAdmin = isset($_SESSION['admin']); // Check if the user is logged in.
?>

<nav class="navbar navbar-expand-lg" id="navbar">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="header-nav">
      <ul>
        <li class="nav-item">
          <a class="nav-link" href="/index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/about.php">About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/package.php">Package</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="/blog/index.php">Blog</a>
        </li>
        
        <?php if (isset($isAdmin) && $isAdmin): ?>
        <!-- User is admin -->
          <li class="nav-item">
            <a class="nav-link" href="/admin.php">Admin</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>