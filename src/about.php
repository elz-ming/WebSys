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
		<!-- <script defer src="/asset/js/about.js"></script> -->

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
				<h1 class="col-12 intro-text">The Team Behind The Dream</h1>
			</div>
		</div>
		<main class="abt-container">
			<div class="abt-post">
				<div class="abt-wrapper">
					<img src="/asset/image/user/edmund.jpg" alt = "Photo of Edmund">
					<div class="abt-text">
						<h2>Lin Zhenming (Edmund)</h2>
						<h3>Team Lead | Full Stack Developer</h3>
						<p>Edmund relishes solo travel as therapy, exploring global cultures with a special love for Asia, especially China, Korea, and Japan, finding Autumn the ideal season for his cultural immersions and peace.</p>
						<p>Fun Fact: I can write with my both hands due to overthinking of wearing a cast on my dominant hand someday.</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/darryl.jpg" alt="Photo of Darryl">
					<div class="abt-text">
						<h2>Darryl Ng Bing Bing</h2>
						<h3>Backend Lead</h3>
						<p>Darryl, driven by wanderlust, craves global culinary adventures, diving into each destination's flavors, stories, and traditions, making every journey a flavorful exploration of the world's diverse cultures.</p>
						<p>Fun Fact: I have a tradition of sending myself a postcard from every new country I visit; a message to my future self, capturing my thoughts, feelings, and the essence of my experience.</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/philicia.jpg" alt="Photo of Philicia">
					<div class="abt-text">
						<h2>Philicia Lee Fei Li</h2>
						<h3>Frontend Lead</h3>
						<p>Philicia, passionate about travel, thrives on exploring new places and diving into diverse cultures. Each journey fuels her curiosity and sense of adventure, turning every experience into an exhilarating adventure.</p>
						<p>Fun Fact: I've got a bunch of different drinks at home, and I love trying new ones from all over the place!</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/jingyu.jpg" alt="Photo of Jingyu">
					<div class="abt-text">
						<h2>Lim Jing Yu</h2>
						<h3>Backend Specialist</h3>
						<p>Jingyu, an avid nature enthusiast, finds solace and magic in hiking, appreciating the tranquility and beauty of nature, and embracing discovery with every step through mountains and forests.</p>
						<p>Fun Fact: When I gym I listen to chill music</p>
					</div>
				</div>
				<div class="abt-wrapper">
					<img src="/asset/image/user/tommy.jpg" alt="photo of Tommy">
					<div class="abt-text">
						<h2>Yeow Dao Xing (Tommy)</h2>
						<h3>Frontend Specialist</h3>
						<p>Tommy, an avid explorer with a boundless curiosity, thrives on the thrill of discovering new cultures, from New York's vibrant streets to Vietnam's tranquil landscapes, prioritizing experiences and learning.</p>
						<p>Fun Fact: I collect a shotglass from every country I visit and I currently have 16 different shot glasses for each of the different countries!</p>
					</div>
				</div>
			</div>
		</main>
		<?php
		include "component/footer.component.php";
		?>
	</body>

</html>