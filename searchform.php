<form role="search" method="GET" action="<?php echo home_url( '/' ); ?>">
    <div class="banner-search">
        <div class="container">
            <!-- banner -->
            <h3>Buy, Sale &amp; Rent</h3>
            <div class="searchbar">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <input type="search" class="form-control"
                               placeholder="<?php echo esc_attr_x( 'Search of Properties', 'placeholder' ) ?>"
                               value="<?php echo get_search_query() ?>" name="s"
                               title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"/>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 ">
                                <select name="currency" class="form-control">
                                    <option value="" selected disabled>Currency</option>

		                            <?php
		                            $ar = get_terms( 'zb_property_currencies' );

		                            foreach ( $ar as $key => $value ) {
			                            echo "<option value='$value->term_id'>$value->name</option>";
		                            }
		                            ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <select name="features" class="form-control">
                                    <option selected disabled>Features</option>

		                            <?php
		                            $ar = get_terms( 'zb_property_features' );

		                            foreach ( $ar as $key => $value ) {
			                            echo "<option value='$value->term_id'>$value->name</option>";
		                            }
		                            ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <select name="location" class="form-control">
                                    <option value="" selected disabled>Location</option>
		                            <?php
		                            $ar = get_terms( 'zb_property_locations' );
		                            foreach ( $ar as $key => $value ) {
			                            echo "<option value='$value->term_id'>$value->name</option>";
		                            }
		                            ?>

                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <input type="submit" class="btn btn-success"
                                       value="<?php echo esc_attr_x( 'Find Now', 'submit button' ) ?>"/>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="inputPieces">Price</label>
                                <input type="range" name="price" id="inputPieces" multiple value="0,999999" min="0" max="999999" />
                            </div>
                            <script>
                                OmRangeSlider.init({
                                    inputValueStyle: OmRangeSliderInputValueStyles.PHP_ARRAY
                                });
                            </script>

                        </div>


                    </div>
                    <div class="col-lg-5 col-lg-offset-1 col-sm-6 ">
                        <p>Join now and get updated with all the properties deals.</p>
                        <button class="btn btn-info" data-toggle="modal" data-target="#loginpop">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
