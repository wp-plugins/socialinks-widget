<?php
/**
 * zFrame - Simple Social Link Widget
 * 
 * @package zFrame
 * @subpackage Classes
 * An advanced widget that gives you total control over feed using feedburner.
 * This widget support shortcode for the short description.
 * For another improvement, you can drop email to zourbuth@gmail.com or visit http://zourbuth.com/simple-social-link-widget
**/

class Socialink_Widget extends WP_Widget {

	/**
	 * Prefix for the widget.
	 */
	var $prefix;

	/**
	 * Textdomain for the widget.
	 */
	var $textdomain;

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 */
	function Socialink_Widget() {

		$this->textdomain = 'socialinks-widget';
		
		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'socialink',
			'description' => esc_html__( '[+] Full features social widget with 16 site supported. Just enter your profile links and have fun.', $this->textdomain )
		);
		
		/* Set up the widget control options. */
		$control_options = array(
			'width' => 420,
			'height' => 350,
			'id_base' => "{$this->prefix}socialinks"
		);

		/* Create the widget. */
		$this->WP_Widget( "{$this->prefix}socialinks", esc_attr__( 'Socialinks', $this->textdomain ), $widget_options, $control_options );
		
		/* load the widget stylesheet for the widgets screen. */
		add_action( 'load-widgets.php', array(&$this, 'socialinks_admin') );
		
		if ( is_active_widget(false, false, $this->id_base) && !is_admin() ) {
			wp_enqueue_style( 'socialinks', SOCIALINKS_WIDGET_URL . '/css/widget.css', false, 0.7, 'screen' );
		}
	}

	/* push the widget stylesheet widget.css */
	function socialinks_admin() {
		wp_enqueue_style( 'socialinks-admin', SOCIALINKS_WIDGET_URL . '/css/dialog.css', false, 0.7, 'screen' );
		wp_enqueue_script( 'super-post-admin', SOCIALINKS_WIDGET_URL . 'js/jquery.dialog.js', array( 'jquery' ) );		
	}	
	
	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 * @since 0.6.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/** Set up the arguments for tickers(). **/
		$args = array(
			'intro_text'		=> $instance['intro_text'],
			'delicious'			=> intval( $instance['delicious'] ),
			'deviantart'		=> intval( $instance['deviantart'] ),
			'email'				=> intval( $instance['email'] ),
			'facebook'			=> intval( $instance['facebook'] ),
			'flickr'			=> intval( $instance['flickr'] ),
			'linkedin'			=> intval( $instance['linkedin'] ),
			'myspace'			=> intval( $instance['myspace'] ),
			'netvibes'			=> intval( $instance['netvibes'] ),
			'reddit'			=> intval( $instance['reddit'] ),
			'rss'				=> intval( $instance['rss'] ),
			'skype'				=> intval( $instance['skype'] ),
			'tumblr'			=> intval( $instance['tumblr'] ),
			'twitter'			=> intval( $instance['twitter'] ),
			'stumbleupon'		=> intval( $instance['stumbleupon'] ),
			'vimeo'				=> intval( $instance['vimeo'] ),
			'youtube'			=> intval( $instance['youtube'] ),
			'outro_text'		=> $instance['outro_text'],
		); 
		
		/** Print the before widget. **/
		echo $before_widget;
		
		/* If a title was input by the user, display it. */
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;
		
			/** 
			 * Display the social links.
			 * This is where the order of the icons is set for the actual front-end rendering on the website
			 * cut/paste each line if you want to change the order. 
			**/
			
			/** print the short description before the social icon **/
			if ( !empty( $instance['intro_text'] ) )
				echo '<p>' . do_shortcode( $instance[intro_text] ) . '</p>';
			
			$social_images = SOCIALINKS_WIDGET_URL . 'images/social/';
			echo '<p class="social">';
			if ( !empty( $instance['delicious'] ) )  		echo '<a href="' . $instance[delicious] . '" title="Delicious Profile"><img src="' . $social_images . 'delicious_16.png" alt="Delicious" /></a> ';
			if ( !empty( $instance['deviantart'] ) )  		echo '<a href="' . $instance[deviantart] . '" title="deviantArt Profile"><img src="' . $social_images . 'deviantart_16.png" alt="DeviantArt"/></a> ';
			if ( !empty( $instance['email'] ) )  			echo '<a href="' . $instance[email] . '" title="Email Address"><img src="' . $social_images . 'email_16.png" alt="Email"/></a> ';
			if ( !empty( $instance['facebook'] ) )  		echo '<a href="' . $instance[facebook] . '" title="Facebook Profile"><img src="' . $social_images . 'facebook_16.png" alt="Facebook"/></a> ';
			if ( !empty( $instance['flickr'] ) )  			echo '<a href="' . $instance[flickr] . '" title="Flickr Profile"><img src="' . $social_images . 'flickr_16.png" alt="Flickr"/></a> ';
			if ( !empty( $instance['linkedin'] ) )  		echo '<a href="' . $instance[linkedin] . '" title="LinkedIn Profile"><img src="' . $social_images . 'linkedin_16.png" alt="LinkedIn"/></a> ';
			if ( !empty( $instance['myspace'] ) )  			echo '<a href="' . $instance[myspace] . '" title="MySpace Profile"><img src="' . $social_images . 'myspace_16.png" alt="MySpace"/></a> ';
			if ( !empty( $instance['netvibes'] ) )  		echo '<a href="' . $instance[netvibes] . '" title="NetVibes Profile"><img src="' . $social_images . 'netvibes_16.png" alt="NetVibes"/></a> ';
			if ( !empty( $instance['reddit'] ) )  			echo '<a href="' . $instance[reddit] . '" title="Reddit Profile"><img src="' . $social_images . 'reddit_16.png" alt="Reddit"/></a> ';
			if ( !empty( $instance['rss'] ) )  				echo '<a href="' . $instance[rss] . '" title="RSS Profile"><img src="' . $social_images . 'rss_16.png" alt="RSS"/></a> ';
			if ( !empty( $instance['skype'] ) )  			echo '<a href="' . $instance[skype] . '" title="Skype Profile"><img src="' . $social_images . 'skype_16.png" alt="Skype"/></a> ';
			if ( !empty( $instance['tumblr'] ) ) 			echo '<a href="' . $instance[tumblr] . '" title="Tumblr Profile"><img src="' . $social_images . 'tumblr_16.png" alt="Tumblr"/></a> ';
			if ( !empty( $instance['twitter'] ) )  			echo '<a href="' . $instance[twitter] . '" title="Twitter Profile"><img src="' . $social_images . 'twitter_16.png" alt="Twitter"/></a> ';
			if ( !empty( $instance['stumbleupon'] ) )		echo '<a href="' . $instance[stumbleupon] . '" title="StumbleUpon Profile"><img src="' . $social_images . 'stumbleupon_16.png" alt="StumbleUpon"/></a> ';
			if ( !empty( $instance['vimeo'] ) )  			echo '<a href="' . $instance[vimeo] . '" title="Vimeo Profile"><img src="' . $social_images . 'vimeo_16.png" alt="Vimeo"/></a> ';
			if ( !empty( $instance['youtube'] ) )  			echo '<a href="' . $instance[youtube] . '" title="YouTube Profile"><img src="' . $social_images . 'youtube_16.png" alt="YouTube"/></a> ';
			if ( !empty( $instance['delicious'] ) )  		echo '<a href="' . $instance[delicious] . '" title="Delicious Profile"><img src="' . $social_images . 'delicious_16.png" alt="Delicious" /></a> ';
			echo '</p>';
			
			/** print the short description after the social icon **/
			if ( !empty( $instance['outro_text'] ) )
				echo '<p>' . do_shortcode( $instance[outro_text] ) . '</p>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Set the instance to the new instance. */
		$instance = $new_instance;
		
		$instance['intro_text']		= $new_instance['intro_text'];
		$instance['delicious'] 		= strip_tags($new_instance['delicious'] );
		$instance['deviantart'] 	= strip_tags($new_instance['deviantart'] );
		$instance['email'] 			= strip_tags($new_instance['email'] );
		$instance['facebook'] 		= strip_tags($new_instance['facebook'] );
		$instance['flickr'] 		= strip_tags($new_instance['flickr'] );
		$instance['linkedin'] 		= strip_tags($new_instance['linkedin'] );
		$instance['myspace'] 		= strip_tags($new_instance['myspace'] );
		$instance['netvibes'] 		= strip_tags($new_instance['netvibes'] );
		$instance['reddit'] 		= strip_tags($new_instance['reddit'] );
		$instance['rss'] 			= strip_tags($new_instance['rss'] );
		$instance['skype'] 			= strip_tags($new_instance['skype'] );
		$instance['tumblr'] 		= strip_tags($new_instance['tumblr'] );
		$instance['twitter'] 		= strip_tags($new_instance['twitter'] );
		$instance['stumbleupon'] 	= strip_tags($new_instance['stumbleupon'] );
		$instance['vimeo'] 			= strip_tags($new_instance['vimeo'] );
		$instance['youtube'] 		= strip_tags($new_instance['youtube'] );
		$instance['outro_text']		= $new_instance['outro_text'];
		$instance['toggle_active']	= $new_instance['toggle_active'];
		
		return $instance;
	}	

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 * @since 0.6.0
	 */
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title' 		=> 'Socialinks',
			'intro_text'	=> '',	
			'delicious'		=> '',
			'deviantart'	=> '',
			'email'			=> '',
			'facebook'		=> '',
			'flickr'		=> '',
			'linkedin'		=> '',
			'myspace'		=> '',
			'netvibes'		=> '',
			'reddit'		=> '',
			'rss'			=> '',
			'skype'			=> '',
			'tumblr'		=> '',
			'twitter'		=> '',
			'stumbleupon'	=> '',
			'vimeo'			=> '',
			'youtube'		=> '',
			'outro_text'	=> '',	
			'toggle_active'	=> array(0 => 1, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,8 => 0,9 => 0),	
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$tabs = array( 
			__( 'General', $this->textdomain ),  
			__( 'Socials', $this->textdomain ),
			__( 'Supports', $this->textdomain ),
		);		
		?>
		<style type="text/css">
			ul.socialinks label {
				display: inline-block;
				font-size: 11px;
				font-weight: normal;
			}
		</style>
		<div class="pluginName">Socialinks<span class="pluginVersion"><?php echo SOCIALINKS_WIDGET_VERSION; ?></span></div>
		<div id="cp-<?php echo $this->id ; ?>" class="totalControls tabbable tabs-left">
			<ul class="nav nav-tabs">
				<?php foreach ($tabs as $key => $tab ) : ?>
					<li class="<?php echo $instance['toggle_active'][$key] ? 'active' : '' ; ?>"><?php echo $tab; ?><input type="hidden" name="<?php echo $this->get_field_name( 'toggle_active' ); ?>[]" value="<?php echo $instance['toggle_active'][$key]; ?>" /></li>
				<?php endforeach; ?>							
			</ul>			
			<ul class="tab-content" style="min-height:400px;">
				<li class="tab-pane <?php if ( $instance['toggle_active'][0] ) : ?>active<?php endif; ?>">				
					<ul>
						<li>
							<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', $this->textdomain ); ?></label>
							<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'intro_text' ); ?>"><?php _e('Intro text:', $this->textdomain ) ?></label><br />
							<textarea name="<?php echo $this->get_field_name( 'intro_text' ); ?>" id="<?php echo $this->get_field_id( 'intro_text' ); ?>" rows="4" class="widefat"><?php echo htmlentities($instance['intro_text']); ?></textarea>
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'outro_text' ); ?>"><?php _e('Outro text:', $this->textdomain ) ?></label><br />
							<textarea name="<?php echo $this->get_field_name( 'outro_text' ); ?>" id="<?php echo $this->get_field_id( 'outro_text' ); ?>" rows="4" class="widefat"><?php echo htmlentities($instance['outro_text']); ?></textarea>
						</li>
					</ul>
				</li>
				
				<li class="tab-pane <?php if ( $instance['toggle_active'][1] ) : ?>active<?php endif; ?>">	
					<ul class="socialinks">
						<li>
							<label for="<?php echo $this->get_field_id( 'delicious' ); ?>"><?php _e( 'Delicious:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'delicious' ); ?>" name="<?php echo $this->get_field_name( 'delicious' ); ?>" value="<?php echo esc_attr( $instance['delicious'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'deviantart' ); ?>"><?php _e( 'Deviantart:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'deviantart' ); ?>" name="<?php echo $this->get_field_name( 'deviantart' ); ?>" value="<?php echo esc_attr( $instance['deviantart'] ); ?>" />
						</li>			
						<li>
							<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo esc_attr( $instance['email'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>" />
						</li>			
						<li>
							<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo esc_attr( $instance['flickr'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linkedin:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" />
						</li>

						<li>
							<label for="<?php echo $this->get_field_id( 'myspace' ); ?>"><?php _e( 'Myspace:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'myspace' ); ?>" name="<?php echo $this->get_field_name( 'myspace' ); ?>" value="<?php echo esc_attr( $instance['myspace'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'netvibes' ); ?>"><?php _e( 'Netvibes:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'netvibes' ); ?>" name="<?php echo $this->get_field_name( 'netvibes' ); ?>" value="<?php echo esc_attr( $instance['netvibes'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'reddit' ); ?>"><?php _e( 'Reddit:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'reddit' ); ?>" name="<?php echo $this->get_field_name( 'reddit' ); ?>" value="<?php echo esc_attr( $instance['reddit'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e( 'Rss:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo esc_attr( $instance['rss'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e( 'Skype:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo esc_attr( $instance['skype'] ); ?>" />
						</li>
						
						<li>
							<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e( 'Tumblr:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo esc_attr( $instance['tumblr'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'stumbleupon' ); ?>"><?php _e( 'Stumbleupon:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'stumbleupon' ); ?>" name="<?php echo $this->get_field_name( 'stumbleupon' ); ?>" value="<?php echo esc_attr( $instance['stumbleupon'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo esc_attr( $instance['vimeo'] ); ?>" />
						</li>
						<li>
							<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube:', $this->textdomain ); ?></label>
							<input type="text" class="column-last" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>" />
						</li>
					</ul>
				</li>
				<li class="tab-pane <?php if ( $instance['toggle_active'][2] ) : ?>active<?php endif; ?>">				
					<ul>
						<li>						
							<?php echo sprintf( __( 'Want a more social widget? Try <a href="%s">Socialinked Widget</a>. Easy to use, support drag-drop for icon reordering and much more!', $this->textdomain ),
								esc_url( 'http://zourbuth.com/plugins/socialinked/' ) );
							?>
						</li>
						<li>
							<a href="http://feedburner.google.com/fb/a/mailverify?uri=zourbuth&amp;loc=en_US">Subscribe</a>  to <a href="http://zourbuth.com">zourbuth</a> by <a href="http://feedburner.google.com/fb/a/mailverify?uri=zourbuth&amp;loc=en_US">email</a>.<br />
							<?php _e( 'Like my work? Please consider to ', $this->textdomain ); ?><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=W6D3WAJTVKAFC" title="Donate"><?php _e( 'donate', $this->textdomain ); ?></a>.<br /><br />
							&copy; Copyright <a href="http://zourbuth.com">zourbuth</a> 2014.
						</li>
					</ul>
				</li>				
			</ul>
		</div>
	<?php
	}
}
?>