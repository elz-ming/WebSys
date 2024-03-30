<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Main JS -->
		<link rel="stylesheet" href="/asset/css/main.css" />
		<script defer src="/asset/js/main.js"></script>

		<!-- Page JS -->
		<link rel="stylesheet" href="/asset/css/about.css" />
		<script defer src="/asset/js/about.js"></script>

		<!--Bootstrap JS-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
		
		<!-- Tinyslider JS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
		
		<!--Font Awesome-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" />
    <title>Packages</title>
	</head>

	<body>
		<?php

      include "component/header.component.php";
      include "component/nav.component.php";
      include "component/landing-screen.component.php";

      // Load database config
      $config = parse_ini_file('../db-config.ini');
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

      // Fetch packages from the database
      $sql = "SELECT * FROM package"; // Adjust the table name and columns as per your database
      $result = $conn->query($sql);
    ?>
		    <main>
       <!-- Package Start -->
      <div class="container-xxl py-5">
        <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Packages</h1>
          </div>
          <div class="row g-4 justify-content-center">
            <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $shortenedContent = substr($row["content"], 0, 50) . '...';

                      // Check if the user is logged in
                      if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                        $bookNowButton = '<a href="login.php" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Login to Book</a>';
                    } else {
                        $bookNowButton = '<a href="checkout.php?package_id=' . $row["id"] . '" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Book Now</a>';
                    }

                  echo '
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                      <div class="package-item">
                        <div class="overflow-hidden">
                          <img class="img-fluid" src="' . $row["image_path"] . '" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                          <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>' . $row["destination"] . '</small>
                          <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>' . $row["duration"] . '</small>
                          <small class="flex-fill text-center py-2"><i class="fa fa-usd text-primary me-2"></i>' . $row["price"] . '</small>
                        </div>
                        <div class="text-center p-4">
                          <h3 class="mb-0">' . $row["pname"] . '</h3>
                          <p>' . $shortenedContent . '</p>
                          <div class="d-flex justify-content-center mb-2">
                              ' . $bookNowButton . '
                          </div>
                          <div class="d-flex justify-content-center mb-2">
                          <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;" data-bs-toggle="modal" data-bs-target="#packageModal" data-package-id="' . $row["id"] . '">Read More</a>
                          </div>

                        </div>
                      </div>
                    </div>
                  ';
                }
              } else {
                echo "<p>No packages found.</p>";
              }
            ?>
          </div>
        </div>
      </div>
      <!-- Package End -->

          <!-- Process Start -->
          <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Process</h1>
                </div>
                <div class="row gy-5 gx-4 justify-content-center">
                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="position-relative border border-primary pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <i class="fa fa-globe fa-3x text-white"></i>
                            </div>
                            <h5 class="mt-4">Choose A Destination</h5>
                            <hr class="w-25 mx-auto bg-primary mb-1">
                            <hr class="w-50 mx-auto bg-primary mt-0">
                            <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="position-relative border border-primary pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <i class="fa fa-dollar-sign fa-3x text-white"></i>
                            </div>
                            <h5 class="mt-4">Pay Online</h5>
                            <hr class="w-25 mx-auto bg-primary mb-1">
                            <hr class="w-50 mx-auto bg-primary mt-0">
                            <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="position-relative border border-primary pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <i class="fa fa-plane fa-3x text-white"></i>
                            </div>
                            <h5 class="mt-4">Fly Today</h5>
                            <hr class="w-25 mx-auto bg-primary mb-1">
                            <hr class="w-50 mx-auto bg-primary mt-0">
                            <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Process Start -->

      <!-- Modal for Package -->
      <div class="modal fade" id="packageModal" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle">Package Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img class="img-fluid mb-3" id="modalImage" src="" alt="Package Image">
              <h3 class="mb-2" id="modalPrice"></h3>
              <p class="mb-1"><strong>Destination:</strong> <span id="modalDestination"></span></p>
              <p class="mb-1"><strong>Duration:</strong> <span id="modalDuration"></span></p>
              <p class="mb-1"><strong>Content:</strong> <span id="modalContent"></span></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
  </main>

  <script src="asset/js/package.js"></script>

		<?php
      $conn->close();
      include "component/footer.component.php";
    ?>
	</body>
</html>