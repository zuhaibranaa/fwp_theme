<?php
get_header();
?>
<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		?>
        <!-- banner -->
        <div class="inside-banner">
            <div class="container">
                <span class="pull-right"><a
                            href="<?php print_r( get_site_url() ) ?>"><?php echo esc_html__( 'Home', 'ranazuhaib' ) ?></a> / Buy</span>
                <h2>Buy</h2>
            </div>
        </div>
        <!-- banner -->


        <div class="container">
            <div class="properties-listing spacer">

                <div class="row">
                    <div class="col-lg-3 col-sm-4 hidden-xs">

                        <div class="hot-properties hidden-xs">
                            <h4>Hot Properties</h4>

                            <div class="row">
                                <div class="col-lg-4 col-sm-5"><img
                                            src="<?php echo get_template_directory_uri() ?>/images/properties/2.jpg"
                                            class="img-responsive img-circle" alt="properties"/>
                                </div>
                                <div class="col-lg-8 col-sm-7">
                                    <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                                    <p class="price">$300,000</p></div>
                            </div>

                        </div>


                        <div class="advertisement">
                            <h4>Advertisements</h4>
                            <img src="<?php echo get_template_directory_uri() ?>/images/advertisements.jpg"
                                 class="img-responsive" alt="advertisement">

                        </div>

                    </div>

                    <div class="col-lg-9 col-sm-8 ">

                        <h2><?php echo get_the_title() ?></h2>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="property-images">
                                    <!-- Slider Starts -->
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators hidden-xs">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <!-- Item 1 -->
                                            <div class="item active">
												<?php echo get_the_post_thumbnail() ?>
                                            </div>
                                        </div>
                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span
                                                    class="glyphicon glyphicon-chevron-left"></span></a>
                                        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span
                                                    class="glyphicon glyphicon-chevron-right"></span></a>
                                    </div>
                                    <!-- #Slider Ends -->

                                </div>


                                <div class="spacer"><h4><span class="glyphicon glyphicon-th-list"></span> Properties
                                        Detail
                                    </h4>
                                    <div class="well"><?php the_content(); ?></div>
                                </div>
                                <div><h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
                                    <div class="well">
										<?php
										foreach ( get_categories( array( 'taxonomy' => 'zb_property_locations' ) ) as $key => $value ) {
											echo "$value->name     ";
										}
										?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="col-lg-12  col-sm-6">
                                    <div class="property-info">
                                        <p class="price">
											<?php
											foreach ( get_categories( array( 'taxonomy' => 'zb_property_currencies' ) ) as $key => $val ) {
												echo $val->name;
												break;
											}
											echo ' ' . get_post_meta( get_the_ID(), 'price', true );
											?></p>
                                        <p class="area">
                                            <span class="glyphicon glyphicon-map-marker"></span>
											<?php
											foreach ( get_categories( array( 'taxonomy' => 'zb_property_locations' ) ) as $key => $value ) {
												echo "$value->name,   ";
											}
											?>
                                        </p>

                                        <div class="profile" style="text-transform: capitalize">
                                            <span class="glyphicon glyphicon-user"></span> Agent Details
                                            <p><?php
												echo get_the_author_meta( 'display_name' )
												     . '<br>' . get_the_author_meta( 'user_contact_number' );
												?>
                                            </p>
                                        </div>
                                    </div>

                                    <h6><span class="glyphicon glyphicon-home"></span> Features</h6>
                                    <div class="listing-detail">
										<?php
										foreach ( get_categories( array( 'taxonomy' => 'zb_property_features' ) ) as $key => $value ) {
											$a = explode( '-', $value->name );
											echo "<span data-toggle='tooltip' data-placement='bottom'
                                          data-original-title='$a[1]'>$a[0]</span>";
										}
										?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

	<?php } // end while
} // end if

get_footer();