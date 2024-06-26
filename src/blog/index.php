<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Page Logo -->
  <link rel="icon" type="image/png" href="/asset/image/favicon.png"></link>


  <title>Blogs</title>

  <!-- Main JS -->
  <link rel="stylesheet" href="/asset/css/main.css" /></link>
  <script defer src="/asset/js/main.js"></script>

  <!-- Page JS -->
  <link rel="stylesheet" href="/asset/css/blog/index.css" /></link>
  <script defer src="/asset/js/blog/index.js"></script>

  <!--Bootstrap JS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"></link>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

  <!-- Tinyslider JS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" /></link>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>

  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"></link>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" /></link>
</head>

<body>
  <?php
  include "../component/header.component.php";
  include "../component/landing-screen.component.php";

  $type = isset($_GET['type']) ? $_GET['type'] : null;
  $detail = isset($_GET['detail']) ? $_GET['detail'] : null;
  ?>
  <main>
    <section class="filter-table">
      <form class="filter-row" name="places-list" action="/places">
        <div class="fifty-box">
          <label for="placeType" class="block">
            Show by:
            <select aria-label="Filter" id="placeType" name="type"
              class="mt-1 w-full bg-white border border-black-200 rounded-lg h-10 cursor-pointer pl-4 pr-8 pt-0 pb-0 disabled:cursor-not-allowed disabled:opacity-20">
              <option value="all" selected>All</option>
              <option value="country">Country</option>
              <option value="category">Category</option>
            </select>
          </label>
          <label for="placeSort" class="block">
            Filter by:
            <select aria-label="Detail" id="placeSort" name="sort" class="mt-1 w-full bg-white border border-black-200 rounded-lg h-10 cursor-pointer pl-4 pr-8 pt-0 pb-0 disabled:cursor-not-allowed disabled:opacity-20">
            </select>
          </label>
          <button type="button" id="searchButton">Search</button>
        </div>
        <!-- <div class="fifty-box">
          <label for="placeSort" class="block">
            Filter by:
            <select aria-label="Detail" id="placeSort" name="sort" class="mt-1 w-full bg-white border border-black-200 rounded-lg h-10 cursor-pointer pl-4 pr-8 pt-0 pb-0 disabled:cursor-not-allowed disabled:opacity-20">
            </select>
          </label>
        </div> -->
        <!-- <button type="button" id="searchButton">Search</button> -->
      </form>
    </section>
    <section class="row card-container">

    </section>
    <?php
    include "../component/footer.component.php";
    ?>
</body>

</html>
