<!DOCTYPE html>
<html lang="en">

<head>
	<?php
  include "component/head.component.php";
  ?>

	<title>About Us</title>

	<!-- Page JS -->
	<link rel="stylesheet" href="/asset/css/about.css" />
	<script defer src="/asset/js/about.js"></script>
</head>

<body>
	<?php
	include "component/header.component.php";
	?>

	<div id="landing-screen">
		<?php
		echo "<div class='header-container' style='background-image: url(" . "/asset/image/user/GroupPhoto.jpg" . ");'>";
		?>
		<div class="overlay-bg">
		<img src="/asset/image/index/rectangle-1.svg" />
		</div>
		<div class="row intro-container">
		<?php
		echo "<h1 class='col-12 intro-text'>" . htmlspecialchars($blog['title']) . "</h1>";
		echo "<div class='intro-content'>" . htmlspecialchars($blog['subtitle']) . "</div>";
		?>
		<div class="lets-go">The Team Behind The Dream</div>
		</div>
	</div>
	<main class="abt-container">
		<div class="abt-post">
			<div class="abt-wrapper">
				<img src="/asset/image/user/edmund.jpg">
				<div class="abt-text">
					<h3>Lin Zhenming</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
						velit, eu sed sollicitudin tempus,</p>
					<p1>Fun Fact: Loves Japan</p1>
				</div>
			</div>
			<div class="abt-wrapper">
				<img src="/asset/image/user/darryl.jpg">
				<div class="abt-text">
					<h3>Darryl Ng Bing Bing</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
						velit, eu sed sollicitudin tempus,</p>
					<p1>Fun Fact: Loves Japan</p1>
				</div>
			</div>
			<div class="abt-wrapper">
				<img src="/asset/image/user/philicia.jpg">
				<div class="abt-text">
					<h3>Philicia Lee Fei Li</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
						velit, eu sed sollicitudin tempus,</p>
					<p1>Fun Fact: Loves Japan</p1>
				</div>
			</div>
			<div class="abt-wrapper">
				<img src="/asset/image/user/jingyu.jpg">
				<div class="abt-text">
					<h3>Lim Jing Yu</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
						velit, eu sed sollicitudin tempus,</p>
					<p1>Fun Fact: Loves Japan</p1>
				</div>
			</div>
			<div class="abt-wrapper">
				<img src="/asset/image/user/tommy.jpg">
				<div class="abt-text">
					<h3>Yeow Dao Xing</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
						velit, eu sed sollicitudin tempus,</p>
					<p1>Fun Fact: Loves Japan</p1>
				</div>
			</div>
		</div>
	</main>
	<?php
	include "component/footer.component.php";
	?>
</body>

</html>