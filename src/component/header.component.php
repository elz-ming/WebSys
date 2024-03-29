<style>
  .profile .user-info {
  display: flex;        /* Establish flex container */
  align-items: center;  /* Center flex items vertically */
  justify-content: flex-end; /* Aligns items to the end of the container, you can adjust as needed */
}

.profile .user-name {
  margin-right: 10px; /* Adjust space between name and icon as needed */
  margin-top: 15px; /* Adjust space between name and icon as needed */
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
        <span class="user-name">
          <?php echo htmlspecialchars($userFirstName) . ' ' . htmlspecialchars($userLastName); ?>
        </span>
        <a href="profile.php">
          <img class="decision-node-icon" alt="Profile" src="/asset/image/index/social-media.svg" />
        </a>
      <?php else: ?>
        <a href="login.php">
          <img class="decision-node-icon" alt="Login" src="/asset/image/index/login-icon.svg" /> <!-- Assume you have a login icon -->
        </a>
      <?php endif; ?>
    </div>

  </div>
</header>