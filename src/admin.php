<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page Logo -->
    <link rel="icon" type="image/png" href="/asset/image/favicon.png">

    <title>Admin Dashboard</title>

    <!-- Main JS -->
    <link rel="stylesheet" href="/asset/css/main.css" />
    <script defer src="/asset/js/main.js"></script>

    <!-- Page JS -->
    <link rel="stylesheet" href="/asset/css/admin.css" />
    <script defer src="/asset/js/admin.js"></script>

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
        if (session_status() == PHP_SESSION_NONE) {
          session_start(); // Start the session
        }

        if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
          echo "<script>
                  alert('You do not have valid permissions to access the admin page.');
                  window.location.href = 'index.php';
                </script>";
          exit();
        } 

        include "component/header.component.php";
      ?>
      <main>
        <div id="admin-container">
          <aside class="sidebar">
            <ul class="menu">
              <li><a href="?table=user">Users</a></li>
              <li><a href="?table=blog">Blogs</a></li>
              <li><a href="?table=package">Packages</a></li>
            </ul>
          </aside>
          <section class="content">
            <!-- Your dynamic content will be loaded here based on the selection -->
          </section>
          <div id="actionModal" class="modal">
            <div class="modal-content">
              <span class="close-btn">&times;</span>
              <div id="modalBody"></div>
              <div class="modal-footer">
                <button id="actionBtn" class="action-btn">Action</button>
                <button class="cancel-btn">Cancel</button>
              </div>
            </div>
          </div>
        </div>
        <div id="mobileMessage" style="display: none;">
          <div class="card">
            <p>Admin actions are disallowed in mobile view.</p>
            <p>Please log in using a desktop.</p>
          </div>
        </div>
      </main>
    <?php
      include "component/footer.component.php";
    ?>
  </body>

</html>