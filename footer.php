<div class="footer">

    <div class="container">


        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4>Pages</h4>
				<?php wp_nav_menu( array(
					'theme_location'  => 'primary_menu',
					'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => 'div',
					'container_class' => 'col-lg-12 col-sm-12 col-xs-3',
					'container_id'    => 'bs-example-navbar-collapse-1',
					'menu_class'      => 'row',
				) );
				?>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Newsletter</h4>
                <p>Get notified about the latest properties in our marketplace.</p>
                <form class="form-inline" role="form">
                    <input type="text" placeholder="Enter Your email address" class="form-control">
                    <button class="btn btn-success" type="button">Notify Me!</button>
                </form>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Follow us</h4>
                <a href="<?php echo get_option( 'facebook' ) ?>"><img
                            src="<?php echo get_template_directory_uri() ?>/images/facebook.png" alt="facebook"></a>
                <a href="<?php echo get_option( 'twitter' ) ?>"><img
                            src="<?php echo get_template_directory_uri() ?>/images/twitter.png" alt="twitter"></a>
                <a href="<?php echo get_option( 'linkedin' ) ?>"><img
                            src="<?php echo get_template_directory_uri() ?>/images/linkedin.png" alt="linkedin"></a>
                <a href="<?php echo get_option( 'instagram' ) ?>"><img
                            src="<?php echo get_template_directory_uri() ?>/images/instagram.png" alt="instagram"></a>
            </div>

            <div class="col-lg-3 col-sm-3">
				<?php if ( is_active_sidebar( 'footer-1' ) ) {
					dynamic_sidebar( 'footer-1' );
				} ?>
            </div>
        </div>
        <p class="copyright">Copyright 2013. All rights reserved. </p>


    </div>
</div>


<!-- Modal -->
<div id="loginpop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-sm-6 login">
                    <h4>Login</h4>
                    <form class="" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2"
                                   placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h4>New User Sign Up</h4>
                    <p>Join today and get updated with all the properties deal happening around.</p>
                    <button type="submit" class="btn btn-info" onclick="window.location.href='register.php'">Join Now
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.modal -->


</body>
</html>



