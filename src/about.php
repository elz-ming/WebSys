<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Page Logo -->
		<link rel="icon" type="image/png" href="/asset/image/favicon.png">

		<title>About Us</title>

		<!-- Main JS -->
    <link rel="stylesheet" href="/asset/css/main.css" />
    <script defer src="/asset/js/main.js"></script>

		<!-- Page JS -->
		<link rel="stylesheet" href="/asset/css/about.css" />
		<script defer src="/asset/js/about.js"></script>

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
		include "component/header.component.php";
		?>

		<div id="landing-screen">
			<?php
			echo "<div class='header-container' style='background-image: url(" . "/asset/image/user/GroupPhoto.jpg" . ");'>";
			?>
			<div class="overlay-bg">
				<img src="/asset/image/index/rectangle-1.svg" alt="group picture of development team"/>
			</div>
			<div class="row intro-container">
			<div class="lets-go">The Team Behind The Dream</div>
			</div>
		</div>
		<main class="abt-container">
			<div class="abt-post">
				<div class="abt-wrapper">
					<img src="/asset/image/user/edmund.jpg" alt = "Photo of Edmund">
					<div class="abt-text">
						<h3>Lin Zhenming</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
							velit, eu sed sollicitudin tempus,</p>
						<p>Fun Fact: Loves Japan</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/darryl.jpg" alt="Photo of Darryl">
					<div class="abt-text">
						<h3>Darryl Ng Bing Bing</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
							velit, eu sed sollicitudin tempus,</p>
						<p>Fun Fact: Loves Japan</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/philicia.jpg" alt="Photo of Philicia">
					<div class="abt-text">
						<h3>Philicia Lee Fei Li</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
							velit, eu sed sollicitudin tempus,</p>
						<p>Fun Fact: Loves Japan</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/jingyu.jpg" alt="Photo of Jingyu">
					<div class="abt-text">
						<h3>Lim Jing Yu</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
							velit, eu sed sollicitudin tempus,</p>
						<p>Fun Fact: Loves Japan</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/tommy.jpg" alt="photo of Tommy">
					<div class="abt-text">
						<h3>Yeow Dao Xing</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed et donec purus viverra. Sit justo
							velit, eu sed sollicitudin tempus,</p>
						<p>Fun Fact: Loves Japan</p>
					</div>
				</div>
			</div>
		</main>
		<?php
		include "component/footer.component.php";
		?>
	</body>

</html>