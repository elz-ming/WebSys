<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getBlog()
{
  global $blog;

  // Establish database connection
  include "connectDB.php";

  $blog_id = isset ($_GET['blog_id']) ? (int) $_GET['blog_id'] : 1;
  $getBlog = $conn->prepare("SELECT * FROM blog WHERE id = ?");
  $getBlog->bind_param("s", $blog_id);
  $getBlog->execute();
  $getBlog = $getBlog->get_result();

  $blog = $getBlog->fetch_assoc();
}

function getComments($blog_id)
{
  // Establish database connection
  include "connectDB.php";

  $stmt = $conn->prepare("SELECT comment.content, comment.created_at, user.first_name, user.last_name, user.image_path FROM comment JOIN user ON comment.user_id = user.id WHERE blog_id = ? ORDER BY comment.created_at DESC");
  $stmt->bind_param("i", $blog_id);
  $stmt->execute();
  $result = $stmt->get_result();

  $comments = [];
  while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
  }

  $stmt->close();
  $conn->close();

  return $comments;
}

// To covert the created_at timestamp to a human-readable format
function time_elapsed_string($datetime, $full = false)
{
  $now = new DateTime();
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $weeks = floor($diff->d / 7);
  $daysAfterWeeks = $diff->d % 7;

  $string = array(
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  );

  $stringValues = array(
    'y' => $diff->y,
    'm' => $diff->m,
    'w' => $weeks,
    'd' => $daysAfterWeeks,
    'h' => $diff->h,
    'i' => $diff->i,
    's' => $diff->s,
  );

  foreach ($string as $key => &$value) {
    if ($stringValues[$key]) {
      $value = $stringValues[$key] . ' ' . $value . ($stringValues[$key] > 1 ? 's' : '');
    } else {
      unset($string[$key]);
    }
  }

  if (!$full) {
    $string = array_slice($string, 0, 1);
  }

  return $string ? implode(', ', $string) . ' ago' : 'just now';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Page Logo -->
  <link rel="icon" type="image/png" href="/asset/image/favicon.png">

  <title>
    <?php
      getBlog();
      echo $blog['title'];
    ?>
  </title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <!-- Main JS -->
  <link rel="stylesheet" href="/asset/css/main.css" />
  <script defer src="/asset/js/main.js"></script>

  <!-- Page JS -->
  <link rel="stylesheet" href="/asset/css/blog/post.css" />
  <script defer src="/asset/js/blog/post.js"></script>

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
  include "../component/header.component.php";

  if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
  }

  if (!isset($_SESSION['user_id'])) { 
    // Store the current URL or relevant identifier in the session
    $_SESSION['redirect_after_login'] = '/blog/post.php?blog_id=' . $_GET['blog_id'];
  }
  ?>
  <div id="landing-screen">
    <?php
    echo "<div class='header-container' style='background-image: url(" . htmlspecialchars($blog['image_path']) . ");'>";
    ?>
    <div class="overlay-bg">
      <img src="/asset/image/index/rectangle-1.svg" />
    </div>
    <div class="row intro-container">
      <?php
      echo "<h1 class='col-12 intro-text'>" . htmlspecialchars($blog['title']) . "</h1>";
      echo "<div class='intro-content'>" . htmlspecialchars($blog['subtitle']) . "</div>";
      ?>
      <div class="lets-go">Let's Go...</div>
    </div>
  </div>
  </div>
  <main>
    <section id="introduction" class="blog-container">
      <?php
      // Introduction Paragraph
      echo "<h2>" . "Introduction" . "</h2>";
      echo "<p>" . htmlspecialchars($blog['para_intro']) . "</p>";
      ?>
    </section>

    <section id="para_1" class="blog-container">
      <?php
      // Introduction Paragraph
      echo "<h2>" . htmlspecialchars($blog['heading_1']) . "</h2>";
      echo "<p>" . htmlspecialchars($blog['para_1']) . "</p>";
      ?>
    </section>

    <section id="para_2" class="blog-container">
      <?php
      // Introduction Paragraph
      echo "<h2>" . htmlspecialchars($blog['heading_2']) . "</h2>";
      echo "<p>" . htmlspecialchars($blog['para_2']) . "</p>";
      ?>
    </section>

    <section id="para_3" class="blog-container">
      <?php
      // Introduction Paragraph
      echo "<h2>" . htmlspecialchars($blog['heading_3']) . "</h2>";
      echo "<p>" . htmlspecialchars($blog['para_3']) . "</p>";
      ?>
    </section>
  </main>

  <section class="comments">
    <div class="send-message">
      <div class="container" id="comments">
        <h3>Comments</h3>
        <?php $comments = getComments($blog['id']); ?>
        <?php if (!empty ($comments)): ?>
          <div class="comments-container">
            <?php foreach ($comments as $comment): ?>
              <div class="comment-block">
                <div class="empty-container-before-comment">
                  <img src=<?php echo $comment['image_path']; ?> alt="Profile Picture" class="profile-pic">
                  <div class="row comment-info">
                    <span><?php echo $comment['first_name'] . '' . $comment['last_name']; ?></span>
                    <span class="timestamp">
                    Posted: <?php echo time_elapsed_string($comment['created_at']); ?>
                    </span>
                  </div>
                </div>
                <div class="comment">
                  <?php echo html_entity_decode($comment['content']); ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p>No comments yet. Be the first to comment!</p>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Leave A Comment</h2>
            </div>
          </div>
          <div class="col-md-12">
            <div class="contact-form">
              <!-- Single form with the correct action attribute -->
              <form id="contact" action="../asset/php/post_comment.php" method="post">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <!-- Hidden field for the blog ID -->
                      <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($blog['id']); ?>">
                      <!-- Textarea for the comment -->
                      <textarea name="comment" rows="6" class="form-control" id="message" placeholder="Your Message" required="" style="width: 100%; height: 200px;"><?php 
                          if (isset($_SESSION['temp_comment']) && $_SESSION['temp_blog_id'] == $blog['id']) {
                              echo html_entity_decode($_SESSION['temp_comment']);
                              unset($_SESSION['temp_comment']); // Clear after displaying
                              unset($_SESSION['temp_blog_id']); // Clear after displaying
                          }
                        ?></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12 text-center">
                    <fieldset>
                      <!-- Submit button for the form -->
                      <button type="submit" id="form-submit" class="filled-button">Post Comment</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
  </section>

  <?php
    include "../component/footer.component.php";
  ?>
</body>

</html>