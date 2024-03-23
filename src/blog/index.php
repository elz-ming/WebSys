<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <!-- Main JS -->
  <link rel="stylesheet" href="/asset/css/main.css" />
  <script defer src="/asset/js/main.js"></script>

  <!-- Page JS -->
  <link rel="stylesheet" href="/asset/css/blog/index.css" />
  <script defer src="/asset/js/blog/index.js"></script>

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
    include "../component/landing-screen.component.php";
  ?>
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
    <?php
      include "../component/ending-screen.component.php";
      include "../component/footer.component.php";
    ?>
  </body>
</html>