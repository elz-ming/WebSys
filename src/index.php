<?php

function getBlogPostsAndCategories()
{
  global $errorMsg, $success;
  $blogs = [];
  $categories = [];

  // Create database connection.
  $config = parse_ini_file('../db-config.ini');
  if (!$config) {
    $errorMsg = "Failed to read database config file.";
    $success = false;
    return ['blogs' => $blogs, 'categories' => $categories]; // Return even if config file cannot be read
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
    return ['blogs' => $blogs, 'categories' => $categories]; // Return if connection failed
  } else {
    // Retrieve blog posts with user information and formatted date
    $stmt = $conn->prepare("
          SELECT b.*, u.first_name, u.last_name, DATE_FORMAT(b.created_at, '%e %M %Y') AS formatted_date
          FROM blog b
          LEFT JOIN user u ON b.user_id = u.id
          ORDER BY b.like_count DESC, b.comment_count DESC
          LIMIT 5
      ");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
      }
    } else {
      $errorMsg = "No blog posts found.";
      $success = false;
    }
    $stmt->close();

    // Retrieve categories
    $stmt = $conn->prepare("SELECT name, image_path FROM category");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
      }
    } else {
      $errorMsg = "No categories found.";
      $success = false;
    }
    $stmt->close();
  }
  $conn->close();

  return ['blogs' => $blogs, 'categories' => $categories]; // Return the final results
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Main JS -->
  <link rel="stylesheet" href="/asset/css/main.css" />
  <script defer src="/asset/js/main.js"></script>

  <!-- Page JS -->
  <link rel="stylesheet" href="/asset/css/index.css" />
  <script defer src="/asset/js/index.js"></script>

  <!--Bootstrap JS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

  <!-- Tinyslider JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>

  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />
</head>

<body>
  <?php

    include "component/header.component.php";
    include "component/nav.component.php";
    include "component/landing-screen.component.php";
  ?>

  <main class="containers">
    <section id="slider">
      <h1>Choose a Category</h1>
      <div class="carousel">
        <div class="subcarousel">
          <div class="slider-wrapper">
            <br>
            <div class="my-slider">
              <?php
                $data = getBlogPostsAndCategories(); // Assuming this function returns an array with 'blogs' and 'categories'
                if (!empty($data['categories'])) {
                  foreach ($data['categories'] as $category) {
                    $name = htmlspecialchars($category['name']);
                    $imagePath = htmlspecialchars($category['image_path']);
                    // Use echo to output the HTML structure
                    echo "<div class='slide'>";
                    echo "<div class='slide-img' style='background-image: url(\"$imagePath\");'>";
                    echo "<a href='#'>$name</a>"; // Replace '#' with the actual link to the category
                    echo "</div>";
                    echo "</div>";
                  }
                } else {
                  echo "<p>No categories found.</p>";
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="pop-container">
      <h1>Popular Post</h1>
      <div class="row">
        <div class="col-md-12 col-xl-8 pop-post">
          <?php
            $data = getBlogPostsAndCategories();
            if (!empty($data['blogs'])) {
              foreach ($data['blogs'] as $blog) {
                $imagePath = isset($blog['image_path']) ? htmlspecialchars($blog['image_path']) : 'default-image-path.jpg';
                $title = isset($blog['title']) ? htmlspecialchars($blog['title']) : 'No Title';

                $firstName = isset($blog['first_name']) ? htmlspecialchars($blog['first_name']) : '';
                $lastName = isset($blog['last_name']) ? htmlspecialchars($blog['last_name']) : '';
                $authorFullName = trim($firstName . ' ' . $lastName);
                $authorFullName = !empty($authorFullName) ? $authorFullName : 'Unknown Author';

                $formattedDate = $blog['formatted_date'] ?? 'No Date';
                $commentCount = (int) ($blog['comment_count'] ?? 0);
                $likesCount = (int) ($blog['like_count'] ?? 0);

                echo "<div class='row col-8 pop-wrapper mx-auto'>";
                echo "<img class='col-xs-12 col-md-6' src='{$imagePath}' alt='{$title}' width='300' height='175'>";
                echo "<div class='col-xs-12 col-md-6 pop-text'>";
                echo "<h3>{$title}</h3>";
                echo "<div class='post-author'>";
                echo "<a href='#' class='post-link'>Post</a>";
                echo "<span class='author-name'>By {$authorFullName}</span>";
                echo "</div>";
                echo "<div class='post-meta'>";
                // Inside your HTML where you're outputting the date:
                echo "<span class='post-date'>{$blog['formatted_date']}</span>";
                echo "<span class='symbol'>&#8212;</span>";
                echo "<span class='post-comments'>{$commentCount} comments</span> | ";
                echo "<span class='post-likes'>{$likesCount} likes</span>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
            } else {
              echo "<p>No popular posts to display.</p>";
            }
          ?>
        </div>
        <div class="col-md-12  col-xl-3">
          <div class="country-post">
            <h4>Pick a Country</h4>
            <div class="country-wrapper">
              <img src="/asset/image/index/rectangle-60@2x.png" width="114" height="79">
              <div class="country-text">
                <h3>countryname</h3>
              </div>
            </div>
            <div class="country-wrapper">
              <img src="/asset/image/index/rectangle-61@2x.png" width="114" height="79">
              <div class="country-text">
                <h3>countryname</h3>
              </div>
            </div>
            <div class="country-wrapper">
              <img src="/asset/image/index/rectangle-62@2x.png" width="114" height="79">
              <div class="country-text">
                <h3>countryname</h3>
              </div>
            </div>
            <div class="country-wrapper">
              <img src="/asset/image/index/rectangle-64@2x.png" width="114" height="79">
              <div class="country-text">
                <h3>countryname</h3>
              </div>
            </div>
          </div>
          <div class="subscribe-container" id="subscribe">
            <h4>Subscribe Today</h4>
            <p>Embark on adventures with us! Subscribe now for exclusive travel tips, inspiring stories, and special
              package offers delivered directly to your inbox</p>
            <form action="/asset/php/subscribe.process.php" method="post" class="subscribe-form">
              <input type="text" name="fullname" placeholder="Full Name" required maxlength="45">
              <input type="email" name="email" placeholder="Your Email" required>
              <div class="checkbox-container">
                <input type="checkbox" id="privacy-policy" required>
                <label for="privacy-policy">You Agree To Our Company Privacy Policy</label>
              </div>
              <button type="submit" class="subscribe-btn">SUBSCRIBE</button>
            </form>
          </div>
          <!-- Thank You Modal -->
          <div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="thankYouModalLabel">Thank You</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Thank you for subscribing!
                </div>
              </div>
            </div>
          </div>

          <!-- Already Subscribed Modal -->
          <div class="modal fade" id="alreadySubscribedModal" tabindex="-1"
            aria-labelledby="alreadySubscribedModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="alreadySubscribedModalLabel">Already Subscribed</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  The email is already subscribed.
                </div>
              </div>
            </div>
          </div>
          <!-- Failure Modal -->
          <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="failureModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="failureModalLabel">Oops!</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Something went wrong with your subscription. Please try again later.
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <section class="num-nav mt-3">
      <nav>
        <ul>
          <span class="arrow-left"><i class="fa-solid fa-chevron-left"></i></span>
          <li class="nav-item"><a class="nav-link" href="#">1</a></li>
          <li class="nav-item"><a class="nav-link" href="#">2</a></li>
          <li class="nav-item"><a class="nav-link" href="#">3</a></li>
          <i class="fa-solid fa-chevron-right"></i>
        </ul>
      </nav>
    </section>
  </main>

  <?php
    include "component/ending-screen.component.php";
    include "component/footer.component.php";
  ?>
</body>

</html>