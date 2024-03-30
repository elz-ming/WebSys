<?php
  function getBlog() 
  {
    global $blog;

    // Load database config
    $config = parse_ini_file('../../db-config.ini');
    //$config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
        return;
    }

    // Establish database connection
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        return;
    }

    $blog_id = isset($_GET['blog_id']) ? (int) $_GET['blog_id'] : 1;
    $getBlog = $conn->prepare("SELECT * FROM blog WHERE id = ?");
    $getBlog->bind_param("s", $blog_id);
    $getBlog->execute();
    $getBlog = $getBlog->get_result();

    $blog = $getBlog->fetch_assoc();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />
  </head>

  <body>
    <?php
      include "../component/header.component.php";
      include "../component/nav.component.php";
    ?>
    <div id="landing-screen">
      <?php
        getBlog();
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
    <section class = "comments">
      <div class="send-message">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-heading">
                <h2>Leave A Comment</h2>
              </div>
            </div>
            <div class="col-md-8">
              <div class="contact-form">
                  <form id="contact" action="" method="post">
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="col-lg-12">
                          <fieldset>
                          <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                          </fieldset>
                      </div>
                      <div class="row">
                          <div class="fifty-box">
                          <fieldset>
                              <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                          </fieldset>
                          </div>
                          <div class="fifty-box">
                          <fieldset>
                              <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail Address" required="">
                          </fieldset>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 text-center">
                  <fieldset>
                      <button type="submit" id="form-submit" class="filled-button">Load More</button>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
    </section>
    <?php
      include "../component/footer.component.php";
    ?>
  </body>
</html>