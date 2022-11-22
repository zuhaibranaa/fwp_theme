<?php
get_header();
?>
	<div class="inside-banner">
		<div class="container">
			<span class="pull-right"><a href="<?php echo get_home_url() ?>">Home</a> / <?php echo get_the_title() ?></span>
			<h2> <?php echo get_the_title() ?></h2>
		</div>
	</div>
<?php
the_content();
get_footer();