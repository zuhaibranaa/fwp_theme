<?php

class Contact_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'contact_us',
			'Contact Us'
		);
	}


	public function widget( $args, $instance ) {
		?>
        <h4>Contact us</h4>
        <p>
			<?php
			?>
            <b><?php echo $instance['title'] ?></b><br>
            <span class="glyphicon glyphicon-map-marker"></span><?php echo $instance['location'] ?>
            <br>
            <span class="glyphicon glyphicon-envelope"></span> <?php echo $instance['email'] ?> <br>
            <span class="glyphicon glyphicon-earphone"></span> <?php echo $instance['contact_no'] ?>
        </p>
		<?php
	}

	public function form( $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$location   = ! empty( $instance['location'] ) ? $instance['location'] : '';
		$email      = ! empty( $instance['email'] ) ? $instance['email'] : '';
		$contact_no = ! empty( $instance['contact_no'] ) ? $instance['contact_no'] : '';
		?>
        <div style="align-content: center; display: inline-block">
            <label style="float: left; font-size: 20px"
                   for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
            <br/>
            <input type="text" placeholder="Title"
                   value="<?php echo esc_attr( $title ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"
                   id="<?php echo $this->get_field_id( 'title' ); ?>"/>
        </div>
        <div style="align-content: center; display: inline-block">
            <label style="float: left; font-size: 20px"
                   for="<?php echo $this->get_field_id( 'location' ); ?>">Location: </label>
            <br/>
            <input type="text" placeholder="Location"
                   value="<?php echo esc_attr( $location ); ?>"
                   name="<?php echo $this->get_field_name( 'location' ); ?>"
                   id="<?php echo $this->get_field_id( 'location' ); ?>"/>
        </div>
        <div style="align-content: center; display: inline-block">
            <label style="float: left; font-size: 20px"
                   for="<?php echo $this->get_field_id( 'email' ); ?>">Email: </label>
            <br/>
            <input type="email" placeholder="Email"
                   value="<?php echo esc_attr( $email ) ?>"
                   name="<?php echo $this->get_field_name( 'email' ); ?>"
                   id="<?php echo $this->get_field_id( 'email' ); ?>"/>
        </div>
        <div style="align-content: center; display: inline-block">
            <label style="float: left; font-size: 20px" for="<?php echo $this->get_field_id( 'contact_no' ); ?>">Contact
                Number: </label>
            <br/>
            <input type="text" placeholder="Contact Number"
                   value="<?php echo esc_attr( $contact_no ) ?>"
                   name="<?php echo $this->get_field_name( 'contact_no' ); ?>"
                   id="<?php echo $this->get_field_id( 'contact_no' ); ?>"/>
        </div>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance               = array();
		$instance['title']      = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['location']   = ( ! empty( $new_instance['location'] ) ) ? $new_instance['location'] : '';
		$instance['email']      = ( ! empty( $new_instance['email'] ) ) ? $new_instance['email'] : '';
		$instance['contact_no'] = ( ! empty( $new_instance['contact_no'] ) ) ? $new_instance['contact_no'] : '';

		return $instance;
	}
}