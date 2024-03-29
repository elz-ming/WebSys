<style>

.user-interaction {
  position: relative;
  cursor: pointer;
}

.user-icon {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

/* Style to show the dropdown */
.show {
  display: block;
}
</style>

<header>
  <div class="row header-bar">

    <h1 class="col-sm-6 col-lg-3">TravelTalk</h1>

    <div class="col-sm-6 col-lg-6 search-bar">
      <img class="decision-node-icon" alt="" src="/asset/image/index/decision-node.svg" />
      <input placeholder="search" type="text" />
    </div>

    <div class="col-3 profile">
      <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
        <div class="user-interaction">
          <span class="user-name">
            <?php echo htmlspecialchars($userFirstName) . ' ' . htmlspecialchars($userLastName); ?>
          </span>
          <div class="user-icon" id="userIcon">
            <img class="decision-node-icon" alt="Profile" src="/asset/image/index/social-media.svg" />
          </div>
          <div id="dropdown" class="dropdown-content">
            <a href="/asset/php/logout.process.php">Sign out</a>
          </div>
        </div>
      <?php else: ?>
        <a href="../../login.php">
          <img class="decision-node-icon" alt="Login" src="/asset/image/index/login-icon.svg" />
        </a>
      <?php endif; ?>
    </div>

  </div>
</header>

<script>
// Wait for the DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
  // Toggle the dropdown when clicking on the user icon
  document.getElementById('userIcon').addEventListener('click', function() {
    document.getElementById('dropdown').classList.toggle('show');
  });

  // Close the dropdown if clicking outside of it
  window.addEventListener('click', function(event) {
    if (!event.target.matches('#userIcon') && !event.target.matches('.decision-node-icon')) {
      var dropdown = document.getElementById('dropdown');
      if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    }
  });
});
</script>
