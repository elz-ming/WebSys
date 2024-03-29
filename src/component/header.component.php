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
?>

<style>
  .profile .user-info {
  display: flex;        /* Establish flex container */
  align-items: center;  /* Center flex items vertically */
  justify-content: flex-end; /* Aligns items to the end of the container, you can adjust as needed */
}

.profile .user-name {
  margin-right: 10px; /* Adjust space between name and icon as needed */
  margin-top: 15px; /* Adjust space between name and icon as needed */
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
      <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
        <span class="user-name">
          <?php echo htmlspecialchars($userFirstName) . ' ' . htmlspecialchars($userLastName); ?>
        </span>
        <a href="/asset/php/logout.process.php">
          <img class="decision-node-icon" alt="Profile" src="/asset/image/index/social-media.svg" />
        </a>
      <?php else: ?>
        <a href="/login.php">
          <img class="decision-node-icon" alt="Login" src="/asset/image/index/social-media.svg" />
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>