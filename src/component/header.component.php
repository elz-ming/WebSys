<?php
function getDistinctTitles()
{
  global $errorMsg, $success;
  $titles = [];

  // Create database connection.
  $config = parse_ini_file('../../db-config.ini');
  if (!$config) {
    $errorMsg = "Failed to read database config file.";
    $success = false;
    return $titles; // Return early if the config file cannot be read
  }

  $conn = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['dbname']
  );

  // Check connection
  if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
    return $titles; // Return early if connection failed
  } else {
    // Retrieve unique titles from the blog table
    $stmt = $conn->prepare("SELECT DISTINCT title FROM blog WHERE title IS NOT NULL AND title <> ''");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $titles[] = $row['title'];
      }
    } else {
      $errorMsg = "No titles found.";
      $success = false;
    }
    $stmt->close();
  }
  $conn->close();

  return $titles; // Return the final results
}

// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Start the session
}

// Now, check if the user is logged in and set the variables.
$isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in.
$userFirstName = $isLoggedIn ? $_SESSION['first_name'] : '';
$userLastName = $isLoggedIn ? $_SESSION['last_name'] : '';
?>

<style>
.profile .user-info {
display: flex;        /* Establish flex container */
align-items: center;  /* Center flex items vertically */
justify-content: flex-end; /* Aligns items to the end of the container, you can adjust as needed */
}

.user-interaction {
  position: relative;
  cursor: pointer;
}

.user-icon {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

/* Style to show the dropdown */
.show {
  display: block;
}
</style>

<header>
  <div class="row header-bar">
    <h1 class="col-sm-6 col-lg-3">TravelTalk</h1>
    <div class="col-sm-6 col-lg-6 search-bar">
      <img class="decision-node-icon" alt="Search" src="/asset/image/index/decision-node.svg" />
      <form action="blog/index.php" method="GET" class="search-form">
        <input name="keyword" class="search-input" placeholder="search" type="text" list="titleList"/>
      </form>
    </div>
    <div class="col-3 profile">
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

<script>
// Wait for the DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
  // Toggle the dropdown when clicking on the user icon
  document.getElementById('userIcon').addEventListener('click', function() {
    document.getElementById('dropdown').classList.toggle('show');
  });

  // Close the dropdown if clicking outside of it
  window.addEventListener('click', function(event) {
    if (!event.target.matches('#userIcon') && !event.target.matches('.decision-node-icon')) {
      var dropdown = document.getElementById('dropdown');
      if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    }
  });
});
</script>
