<?php
function register_new_post(): void {
	$labels = array(
		'name'                  => _x( 'Property', 'Post type general name', 'property' ),
		'singular_name'         => _x( 'Property', 'Post type singular name', 'property' ),
		'menu_name'             => _x( 'Properties', 'Admin Menu text', 'property' ),
		'name_admin_bar'        => _x( 'Property', 'Add New on Toolbar', 'property' ),
		'add_new'               => __( 'Add New Property', 'property' ),
		'add_new_item'          => __( 'Add New property', 'property' ),
		'new_item'              => __( 'New property', 'property' ),
		'edit_item'             => __( 'Edit property', 'property' ),
		'view_item'             => __( 'View property', 'property' ),
		'all_items'             => __( 'All properties', 'property' ),
		'search_items'          => __( 'Search properties', 'property' ),
		'parent_item_colon'     => __( 'Parent properties:', 'property' ),
		'not_found'             => __( 'No properties found.', 'property' ),
		'not_found_in_trash'    => __( 'No properties found in Trash.', 'property' ),
		'featured_image'        => _x( 'Property Cover Image', 'Overrides the “Featured Image” pbrase for this post type. Added in 4.3', 'property' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” pbrase for this post type. Added in 4.3', 'property' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” pbrase for this post type. Added in 4.3', 'property' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” pbrase for this post type. Added in 4.3', 'property' ),
		'archives'              => _x( 'property archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'property' ),
		'insert_into_item'      => _x( 'Insert into property', 'Overrides the “Insert into post”/”Insert into page” pbrase (used when inserting media into a post). Added in 4.4', 'property' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this property', 'Overrides the “Uploaded to this post”/”Uploaded to this page” pbrase (used when viewing media attached to a post). Added in 4.4', 'property' ),
		'filter_items_list'     => _x( 'Filter properties list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'property' ),
		'items_list_navigation' => _x( 'properties list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'property' ),
		'items_list'            => _x( 'properties list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'property' ),
	);
	$args   = array(
		'labels'               => $labels,
		'description'          => 'property custom post type.',
		'public'               => true,
		'publicly_queryable'   => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'query_var'            => true,
		'rewrite'              => array( 'slug' => 'property' ),
		'capability_type'      => 'post',
		'has_archive'          => true,
		'hierarchical'         => false,
		'menu_position'        => 20,
		'supports'             => array( 'title', 'editor', 'author', 'thumbnail' ),
		'taxonomies'           => array( 'category', 'post_tag' ),
		'show_in_rest'         => true,
		'menu_icon'            => 'dashicons-building',
		'register_meta_box_cb' => 'register_meta_boxex_for_zb_property'
	);
	function register_meta_boxex_for_zb_property(): void {
		function property_settings_mb_fields(): void {
			?>
            <div class="container">
                <label for="zb_property_price">Price : </label>
                <input style="margin-top: 0.5rem; width: 100%" type="number" name="zb_property_price"
                       id="zb_property_price"
                       value="<?php echo isset( $_GET['post'] ) ? get_post_meta( $_GET['post'] )['price'][0] : ''; ?>"
                       placeholder="Price">            </div>
		<?php }

		add_meta_box( 'property_settings_mb', 'Property Settings', 'property_settings_mb_fields', 'zb_property', 'side', 'high' );
	}

	register_post_type( 'zb_property', $args );

// Now register the taxonomy
	register_taxonomy( 'zb_property_features', array( 'zb_property' ), array(
		'hierarchical'      => false,
		'labels'            => array(
			'name'              => _x( 'Features', 'taxonomy general name' ),
			'singular_name'     => _x( 'Feature', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Features' ),
			'all_items'         => __( 'All Features' ),
			'parent_item'       => __( 'Parent Feature' ),
			'parent_item_colon' => __( 'Parent Feature:' ),
			'edit_item'         => __( 'Edit Feature' ),
			'update_item'       => __( 'Update Feature' ),
			'add_new_item'      => __( 'Add New Feature' ),
			'new_item_name'     => __( 'New Feature Name' ),
			'menu_name'         => __( 'Features' ),
		),
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'feature' ),
	) );
	register_taxonomy( 'zb_property_currencies', array( 'zb_property' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => __( 'Currencies', 'taxonomy general name' ),
			'singular_name' => __( 'Currency', 'taxonomy singular name' ),
			'search_items'  => __( 'Search Currencies' ),
			'all_items'     => __( 'All Currencies' ),
			'edit_item'     => __( 'Edit Currency' ),
			'update_item'   => __( 'Update Currency' ),
			'add_new_item'  => __( 'Add New Currency' ),
			'new_item_name' => __( 'New Feature Name' ),
			'menu_name'     => __( 'Currencies' ),
		),
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'currency' ),
	) );
	register_taxonomy( 'zb_property_locations', array( 'zb_property' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => __( 'Locations', 'taxonomy general name' ),
			'singular_name' => __( 'Location', 'taxonomy singular name' ),
			'search_items'  => __( 'Search Locations' ),
			'all_items'     => __( 'All Locations' ),
			'edit_item'     => __( 'Edit Location' ),
			'update_item'   => __( 'Update Location' ),
			'add_new_item'  => __( 'Add New Location' ),
			'new_item_name' => __( 'New Feature Name' ),
			'menu_name'     => __( 'Locations' ),
		),
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'location' ),
	) );
}

add_action( 'init', 'register_new_post' );
add_action( 'zb_property_currencies_add_form_fields', 'add_property_term_fields' );
function add_property_term_fields($taxonomy){
	?>

    <div class="form-field">
        <label class="form-label" for="text_field">Text Field</label>
        <input type="text" name="text_field" value="" id="text_field" />
        <p>Field description may go here.</p>
    </div>
	<?php
}

add_action( 'created_zb_property_currencies', 'save_feature_meta');
function save_feature_meta( $term_id){
	if( isset( $_POST['text_field'] )){
		$group = sanitize_title( $_POST['text_field'] );
		update_term_meta( $term_id, 'text_field', $group, true );
	}
}
function custom_currency_col($param){
	$param['text_field'] = __( 'Text Field', 'text_field' );
    return $param;
}

function add_feature_group_column_content( $content, $column_name, $term_id ){
	if( $column_name == 'text_field' ){
		return esc_attr( get_term_meta( $term_id, 'text_field', true ));
	}
}

function add_feature_group_column_sortable( $sortable ){
	$sortable[ 'text_field' ] = 'text_field';
	return $sortable;
}
function add_term_fields($taxonomy){
	$t_id = $taxonomy->term_id?? '';

	?>
	<table id="custom_user_field_table" class="form-table">
        <tr id="custom_user_field_row">
            <th>
                <label class="form-label" for="text_field">Text Field</label>
            </th>
            <td>
                <input type="text" name="text_field" value="<?php echo get_term_meta($t_id,'text_field',true) ?? ""; ?>" id="text_field" />
                <p>Field description may go here.</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'zb_property_currencies_edit_form_fields', 'add_term_fields', 10 );
add_action( 'manage_zb_property_currencies_custom_column', 'add_feature_group_column_content', 10, 3);
add_action( 'edited_zb_property_currencies', 'save_feature_meta', 10 );
add_filter( 'manage_edit-zb_property_currencies_sortable_columns', 'add_feature_group_column_sortable' );
add_action('manage_edit-zb_property_currencies_columns','custom_currency_col');
