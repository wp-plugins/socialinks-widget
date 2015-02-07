<?php
 /*
	Plugin Name: Socialinks Widget
	Plugin URI: http://zourbuth.com/plugins/socialinks-widget
	Description:  This widget is a imple social link widget that shows user profile link with icon. Full features social widget with 16 site supported. Just enter your link and have fun. 
	Version: 1.0.3
	Author: zourbuth
	Author URI: http://zourbuth.com
	License: Under GPL2
*/
 
/*  
	Copyright 2011 zourbuth (email : zourbuth@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Launch the plugin. */
add_action( 'plugins_loaded', 'socialinks_widget_plugins_loaded' );

/* Initializes the plugin and it's features. */
function socialinks_widget_plugins_loaded() {

	load_plugin_textdomain( 'socialinks-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	/* Set constant path to the members plugin directory. */
	define( 'SOCIALINKS_WIDGET_VERSION', '1.0.2' );
	define( 'SOCIALINKS_WIDGET_DIR', plugin_dir_path( __FILE__ ) );

	/* Set constant path to the members plugin directory. */
	define( 'SOCIALINKS_WIDGET_URL', plugin_dir_url( __FILE__ ) );

	/* Loads and registers the new widgets. */
	add_action( 'widgets_init', 'socialinks_load_widgets' );
	
	/* Create additional links to plugin list */
	add_filter( 'plugin_row_meta', '_my_portfolio', 10, 2 );
}

/* Register the extra widgets. Each widget is meant to replace or extend the current default  */
function socialinks_load_widgets() {

	/* Load widget file. */
	require_once( SOCIALINKS_WIDGET_DIR . 'widget.php' );

	/* Register widget. */
	register_widget( 'Socialink_Widget' );
}

function _my_portfolio($links, $file) {
	$plugin = plugin_basename(__FILE__);

	if ($file == $plugin) // create link
		return array_merge( $links, array( sprintf( '<a href="#">Portfolios</a>', $plugin, __('Portfolios') ) ));
	return $links;
}
?>