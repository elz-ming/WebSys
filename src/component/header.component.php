<?php
  // Check if session is not already started
  if (session_status() == PHP_SESSION_NONE) {
      session_start(); // Start the session
  }

  // Now, check if the user is logged in and set the variables.
  $isLoggedIn = isset($_SESSION['loggedin']); // Check if the user is logged in.
  $userFirstName = $isLoggedIn ? $_SESSION['first_name'] : '';
  $userLastName = $isLoggedIn ? $_SESSION['last_name'] : '';
?>

<header id="header-bar-js">
  <div class="row header-bar">
    <h1 class="col-sm-6 col-lg-3">TravelTalk</h1>
    <div class="col-sm-6 col-lg-7">
      <?php include "nav.component.php"; ?>
    </div>
    <div class="col-2 profile">
        <!-- Debug: output the session data -->
      <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
        <!-- User is logged in -->
        <div class="user-interaction">
          <span class="user-name">
            <?php echo htmlspecialchars($userFirstName) . ' ' . htmlspecialchars($userLastName); ?>
          </span>
          <a href="javascript:void(0);" id="userIcon">
            <img class="decision-node-icon" alt="Profile" src="/asset/image/index/social-media.svg" />
          </a>
          <div id="dropdown" class="dropdown-content">
            <a href="/asset/php/logout.process.php">Sign out</a>
          </div>
        </div>
      <?php else: ?>
        <!-- User is not logged in -->
        <a href="../../login.php">
          <img class="decision-node-icon" alt="Login" src="/asset/image/index/social-media.svg" />
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>
