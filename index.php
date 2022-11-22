<?php
get_header();
the_content();
// The Query

$args      = array(
	'post_type'      => array( 'zb_property' ),
	'post_status'    => array( 'publish' ),
	'posts_per_page' => '-1',
	'order'          => 'DESC',
	'orderby'        => 'date', /* Also support: none, rand, id, title, slug, modified, parent, menu */
);
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	?>
    <div class="">
        <div id="slider" class="sl-slider-wrapper">
			<?php
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				?>
                <div class="sl-slider">
                    <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25"
                         data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                        <div class="sl-slide-inner">
                            <div class="bg-img"
                                 style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
                            </div>
                            <h2><a href="<?php echo get_permalink() ?>"><?php echo get_the_title(); ?></a></h2>
                            <blockquote>
                                <p class="location"><span class="glyphicon glyphicon-map-marker"></span>
									<?php foreach ( get_categories( array( 'taxonomy' => 'zb_property_locations' ) ) as $key => $value ) {
										echo "$value->name     ";
										break;
									} ?>
                                </p>
                                <p> <?php echo wp_trim_words( get_the_content(), 20, null ); ?> </p>
                                <cite><?php
									foreach ( get_categories( array( 'taxonomy' => 'zb_property_currencies' ) ) as $key => $val ) {
										echo $val->name;
										break;
									}
									echo ' ' . get_post_meta( get_the_ID(), 'price', true );
									?></cite>
                            </blockquote>
                        </div>
                    </div>
                </div><!-- /sl-slider -->


				<?php
			} ?>
            <nav id="nav-dots" class="nav-dots">
				<?php
				$is_first = true;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					if ( $is_first ) {
						echo "<span class='nav-dot-current'></span>";
						$is_first = false;
					} else {
						?>
                        <span></span>

					<?php }
				}
				?>
            </nav>
        </div>
    </div>
	<?php
}
/* Restore original Post Data */
get_search_form();
?>
    <div class="container">
        <div class="properties-listing spacer">
            <a href="buysalerent.php" class="pull-right viewall">View All Listing</a>
            <h2>Featured Properties</h2>
            <div id="owl-example" class="owl-carousel">
				<?php
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
                    <div class="properties">
                        <div class="image-holder"><img src="<?php echo get_the_post_thumbnail_url(); ?>"
                                                       class="img-responsive" alt="properties"/>
                        </div>
                        <h4>
                            <a href="<?php echo get_permalink() ?>"><?php echo wp_trim_words( get_post()->post_title, 4, null ); ?></a>
                        </h4>
                        <p class="price">Price: <?php
							echo get_the_terms( get_the_ID(), 'zb_property_currencies' )[0]->name . ' ' . get_post_meta( get_the_ID(), 'price', true );
							?></p>
                        <div class="listing-detail">
							<?php
							$dd = get_the_terms( get_the_ID(), 'zb_property_features' );
							foreach ( $dd as $key => $value ) {
								$a = explode( '-', $value->name );
								echo "<span data-toggle='tooltip' data-placement='bottom' data-original-title='$a[1]'>$a[0]</span>";
							}
							?>
                        </div>
                        <a class="btn btn-primary" href="<?php echo get_permalink() ?>">View Details</a>
                    </div>
				<?php }
				wp_reset_postdata();
				?>
            </div>
        </div>
        <div class="spacer">
            <div class="row">
                <div class="col-lg-6 col-sm-9 recent-view">
                    <!--                    <h3>About Us</h3>-->
                    <!--                    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.-->
                    <!--                        Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced-->
                    <!--                        in their exact original form, accompanied by English versions from the 1914 translation by H.-->
                    <!--                        Rackham.<br><a href="about.php">Learn More</a></p>-->
                    <!---->
                    <!--                </div>-->
                    <!--                <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">-->
                    <!--					--><?php //if ( is_active_sidebar( 'recommended-1' ) ) {
					//						dynamic_sidebar( 'recommended-1' );
					//					} ?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
