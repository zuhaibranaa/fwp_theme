<?php
get_header();
$query = new WP_Query(
	array(
		'post_type'      => 'zb_property',
		"s"              => $_GET['s'],
		'posts_per_page' => '3',
	)
);
if ( $query->have_posts() ) {

	?>
    <div class="container">
    <div class="properties-listing spacer">

    <div class="row">
    <div class="col-lg-3 col-sm-4 ">

        <div class="search-form">
            <form role="search" method="GET" action="<?php echo home_url( '/' ); ?>">
                <h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                <input type="search" class="form-control"
                       placeholder="<?php echo esc_attr_x( 'Search of Properties', 'placeholder' ) ?>"
                       value="<?php echo get_search_query() ?>" name="s"
                       title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"/>
                <div class="row">
                    <div class="col-lg-5">
                        <select class="form-control">
                            <option value="" selected disabled>Currency</option>

							<?php
							$ar = get_terms( 'zb_property_currencies' );
							//													echo "<option>";
							//						print_r( $ar );
							//													echo "</option>";
							foreach ( $ar as $key => $value ) {
								echo "<option value='$value->name'>$value->name</option>";
							}
							?>
                        </select>
                    </div>
                    <div class="col-lg-7">
                        <select class="form-control">
                            <option>Price</option>
                            <option>$150,000 - $200,000</option>
                            <option>$200,000 - $250,000</option>
                            <option>$250,000 - $300,000</option>
                            <option>$300,000 - above</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <select name="location" class="form-control">
                            <option value="" selected disabled>Location</option>
							<?php
							$ar = get_terms( 'zb_property_locations' );
							//					print_r( $ar );
							foreach ( $ar as $key => $value ) {
								echo "<option value='$value->name'>$value->name</option>";
							}
							?>

                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Find Now"/>
            </form>
        </div>


        <div class="hot-properties hidden-xs">
            <h4>Hot Properties</h4>
            <div class="row">
                <div class="col-lg-4 col-sm-5"><img
                            src="<?php echo get_template_directory_uri() ?>/images/properties/1.jpg"
                            class="img-responsive img-circle" alt="properties">
                </div>
                <div class="col-lg-8 col-sm-7">
                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                    <p class="price">$300,000</p></div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5"><img
                            src="<?php echo get_template_directory_uri() ?>/images/properties/1.jpg"
                            class="img-responsive img-circle" alt="properties">
                </div>
                <div class="col-lg-8 col-sm-7">
                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                    <p class="price">$300,000</p></div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-5"><img
                            src="<?php echo get_template_directory_uri() ?>/images/properties/1.jpg"
                            class="img-responsive img-circle" alt="properties">
                </div>
                <div class="col-lg-8 col-sm-7">
                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                    <p class="price">$300,000</p></div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-5"><img
                            src="<?php echo get_template_directory_uri() ?>/images/properties/1.jpg"
                            class="img-responsive img-circle" alt="properties">
                </div>
                <div class="col-lg-8 col-sm-7">
                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                    <p class="price">$300,000</p></div>
            </div>

        </div>


    </div>

    <div class="col-lg-9 col-sm-8">
    <div class="sortby clearfix">
        <div class="pull-left result">
            Showing: <?php echo $query->post_count * ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ) ) ?>
            of <?php echo $query->found_posts ?? 0 ?></div>
        <div class="pull-right">
            <select class="form-control">
                <option>Sort by</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
            </select></div>

    </div>
    <div class="row">
	<?php
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
        <!-- properties -->
        <div class="col-lg-4 col-sm-6">
            <div class="properties">
                <div class="image-holder"><img
                            src="<?php echo get_the_post_thumbnail_url() ?>"
                            class="img-responsive"
                            alt="properties">
                </div>
                <h4>
                    <a href="<?php echo get_post_permalink() ?>"><?php echo wp_trim_words( get_post()->post_title, 4, null ); ?></a>
                </h4>
                <p class="price">Price: <?php echo get_the_terms( get_the_ID(), 'zb_property_currencies' )[0]->name;
					echo ' ' . get_post_meta( get_the_ID(), 'price', true ) ?></p>
                <div class="listing-detail">
					<?php
					$dd = get_the_terms( get_the_ID(), 'zb_property_features' );
					foreach ( $dd as $key => $value ) {
						$a = explode( '-', $value->name );
						echo "<span data-toggle='tooltip' data-placement='bottom' data-original-title='$a[1]'>$a[0]</span>";
					}
					?>
                </div>
                <a class="btn btn-primary" href="<?php echo get_post_permalink() ?>">View Details</a>
            </div>
        </div>
		<?php
	}


	?>
    <!-- properties -->
    <div class="center">
	<?php echo str_replace( 'page-numbers', 'pagination', paginate_links( array( 'type' => 'list' ) ) ); ?>
	<?php
} ?>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>
<?php
get_footer();