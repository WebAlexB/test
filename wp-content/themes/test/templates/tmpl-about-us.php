<?php
/**
 * Template Name: About Us
 * Post Type: page
 *
 * @package projecttest
 */
get_header();
?>

<main class="about-us">
	<section class="about-us__hero">
		<div class="container">
			<h1>About Us</h1>
			<p>Welcome to our company! We are dedicated to providing the best services to our customers.</p>
		</div>
	</section>

	<section class="about-us__team">
		<div class="container">
			<h2>Meet Our Team</h2>
			<div class="team-list">
				<div class="team-member">
					<img src="https://via.placeholder.com/150" alt="John Doe">
					<h3>John Doe</h3>
					<p>CEO</p>
				</div>
				<div class="team-member">
					<img src="https://via.placeholder.com/150" alt="Jane Smith">
					<h3>Jane Smith</h3>
					<p>CTO</p>
				</div>
				<div class="team-member">
					<img src="https://via.placeholder.com/150" alt="Emily Brown">
					<h3>Emily Brown</h3>
					<p>Designer</p>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
