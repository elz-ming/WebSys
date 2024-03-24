<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <link rel="stylesheet" href="/asset/css/package.css" />
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
  <main>
  <?php
  // Database connection variables
  $host = "localhost"; // or your database host
  $user = "username"; // your database username
  $password = "password"; // your database password
  $dbname = "database_name"; // your database name

  // Create connection
  $conn = new mysqli($host, $user, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Fetch packages from database
  $sql = "SELECT * FROM package"; // Replace package_table with your actual table name
  $result = $conn->query($sql);
  ?>

  <!-- Package Start -->
  <div class="container-xxl py-5">
      <div class="container">
          <div class="row g-4 justify-content-center">
              <?php if ($result->num_rows > 0): ?>
                  <?php while($row = $result->fetch_assoc()): ?>
                      <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                          <div class="package-item">
                              <!-- Image -->
                              <div class="overflow-hidden">
                                  <img class="img-fluid" src="/asset/image/<?php echo $row['image_path']; ?>" alt="">
                              </div>
                              <!-- Package details -->
                              <div class="d-flex border-bottom">
                                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $row['destination']; ?></small>
                                  <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i><?php echo $row['duration']; ?></small>
                                  <small class="flex-fill text-center py-2"><i class="fa fa-usd text-primary me-2"></i><?php echo $row['price']; ?></small>
                              </div>
                              <div class="text-center p-4">
                                  <h3 class="mb-0"><?php echo $row['pname']; ?></h3>
                                  <p><?php echo $row['content']; ?></p>
                                  <!-- ... buttons and other HTML ... -->
                              </div>
                          </div>
                      </div>

                      <!-- Modal for Package -->
                      <div class="modal fade" id="packageModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="packageModal<?php echo $row['id']; ?>Label" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="packageModal<?php echo $row['id']; ?>Label">Package Details - <?php echo $row['pname']; ?></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <img class="img-fluid mb-3" src="/asset/image/<?php echo $row['image_path']; ?>" alt="<?php echo $row['pname']; ?>">
                                      <h3 class="mb-2"><?php echo $row['price']; ?></h3>
                                      <p class="mb-1"><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
                                      <p class="mb-1"><strong>Duration:</strong> <?php echo $row['duration']; ?></p>
                                      <p class="mb-1"><strong>Content:</strong> <?php echo $row['content']; ?></p>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <a href="checkout.php" class="btn btn-primary">Book Now</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php endwhile; ?>
              <?php else: ?>
                  <p>No packages found.</p>
              <?php endif; ?>
          </div>

          <!-- ... rest of your HTML after the package items ... -->
      </div>
  </div>
  <!-- Package End -->

  <?php
  $conn->close();
  ?>

</main>
   <!-- Package Start -->
   <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">Packages</h1>
            </div>
            <div class="row g-4 justify-content-center">
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="/asset/image/pic1.jpeg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Destination</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>Duration</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-usd text-primary me-2"></i>Price</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">Pname</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Content</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="checkout.php" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Book Now</a>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#packageModal1" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;" data-bs-toggle="modal">View Package</a>                            </div>
                        </div>
                    </div>
                </div>
                
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="/asset/image/pic2.jpeg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Indonesia</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>3 days</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>2 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$139.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="/asset/image/pic3.jpeg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Malaysia</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>3 days</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>2 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$189.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Book Now</a>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="/asset/image/pic3.jpeg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Malaysia</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>3 days</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>2 Person</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$189.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>  
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


    <!-- Modal for Package 1 -->
  <div class="modal fade" id="packageModal1" tabindex="-1" aria-labelledby="packageModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="packageModal1Label">Package Details - Thailand</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img class="img-fluid mb-3" src="/asset/image/pic1.jpeg" alt="Thailand">
          <h3 class="mb-2">$149.00</h3>
          <p class="mb-1"><strong>Destination:</strong> Thailand</p>
          <p class="mb-1"><strong>Duration:</strong> 3 days</p>
          <p class="mb-1"><strong>Content:</strong> Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="checkout.php" class="btn btn-primary">Book Now</a>
        </div>
      </div>
    </div>
  </div>

  
</body>

</html>