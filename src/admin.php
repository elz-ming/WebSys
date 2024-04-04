<!DOCTYPE html>
<html lang="en">

  <head>
    <?php
    include "component/head.component.php";
    ?>

    <title>Admin Dashboard</title>

    <!-- Page JS -->
    <link rel="stylesheet" href="/asset/css/admin.css" />
    <script defer src="/asset/js/admin.js"></script>
  </head>

  <body>
      <?php
      include "component/header.component.php";
      ?>
      <main class="admin-container">
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
      </main>
    <?php
      include "component/footer.component.php";
    ?>
  </body>

</html>