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
                                <select class="form-control">
                                    <option>Buy</option>
                                    <option>Rent</option>
                                    <option>Sale</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <select class="form-control">
                                    <option>Price</option>
                                    <option>$150,000 - $200,000</option>
                                    <option>$200,000 - $250,000</option>
                                    <option>$250,000 - $300,000</option>
                                    <option>$300,000 - above</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <select class="form-control">
                                    <option>Property</option>
                                    <option>Apartment</option>
                                    <option>Building</option>
                                    <option>Office Space</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-4">
                                <input type="submit" class="btn btn-success"
                                       value="<?php echo esc_attr_x( 'Find Now', 'submit button' ) ?>"/>
                            </div>
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
