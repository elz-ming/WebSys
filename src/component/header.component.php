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

// Usage
$titles = getDistinctTitles();

echo '<header>';
echo '  <div class="row header-bar">';
echo '    <h1 class="col-sm-6 col-lg-3">TravelTalk</h1>';
echo '    <div class="col-sm-6 col-lg-6 search-bar">';

// Start form element
echo '      <form action="blog/index.php" method="GET" class="search-form">';

// Decision node icon placed before the input
echo '        <img class="decision-node-icon" alt="Search" src="/asset/image/index/decision-node.svg" />';

// Update input to include a name attribute and have the form control inline
echo '        <input name="keyword" class="search-input" placeholder="search" type="text" list="titleList"/>';

echo '        <datalist id="titleList">';
foreach ($titles as $title) {
  echo '          <option value="' . htmlspecialchars($title) . '"></option>';
}
echo '        </datalist>';

// Close form element
echo '      </form>';

echo '    </div>';
echo '    <div class="col-3 profile">';
echo '      <img class="decision-node-icon" alt="" src="/asset/image/index/social-media.svg" />';
echo '    </div>';
echo '  </div>';
echo '</header>';

?>