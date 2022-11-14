<?php

class RecommendedPropertiesWidget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'recommended_properties',
			'Recommended Properties'
		);
	}


	public function widget( $args, $instance ) {
		$ar    = array(
			'post_type'      => 'zb_property',
			'post_status'    => 'publish',
			'posts_per_page' => $instance['number']
		);
		$query = new WP_Query( $ar );
		if ( $query->have_posts() ) {
			?>
            <h3>Recommended Properties</h3>
            <div id="myCarousel" class="carousel slide">
            <ol class="carousel-indicators">
				<?php
				$is_first = 0;
				while ( $query->have_posts() ) {
					$query->the_post();
					$class = '';
					if ( $is_first == 0 ) {
						$class = 'active';
					}
					?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $is_first ++ ?>"
                        class="<?php echo $class ?>"></li>
					<?php
				}
				?>
            </ol>
            <div class="carousel-inner">
			<?php
			$is_first = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				$class = '';
				if ( $is_first == 0 ) {
					$class = 'active';
					$is_first ++;
				}
				?>
                <div class="item <?php echo $class ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="<?php echo get_the_post_thumbnail_url() ?>" class="img-responsive"
                                 alt="properties"/></div>
                        <div class="col-lg-8">
                            <h5><a href="<?php echo get_permalink() ?>"><?php echo get_the_title(); ?></a></h5>
                            <p class="price"><?php echo get_the_terms( get_the_ID(), 'zb_property_currencies' )[0]->name . ' ' . get_post_meta( get_the_ID(), 'price', true ); ?></p>
                            <a href="<?php echo get_permalink() ?>" class="more">More Detail</a></div>
                    </div>
                </div>
				<?php
			}
			wp_reset_postdata();
                    echo "</div>";

		}
		?>

		<?php
	}

	public function form( $instance ) {
		$number = ! empty( $instance['number'] ) ? $instance['number'] : '';
		?>
        <div style="align-content: center; display: inline-block">
            <label style="float: left; font-size: 20px"
                   for="<?php echo $this->get_field_id( 'number' ); ?>">Posts To Show: </label>
            <br/>
            <input type="number" placeholder="Posts"
                   value="<?php echo esc_attr( $number ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>"
                   id="<?php echo $this->get_field_id( 'number' ); ?>"/>
        </div>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance           = array();
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

		return $instance;
	}
}