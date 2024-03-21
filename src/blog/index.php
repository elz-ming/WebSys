<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <link rel="stylesheet" href="/asset/css/index.css" />
  <link rel="stylesheet" href="/asset/css/blog/main.blog.css" />



  <!--Bootstrap JS-->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
  <!-- Custom JS -->
  <script defer src="/main.js"></script>
  <!-- Tinyslider JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />
</head>

<body>
    
  <section class="header-container">
    <div class="header">
      <div class="header-bar row">
        <h1 class="col-3 company">TravelTalk</h1>
        <div class="col-6 search-bar">
          <img class="decision-node-icon" alt="" src="/asset/image/index/decision-node.svg" />
          <input placeholder="search" type="text" />
        </div>
        <div class="col-3 profile"><img class="decision-node-icon" alt="" src="/asset/image/index/social-media.svg" /></div>
      </div>
      <div class="header-nav mt-3">
        <nav>
          <ul>
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="overlay-bg"><img src="/asset/image/index/rectangle-1.svg" /></div>
    <div class="row intro-container">
      <h1 class="col-12 intro-text">Where will you go next?</h1>
      <div class="intro-content">
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
        sed et donec purus viverra. Sit justo velit, eu sed
        sollicitudin tempus, risus. Sed sit elit mauris adipiscing.
        Lobortis pellentesque nulla accumsan id urna, ullamcorper
        gravida varius. Massa mauris, cursus orci magna non enim fames
        et sed."
      </div>
      <div class="lets-go">Let's Go...</div>
    </div>
  </section>
  <section class="filter-table">
  <form class="filter-row" name="places-list" action="/places">
    <div class="fifty-box">
      <label for="placeType" class="block">
        Filter by type of place
        <select aria-label="Filter by type of place" class="mt-1 w-full bg-white border border-black-200 rounded-lg h-10 cursor-pointer pl-4 pr-8 pt-0 pb-0 disabled:cursor-not-allowed disabled:opacity-20" id="placeType" name="type">
          <option value="All">All types</option>
          <option value="Continent">Continents &amp; subcontinents</option>
          <option value="Region">Regions</option>
          <option value="Country">Countries</option>
          <option value="City" selected="">Cities</option>
          <option value="Neighborhood">Neighborhoods</option>
        </select>
      </label>
    </div>
    <div class="fifty-box">
      <label for="placeSort" class="block">
        Sort places by
        <select aria-label="Sort places by" class="mt-1 w-full bg-white border border-black-200 rounded-lg h-10 cursor-pointer pl-4 pr-8 pt-0 pb-0 disabled:cursor-not-allowed disabled:opacity-20" id="placeSort" name="sort">
          <option value="DESC" selected="">Most Popular</option>
          <option value="ALPHA_ASC">A - Z</option>
          <option value="ALPHA_DESC">Z - A</option>
        </select>
      </label>
    </div>
  </form>
</section>
  <section class="row card-container">
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
    
  </section>
  <section class = "comments">
<div class="send-message">
      <div class="container">
        <div class="row">
          
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
</section>
<footer>
    <section class="video-background">
      <!-- The video -->
      <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
        <source src="https://assets.codepen.io/6093409/river.mp4" type="video/mp4">
      </video>
      <div class="video-overlay">
        <h1>Trips For Your First Solo Traveling</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <!-- <a href="#" class="btn btn-primary video-button">Top</a> -->
      </div>
      <footer class="footer-container">
        <div class="row footer-nav mt-3">
          <div class="col-xs-12 col-md copyright">
            <p>Copyright &copy; ojjomedia All Right Reserved</p>
          </div>
          <div class="col-xs-12 col-md footer-nav-child">
            <nav>
              <ul>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-xs-12 col-md follow-icon">
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
        </div>
      </footer>



</body>