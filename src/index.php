<?php 
    
function getBlogPosts() 
{ 
    global $errorMsg, $success; 
    $blogs = []; 

    // Create database connection. 
    $config = parse_ini_file('/var/www/private/db-config.ini'); 
    if (!$config) { 
        $errorMsg = "Failed to read database config file."; 
        $success = false; 
    } else { 
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
        } else { 
            $stmt = $conn->prepare("SELECT title, content, like_count, comment_count FROM blog ORDER BY like_count DESC, comment_count DESC LIMIT 5"); 
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
        } 
        $conn->close(); 
    } 

    return $blogs; 
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
              <div class="slide">
                <div class="slide-img img-1">
                  <a href="#">Solo Travel</a>
                </div>
              </div>
              <div class="slide">
                <div class="slide-img img-2">
                  <a href="#">Mount Travel</a>
                </div>
              </div>
              <div class="slide">
                <div class="slide-img img-3">
                  <a href="#">Jungal Travel</a>
                </div>
              </div>
              <div class="slide">
                <div class="slide-img img-4">
                  <a href="#">Road Travel</a>
                </div>
              </div>
              <div class="slide">
                <div class="slide-img img-5">
                  <a href="#">Osean Travel</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="row card-container">
        <h1>Travel Guides</h1>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h3>Best 10 Things To Do in Egypt</h3>
            <p>Lorem ipsum dolor sit amet, con turadip
              iscingelit. In sed et donec purus viverra. Sit
              justo velit, eu sed</p>
            <a href="#">Solo Travel</a>
            <p>By Edmund Lin</p>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h3>Best 10 Things To Do in Egypt</h3>
            <p>Lorem ipsum dolor sit amet, con turadip
              iscingelit. In sed et donec purus viverra. Sit
              justo velit, eu sed</p>
            <a href="#">Solo Travel</a>
            <p>By Edmund Lin</p>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h3>Best 10 Things To Do in Egypt</h3>
            <p>Lorem ipsum dolor sit amet, con turadip
              iscingelit. In sed et donec purus viverra. Sit
              justo velit, eu sed</p>
            <a href="#">Solo Travel</a>
            <p>By Edmund Lin</p>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h3>Best 10 Things To Do in Egypt</h3>
            <p>Lorem ipsum dolor sit amet, con turadip
              iscingelit. In sed et donec purus viverra. Sit
              justo velit, eu sed</p>
            <a href="#">Solo Travel</a>
            <p>By Edmund Lin</p>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h3>Best 10 Things To Do in Egypt</h3>
            <p>Lorem ipsum dolor sit amet, con turadip
              iscingelit. In sed et donec purus viverra. Sit
              justo velit, eu sed</p>
            <a href="#">Solo Travel</a>
            <p>By Edmund Lin</p>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h3>Best 10 Things To Do in Egypt</h3>
            <p>Lorem ipsum dolor sit amet, con turadip
              iscingelit. In sed et donec purus viverra. Sit
              justo velit, eu sed</p>
            <a href="#">Solo Travel</a>
            <p>By Edmund Lin</p>
          </div>
        </div>
      </section> -->

    <!-- <section class="num-nav mt-3">
        <nav>
          <ul>
            <span class="arrow-left"><i class="fa-solid fa-chevron-left"></i></span>
            <li class="nav-item"><a class="nav-link" href="#">1</a></li>
            <li class="nav-item"><a class="nav-link" href="#">2</a></li>
            <li class="nav-item"><a class="nav-link" href="#">3</a></li>
            <i class="fa-solid fa-chevron-right"></i>
          </ul>
        </nav>
      </section> -->

    <section class="pop-container">
      <h1>Popular Post</h1>
      <div class="row">
        <div class="col-md-12 col-xl-8 pop-post">
        <?php 
          $blogPosts = getBlogPosts();
          foreach ($blogPosts as $blog) : ?>
          <div class="pop-wrapper">
            <img src="/asset/image/index/rectangle-60@2x.png" width="300" height="195">
            <div class="pop-text">
              <h3>13 Things I'd Tell Any New Travler</h3>
              <div class="post-author">
                <a href="#" class="post-link">Post</a>
                <span class="author-name">By Adam Smith</span>
              </div>
              <div class="post-meta">
                <span class="post-date">10 Nov, 2020</span>
                <span class="symbol">&#8212</span>
                <span class="post-comments">50 comments</span>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <!-- <div class="pop-wrapper">
            <img src="/asset/image/index/rectangle-61@2x.png" width="300" height="195">
            <div class="pop-text">
              <h3>13 Things I'd Tell Any New Travler</h3>
              <div class="post-author">
                <a href="#" class="post-link">Post</a>
                <span class="author-name">By Adam Smith</span>
              </div>
              <div class="post-meta">
                <span class="post-date">10 Nov, 2020</span>
                <span class="symbol">&#8212</span>
                <span class="post-comments">50 comments</span>
              </div>
            </div>
          </div>
          <div class="pop-wrapper">
            <img src="/asset/image/index/rectangle-62@2x.png" width="300" height="195">
            <div class="pop-text">
              <h3>13 Things I'd Tell Any New Travler</h3>
              <div class="post-author">
                <a href="#" class="post-link">Post</a>
                <span class="author-name">By Adam Smith</span>
              </div>
              <div class="post-meta">
                <span class="post-date">10 Nov, 2020</span>
                <span class="symbol">&#8212</span>
                <span class="post-comments">50 comments</span>
              </div>
            </div>
          </div>
          <div class="pop-wrapper">
            <img src="/asset/image/index/rectangle-63@2x.png" width="300" height="195">
            <div class="pop-text">
              <h3>13 Things I'd Tell Any New Travler</h3>
              <div class="post-author">
                <a href="#" class="post-link">Post</a>
                <span class="author-name">By Adam Smith</span>
              </div>
              <div class="post-meta">
                <span class="post-date">10 Nov, 2020</span>
                <span class="symbol">&#8212</span>
                <span class="post-comments">50 comments</span>
              </div>
            </div>
          </div> -->
          <!-- <div class="pop-wrapper">
            <img src="/asset/image/index/rectangle-64@2x.png" width="300" height="245">
            <div class="pop-text">
              <h3>13 Things I'd Tell Any New Travler</h3>
              <div class="post-author">
                <a href="#" class="post-link">Post</a>
                <span class="author-name">By Adam Smith</span>
              </div>
              <div class="post-meta">
                <span class="post-date">10 Nov, 2020</span>
                <span class="symbol">&#8212</span>
                <span class="post-comments">50 comments</span>
              </div>
            </div>
          </div> -->
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
            <!-- <div class="country-wrapper">
              <img src="/asset/image/index/rectangle-63@2x.png" width="114" height="79">
              <div class="country-text">
                <h3>countryname</h3>
              </div>
            </div> -->
          </div>
          <!-- <div class="follow-post">
              <h4>Follow Us</h4>
              <div class="follow-icon">
                <a href="https://www.facebook.com" target="_blank" class="social-icon">
                  <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="https://www.twitter.com" target="_blank" class="social-icon">
                  <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com" target="_blank" class="social-icon">
                  <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.youtube.com" target="_blank" class="social-icon">
                  <i class="fa-brands fa-youtube"></i>
              </div>
            </div> -->
          <div class="subscribe-container">
            <h4>Subscribe Today</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. In sed et donec purus viverra. Sit justo</p>
            <form class="subscribe-form">
              <input type="text" placeholder="Full Name" required>
              <input type="email" placeholder="Your Email" required>
              <div class="checkbox-container">
                <input type="checkbox" id="privacy-policy" required>
                <label for="privacy-policy">You Agree To Our Company Privacy Policy</label>
              </div>
              <button type="submit" class="subscribe-btn">SUBSCRIBE</button>
            </form>
          </div>
          <!-- <br>
          <div class="tags-container">
            <h4>Tags</h4>
            <div class="tags">
              <span class="tag">Travel Website</span>
              <span class="tag">Travel Tips</span>
              <span class="tag">Travel Trick</span>
              <span class="tag">Travel Website</span>
              <span class="tag">Travel Tips</span>
              <span class="tag">Travel Trick</span>
              <span class="tag">Travel Website</span>
              <span class="tag">Travel Tips</span>
              <span class="tag">Travel Trick</span>
            </div>
          </div> -->
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

    <!-- <section class="row card-container">
        <h1>Pick A Country & Start Exploring</h1>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h5>Egypt</h5>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h5>Egypt</h5>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h5>Egypt</h5>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h5>Egypt</h5>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h5>Egypt</h5>
          </div>
        </div>
        <div class="col-4 card">
          <img src="/asset/image/index/rectangle-17@2x.png">
          <div class="card-content">
            <h5>Egypt</h5>
          </div>
        </div>
      </section> -->
  </main>

  <?php
    include "component/ending-screen.component.php";
    include "component/footer.component.php";
  ?>
</body>

</html>