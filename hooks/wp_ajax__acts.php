<?php

function getData() {
	$a = array();
	parse_str( $_POST['data'], $a );
	$params              = array(
		'post_type'      => 'zb_property',
		"s"              => $a['s'],
		'posts_per_page' => 3,
		'paged'          => $a['page'],
	);
	$tax_query           = array(
		'relation' => 'AND',
		isset( $a['location'] ) ? array(
			'taxonomy' => 'zb_property_locations',
			'field'    => 'id',
			'terms'    => array( $a['location'] ),
		) : '',
		isset( $a['currency'] ) ? array(
			'taxonomy' => 'zb_property_currencies',
			'field'    => 'id',
			'terms'    => array( $a['currency'] ),
		) : '',
		isset( $a['features'] ) ? array(
			'taxonomy' => 'zb_property_features',
			'field'    => 'id',
			'terms'    => array( $a['features'] ),
		) : ''
	);
	$params['tax_query'] = $tax_query;
	if ( isset( $a['price_min'] ) ) {
		$meta_query           = array(
			'relation' => 'AND',
			array(
				'key'     => 'price',
				'value'   => array( $a['price_min'], $a['price_max'] ),
				'compare' => 'BETWEEN',
			)
		);
		$params['meta_query'] = $meta_query;
	}
	$query = new WP_Query( $params );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			?>
            <div class="col-lg-4 col-sm-6">
                <div class="properties">
                    <div class="image-holder"><img
                                src="<?php echo get_the_post_thumbnail_url() ?>"
                                class="img-responsive"
                                alt="properties">
                    </div>
                    <h4>
                        <a href="<?php echo get_post_permalink() ?>"><?php echo wp_trim_words( get_post()->post_title, 4, null ); ?></a>
                    </h4>
                    <p class="price">Price: <?php echo get_the_terms( get_the_ID(), 'zb_property_currencies' )[0]->name;
						echo ' ' . get_post_meta( get_the_ID(), 'price', true ) ?></p>
                    <div class="listing-detail">
						<?php
						$dd = get_the_terms( get_the_ID(), 'zb_property_features' );
						foreach ( $dd as $key => $value ) {
							$a = explode( '-', $value->name );
							echo "<span data-toggle='tooltip' data-placement='bottom' data-original-title='$a[1]'>$a[0]</span>";
						}
						?>
                    </div>
                    <a class="btn btn-primary" href="<?php echo get_post_permalink() ?>">View Details</a>
                </div>
            </div>
			<?php
		}
	}
	wp_die();
}

add_action( 'wp_ajax_nopriv_get_my_properties', 'getData' );
add_action( 'wp_ajax_get_my_properties', 'getData' );

add_action(
	'wp_ajax_nopriv_create_new_user', function () {
	$userdata = array(
		'user_pass'            => $_POST['password'],
		'user_login'           => $_POST['fname'],
		'user_nicename'        => $_POST['fname'],
		'user_email'           => $_POST['email'],
		'first_name'           => $_POST['fname'],
		'last_name'            => $_POST['lname'],
		'description'          => $_POST['text'],
		//(string) The user's biographical description.
		'show_admin_bar_front' => 'false',
		'role'                 => 'subscriber',
		'meta_input'           => array(
			'user_contact_number' => $_POST['number']
		)
	);
	$user_id  = wp_insert_user(
		$userdata
	);
	print_r( 123 );
	print_r( $user_id );
	wp_die();
	if ( ! is_wp_error( $user_id ) ) {
		signIn();
	} else {
		print_r( $user_id->errors );
		wp_die();
	}
} );
add_action( 'wp_ajax_nopriv_login_user', 'signIn' );

function signIn() {
	{
		print_r( $_POST['email'] );

		//print_r(wp_authenticate( $_POST['email'],$_POST['password'] ));

		$cred = array(

			'user_login'    => $_POST['email'],
			'user_password' => $_POST['password'],
			'remember'      => true

		);
		$user = wp_signon( $cred, false );

		print_r( $user );

		if ( is_wp_error( $user ) ) {
			echo $user->get_error_message();
		}
		wp_die();
	}
}

add_action( 'wp_ajax_add_property_title', function () {
//	delete_user_meta( get_current_user_id(), 'post_under_processing' );
	$post_id = get_user_meta( get_current_user_id(), 'post_under_processing', true );
	if ( $post_id == '' ) {
		$post_id = wp_insert_post( [
			'post_title' => $_POST['data']['title'],
			'post_type'  => 'zb_property'
		] );
		update_user_meta( get_current_user_id(), 'post_under_processing', $post_id );
	} else {
		$post_id = wp_update_post( [
			'ID'         => $post_id,
			'post_title' => $_POST['data']['title'],
		] );
	}
	print_r( get_post( $post_id )->post_title );
	wp_die();
} );

add_action( 'wp_ajax_add_property_images', function () {
	$post_id = $_GET['post_id'];
	if ( $post_id === null ) {
		$post_id = get_user_meta( get_current_user_id(), 'post_under_processing', true );
	}
	if ( $post_id != null ) {
		$image = media_handle_upload( 'my_file_upload', $post_id );
		if ( get_post_meta( $post_id, 'image', true ) == null ) {
			$attach_url = array( $image );
		} else {
			$attach_url   = json_decode( get_post_meta( $post_id, 'image', true ) );
			$attach_url[] = $image;
		}
		print_r( set_post_thumbnail( $post_id, $attach_url[0] ) );
		update_post_meta( $post_id, 'image', json_encode( $attach_url ) );
	}
	wp_die();
} );

add_action( 'wp_ajax_save_property', function () {
	$meta_val = get_user_meta( get_current_user_id(), 'post_under_processing', true );
	wp_update_post( array(
		'ID'           => $meta_val,
		'post_title'   => $_POST['title'],
		'post_content' => $_POST['content'],
		'post_type'    => 'zb_property',
		'post_status'  => 'publish',
		'meta_input'   => array(
			'price'     => $_POST['price'],
			'latitude'  => $_POST['lat'],
			'longitude' => $_POST['long'],
		),
		'tax_input'    => array(
			'zb_property_features'   => explode( ',', $_POST['select_field'] ),
			'zb_property_currencies' => $_POST['currency'],
			'zb_property_locations'  => $_POST['location'],
		)
	) );
	delete_user_meta( get_current_user_id(), 'post_under_processing' );
	wp_die();
} );


add_action( 'wp_ajax_get_already_submitted_images', function () {
	$post_id = $_POST['post_id'];

	if ( $post_id == "" ) {
		$post_id = get_user_meta( get_current_user_id(), 'post_under_processing', true );
	}
	if ( $post_id != '' ) {
		$images = get_post_meta( $post_id, 'image', true );
		$images = json_decode( $images );
		$result = array();
		foreach ( $images as $mid ) {
			$obj                 = array();
			$obj['dispaly_name'] = basename( get_attached_file( $mid ) );
			$obj['url']          = wp_get_attachment_image_src( $mid )[0];
			$obj['size']         = filesize( get_attached_file( $mid ) );
			$obj['id']           = $mid;
			$result[]            = $obj;
		}
		header( 'Content-type: text/json' );
		header( 'Content-type: application/json' );
		echo json_encode( $result );
		wp_die();
	}
} );

add_action( 'wp_ajax_delete_attached_image', function () {
	wp_delete_attachment( $_POST['img'] );
	$post_id = (int) ( $_POST['post_id'] );
	if ( $post_id == 0 ) {
		$post_id = get_user_meta( get_current_user_id(), 'post_under_processing', true );
	}
	$images = json_decode( get_post_meta( $post_id, 'image', true ) );
	foreach ( $images as $image => $key ) {
		if ( $key == $_POST['img'] ) {
			unset( $images->$image );
		}
	}
	update_post_meta( $post_id, 'image', json_encode( $images ) );
	wp_die();
} );