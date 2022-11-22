<?php
get_header();
?>
    <div class="inside-banner">
        <div class="container">
            <span class="pull-right"><a href="<?php echo home_url() ?>">Home</a> / Register</span>
            <h2>Register</h2>
        </div>
    </div>
    <!-- banner -->

    <div class="container">
        <div class="spacer">
            <div class="row register">
                <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
                    <form id="register_form_1">
                        <input type="text" class="form-control" placeholder="First Name" name="fname">
                        <input type="text" class="form-control" placeholder="Last Name" name="lname">
                        <input type="text" class="form-control" placeholder="Phone Number" name="number">
                        <input type="email" class="form-control" placeholder="Enter Email" name="email">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                               name="confirm_password">
                        <textarea rows="6" class="form-control" placeholder="Address" name="text"></textarea>
                    </form>
                    <button id="register_form_1_reg_btn" class="btn btn-success" name="Submit">Register</button>

                </div>

            </div>
        </div>
    </div>

<?php
get_footer();