<?php
function getPackages() {
    global $packages;

    // Load database config
    $config = parse_ini_file('../db-config.ini'); // Adjust the path as needed
    if (!$config) {
        echo "Failed to read database config file.";
        return;
    }

    // Establish database connection
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        return;
    }

    // Prepare the SQL statement
    $getPackages = $conn->prepare("SELECT * FROM travel_talk.package");
    $getPackages->execute();
    $result = $getPackages->get_result();

    // Fetch all the packages
    $packages = $result->fetch_all(MYSQLI_ASSOC);
}

// Check if a packageId is provided in the query string
if (isset($_GET['packageId'])) {
    // Fetch package details based on packageId
    $packageId = $_GET['packageId'];
    $getPackageDetails = $conn->prepare("SELECT * FROM travel_talk.package WHERE id = ?");
    $getPackageDetails->bind_param("i", $packageId);
    $getPackageDetails->execute();
    $result = $getPackageDetails->get_result();
    $package = $result->fetch_assoc();

    // Return the package details as JSON
    header('Content-Type: application/json');
    echo json_encode($package);
    exit;
}

getPackages(); // Call the function to retrieve packages
?>

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
<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach($packages as $package): ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="<?= htmlspecialchars($package['image_path']) ?>" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= htmlspecialchars($package['destination']) ?></small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i><?= htmlspecialchars($package['duration']) ?></small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-usd text-primary me-2"></i><?= htmlspecialchars($package['price']) ?></small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0"><?= htmlspecialchars($package['pname']) ?></h3>
                            <p><?= htmlspecialchars($package['content']) ?></p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="checkout.php" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Book Now</a>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                              <a href="#packageModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal" data-package-id="<?= $package['id'] ?>">View Package</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Package End -->
</main>

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

    <!-- Package Modal -->
    <div class="modal fade" id="packageModal" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageModalLabel">Package Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mb-3" id="modalPackageImage" alt="Package Image">
                    <h3 id="modalPackagePrice"></h3>
                    <p><strong>Destination:</strong> <span id="modalPackageDestination"></span></p>
                    <p><strong>Duration:</strong> <span id="modalPackageDuration"></span></p>
                    <p><strong>Content:</strong> <span id="modalPackageContent"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="checkout.php" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
    </div>
  
    <script>
    // JavaScript for fetching and displaying the package details in the modal
    document.addEventListener('DOMContentLoaded', function () {
        const packageModal = document.getElementById('packageModal');
        packageModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const packageId = button.getAttribute('data-package-id');

            fetch(`package.php?packageId=${packageId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalPackageImage').src = data.image_path;
                document.getElementById('modalPackagePrice').textContent = `$${data.price}`;
                document.getElementById('modalPackageDestination').textContent = data.destination;
                document.getElementById('modalPackageDuration').textContent = data.duration;
                document.getElementById('modalPackageContent').textContent = data.content;
            });
        });
    });
    </script>
</body>

</html>