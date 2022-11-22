<?php
get_header();
?>
    <div class="container">
        <div class="properties-listing spacer">

            <div class="row">
                <div class="col-lg-3 col-sm-4 ">

                    <div class="search-form">
                        <form id="hidden_load_more_form" role="search" method="GET"
                              action="<?php echo home_url( '/' ); ?>">
                            <input type="hidden" name="page" id="page_number" value="1">
                            <h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                            <input type="search" class="form-control"
                                   placeholder="<?php echo esc_attr_x( 'Search of Properties', 'placeholder' ) ?>"
                                   value="<?php echo get_search_query() ?>" name="s"
                                   title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"/>
                            <div class="row">
                                <div class="col-lg-5">
                                    <select name="currency" class="form-control">
                                        <option value=""
                                                disabled <?php echo isset( $_GET['currency'] ) ? '' : 'selected' ?>>
                                            Currency
                                        </option>

										<?php
										$ar = get_terms( 'zb_property_currencies' );

										foreach ( $ar as $key => $value ) {
											?>
                                            <option <?php echo ( ( $_GET['currency'] ?? '' ) == $value->term_id ) ? 'selected' : ' ' ?>
                                                    value='<?php echo $value->term_id ?>'><?php echo $value->name ?></option>
											<?php
										}
										?>
                                    </select>
                                </div>
                                <div class="col-lg-7">
                                    <select name="features" class="form-control">
                                        <option disabled <?php echo isset( $_GET['features'] ) ? '' : 'selected' ?>>
                                            Features
                                        </option>

										<?php
										$ar = get_terms( 'zb_property_features' );

										foreach ( $ar as $key => $value ) {
											?>
                                            <option <?php echo ( ( $_GET['features'] ?? '' ) == $value->term_id ) ? 'selected' : ' ' ?>
                                                    value='<?php echo $value->term_id ?>'><?php echo $value->name ?></option>
											<?php
										}
										?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <select name="location" class="form-control">
                                        <option disabled <?php echo isset( $_GET['location'] ) ? '' : 'selected' ?>>
                                            Location
                                        </option>
										<?php
										$ar = get_terms( 'zb_property_locations' );
										//					print_r( $ar );
										foreach ( $ar as $key => $value ) {
											?>

                                            <option <?php
											if ( isset( $_GET['location'] ) ) {
												echo ( $_GET['location'] == $value->term_id ) ? 'selected' : ' ';
											}
											?> value='<?php echo $value->term_id ?>'><?php echo $value->name ?></option>
											<?php
										}
										?>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="inputPieces">Price</label>
                                    <input type="range"
                                           value="<?php echo $_GET['price'][0] ?? '0' ?>,<?php echo $_GET['price'][1] ?? '999999' ?>"
                                           name="price" id="inputPieces" multiple min="0"
                                           max="999999"/>
                                    <script>
                                        OmRangeSlider.init({
                                            inputValueStyle: OmRangeSliderInputValueStyles.PHP_ARRAY
                                        });
                                    </script>
                                </div>
                                <br/>
                                <br/>
                                <br/>
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
                        <!--        <div class="pull-left result">-->
                        <!--            Showing: --><?php //echo $query->post_count * ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ) ) ?>
                        <!--            of --><?php //echo $query->found_posts ?? 0 ?><!--</div>-->
                        <div class="pull-right">
                            <select class="form-control">
                                <option>Sort by</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                            </select></div>

                    </div>
                    <div class="row">
                        <div id="properties">

                        </div>
                        <!-- properties -->
                        <div class="center">
                            <button class="btn btn-primary" id="load_more"> Load More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();