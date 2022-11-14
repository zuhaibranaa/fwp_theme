<?php
require trailingslashit( get_template_directory() ) . "hooks/register_zb_properties.php";
require trailingslashit( get_template_directory() ) . "hooks/register_navwalker.php";
require trailingslashit( get_template_directory() ) . "hooks/Contact_Widget.php";
require trailingslashit( get_template_directory() ) . "hooks/RecommendedPropertiesWidget.php";
// Register Contact US Widget

function green_property_register_widgets() {
	register_sidebar( array(
		'name'          => __( 'Footer - 1', 'ranazuhaib' ),
		'id'            => 'footer-1',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'ranazuhaib' ),
	) );
	register_sidebar( array(
		'name'          => __( 'recommended - 1', 'ranazuhaib' ),
		'id'            => 'recommended-1',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'ranazuhaib' )
	) );
	register_widget( Contact_Widget::class );
	register_widget( RecommendedPropertiesWidget::class );
}
add_action( 'widgets_init', 'green_property_register_widgets' );

// Custom POST TYPE Columns
add_filter('manage_zb_property_posts_columns' , 'custom_post_type_columns');
function custom_post_type_columns($columns){
    $columns['price'] = 'Price';
    return $columns;
}
add_action( 'manage_zb_property_posts_custom_column', 'fill_custom_post_type_columns', 10, 2);
function fill_custom_post_type_columns( $column, $post_id ){
	// Fill in the columns with meta box info associated with each post
	if ($column === 'price'){
		echo get_post_meta( $post_id ,'price', true );
	}
}


// register Nav Menut
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
			$price = $_POST['zb_property_price'] ?? null;
			update_post_meta( $post_id, 'price', $price );
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

	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;

	update_user_meta( $user_id, 'user_contact_number', $_POST['user_contact_number'] );
}
add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );