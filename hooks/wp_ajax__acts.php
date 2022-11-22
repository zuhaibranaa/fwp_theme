<?php
add_action( 'wp_ajax_nopriv_get_my_properties', function () {
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
} );
add_action( 'wp_ajax_get_my_properties', function () {
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
} );

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
        print_r($_POST['email']);

		//print_r(wp_authenticate( $_POST['email'],$_POST['password'] ));

		$cred = array(

				'user_login'    => $_POST['email'],
				'user_password' => $_POST['password'],
				'remember'      => true

		);
		$user = wp_signon( $cred, false );

        print_r($user);

		if ( is_wp_error( $user ) ) {
			echo $user->get_error_message();
		}
		wp_die();
	}
}