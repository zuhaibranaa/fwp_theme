<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> >

<head>
    <title><?php echo get_bloginfo() . " || " . get_the_title() ?></title>
    <meta charset="UTF-8"/>
    <link rel="icon" type="image/x-icon" href="<?php get_site_icon_url() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/style.css"/>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/assets/script.js"></script>


    <!-- Owl stylesheet -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/owl-carousel/owl.theme.css">
    <script src="<?php echo get_template_directory_uri() ?>/assets/owl-carousel/owl.carousel.js"></script>
    <!-- Owl stylesheet -->


    <!-- slitslider -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_template_directory_uri() ?>/assets/slitslider/css/style.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_template_directory_uri() ?>/assets/slitslider/css/custom.css"/>
    <script type="text/javascript"
            src="<?php echo get_template_directory_uri() ?>/assets/slitslider/js/modernizr.custom.79639.js"></script>
    <script type="text/javascript"
            src="<?php echo get_template_directory_uri() ?>/assets/slitslider/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript"
            src="<?php echo get_template_directory_uri() ?>/assets/slitslider/js/jquery.slitslider.js"></script>
    <!-- slitslider -->
	<?php wp_head(); ?>
</head>
<?php wp_body_open(); ?>
<body <?php body_class() ?>>


<!-- Header Starts -->
<div class="navbar-wrapper">

    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
			<?php wp_nav_menu(
				array(
					'theme_location'  => 'primary_menu',
					'depth'           => 0, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => 'div',
					'menu_class'      => 'nav navbar-nav navbar-right',
					'container_id'    => 'navbar-collapse-1',
					'container_class' => 'navbar-collapse  collapse',
					'walker'          => new WP_Bootstrap_Navwalker()
				)
			);
			?>
            <!--             Nav Starts -->
            <!--            <div class="navbar-collapse  collapse">-->
            <!--                <ul class="nav navbar-nav navbar-right">-->
            <!--                    <li class="active"><a href="index.php">Home</a></li>-->
            <!--                    <li><a href="about.php">About</a></li>-->
            <!--                    <li><a href="agents.php">Agents</a></li>-->
            <!--                    <li><a href="blog.php">Blog</a></li>-->
            <!--                    <li><a href="contact.php">Contact</a></li>-->
            <!--                </ul>-->
            <!--            </div>-->

            <!-- Nav Ends -->

        </div>
    </div>

</div>
<!-- #Header Starts -->


<div class="container">

    <!-- Header Starts -->
    <div class="header">
        <a href="<?php print_r( get_site_url() ) ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="Realestate"></a>

        <ul class="pull-right">
<!--            <li><a href="--><?php //print_r( get_site_url() ) ?><!--">Buy</a></li>-->
<!--            <li><a href="--><?php //print_r( get_site_url() ) ?><!--">Sale</a></li>-->
<!--            <li><a href="--><?php //print_r( get_site_url() ) ?><!--">Rent</a></li>-->
        </ul>
    </div>
    <!-- #Header Starts -->
</div>