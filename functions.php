<?php
require trailingslashit( get_template_directory() ) . "hooks/register_zb_properties.php";
require trailingslashit( get_template_directory() ) . "hooks/register_navwalker.php";
require trailingslashit( get_template_directory() ) . "hooks/Contact_Widget.php";
require trailingslashit( get_template_directory() ) . "hooks/RecommendedPropertiesWidget.php";
require trailingslashit( get_template_directory() ) . "hooks/wp_ajax__acts.php";
// Register Contact US Widget

function green_property_register_widgets() {
	register_sidebar( array(
		'name'        => __( 'Footer - 1', 'ranazuhaib' ),
		'id'          => 'footer-1',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'ranazuhaib' ),
	) );
	register_sidebar( array(
		'name'        => __( 'recommended - 1', 'ranazuhaib' ),
		'id'          => 'recommended-1',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'ranazuhaib' )
	) );
	register_widget( Contact_Widget::class );
	register_widget( RecommendedPropertiesWidget::class );
}

add_action( 'widgets_init', 'green_property_register_widgets' );

// Custom POST TYPE Columns
add_filter( 'manage_zb_property_posts_columns', 'custom_post_type_columns' );
function custom_post_type_columns( $columns ) {
	$columns['price']     = 'Price';
	$columns['latitude']  = 'Latitude';
	$columns['longitude'] = 'Longitude';

	return $columns;
}

add_action( 'manage_zb_property_posts_custom_column', 'fill_custom_post_type_columns', 10, 2 );
function fill_custom_post_type_columns( $column, $post_id ) {
	// Fill in the columns with meta box info associated with each post
	if ( $column === 'price' ) {
		echo get_post_meta( $post_id, 'price', true );
	}
	if ( $column === 'latitude' ) {
		echo get_post_meta( $post_id, 'latitude', true );
	}
	if ( $column === 'longitude' ) {
		echo get_post_meta( $post_id, 'longitude', true );
	}
}


// register Nav Menu
if ( ! function_exists( 'mytheme_register_nav_menu' ) ) {

	function mytheme_register_nav_menu() {
		register_nav_menus( array(
			'primary_menu' => __( 'Primary Menu', 'text_domain' ),
		) );

		add_theme_support( 'widgets' );
		add_theme_support( 'post-thumbnails' );
	}

	add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
}
// Save Custom Post Meta
if ( ! function_exists( 'save_custom_meta' ) ) {
	function save_custom_meta( $post_id ) {
		if ( get_post_type() === 'zb_property' ) {
			$price     = $_POST['zb_property_price'] ?? null;
			$latitude  = $_POST['zb_property_latitude'] ?? null;
			$longitude = $_POST['zb_property_longitude'] ?? null;
			update_post_meta( $post_id, 'price', $price );
			update_post_meta( $post_id, 'latitude', $latitude );
			update_post_meta( $post_id, 'longitude', $longitude );
		}
	}

	add_action( 'save_post', 'save_custom_meta' );
}

add_action( 'profile_personal_options', 'extra_profile_fields' );

function extra_profile_fields( $user ) {
	// get the value of a single meta key
	$meta_value = get_user_meta( $user->ID, 'user_contact_number', true ); // $user contains WP_User object
	// do something with it.
	?>
    <table id="custom_user_field_table" class="form-table">
        <tr id="custom_user_field_row">
            <th>
                <label for="user_contact_number"><?php _e( 'Contact Number', 'your_textdomain' ); ?></label>
            </th>
            <td>
                <input type="text" name="user_contact_number" id="user_contact_number"
                       value="<?php echo esc_attr( $meta_value ); ?>" class="regular-text"/><br/>
            </td>
        </tr>
    </table>
	<?php
}

function fb_save_custom_user_profile_fields( $user_id ) {

	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	update_user_meta( $user_id, 'user_contact_number', $_POST['user_contact_number'] );
}

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );

function control_search_results() {
	if ( is_search() ) {
		set_query_var( 'posts_per_page', 3 ); // Change 10 to the number of search results you want to appear per page.
		set_query_var( 'post_type', 'zb_property' ); // Change 10 to the number of search results you want to appear per page.
		set_query_var( 'post_status', 'publish' ); // Change 10 to the number of search results you want to appear per page.
	}
}

add_filter( 'pre_get_posts', 'control_search_results' );

add_action( 'wp_enqueue_scripts', 'my_plugin_assets' );
function my_plugin_assets() {
	wp_enqueue_style( 'select_2_css', get_template_directory_uri() . "/assets/select2/select2.min.css" );
	wp_enqueue_style( 'select_2_bootstrap_css', get_template_directory_uri() . "/assets/select2/select2-bootstrap.min.css" );
	wp_enqueue_style( 'jqte', get_template_directory_uri() . "/assets/jqte/jquery-te-1.4.0.css" );


	wp_enqueue_script( 'leaflet', get_template_directory_uri() . "/assets/leaflet/leaflet.js", array( 'jquery' ) );
	wp_enqueue_script( 'jqte_js', get_template_directory_uri() . "/assets/jqte/jquery-te-1.4.0.min.js", array( 'jquery' ) );
	wp_enqueue_script( 'select_2_js', get_template_directory_uri() . "/assets/select2/select2.min.js", array( 'jquery' ) );
	wp_enqueue_script( 'dropzone', get_template_directory_uri() . "/assets/dropzone/dropzone.min.js", array( 'jquery' ), '', true );
	wp_enqueue_script( 'owl-', get_template_directory_uri() . "/assets/owl-carousel/owl.carousel.js", array( 'jquery' ) );
	wp_enqueue_script( 'modernizer', get_template_directory_uri() . "/assets/slitslider/js/modernizr.custom.79639.js", array( 'jquery' ) );
	wp_enqueue_script( 'slitslider-jq', get_template_directory_uri() . "/assets/slitslider/js/jquery.ba-cond.min.js", array( 'jquery' ) );
	wp_enqueue_script( 'slitslider-jq-2', get_template_directory_uri() . "/assets/slitslider/js/jquery.slitslider.js", array( 'jquery' ) );
	wp_enqueue_script( 'range-slider', get_template_directory_uri() . "/assets/om-javascript-range-slider.js", array( 'jquery' ) );
	wp_enqueue_script( 'custom-script', get_template_directory_uri() . "/assets/script.js", array( 'jquery' ), '', true );
//	wp_enqueue_script( 'custom-script', get_template_directory_uri() . "/assets/script.js", array( 'jquery' ) );

	wp_localize_script( 'custom-script', 'ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}