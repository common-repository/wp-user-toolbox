<?php
/*
Plugin Name: WP User Toolbox
Description: toolbox for users on frontend, build a user-friendly site
Version: 1.0.0
Author: murmurstream
Author URI: https://github.com/murmurstream/
Plugin URI: https://github.com/murmurstream
Text Domain: wp-user-toolbox
*/

function WTTB_WPUserToolboxGetCurrentTimeDate(){
	return date('F jS, Y, H:i:s');
}


function WTTB_WPUserToolboxWidgetInitPro()
{
	wp_register_sidebar_widget('WTTB_WPUserToolbox', 'WTTB_WPUserToolbox', 'WTTB_WPUserToolboxSidebarPro');
	wp_register_widget_control('WTTB_WPUserToolbox','WTTB_WPUserToolbox', 'WTTB_WPUserToolboxControlPro', 300, 200);
}

function WTTB_WPUserToolboxControlPro()
{
	global $wpdb,$table_prefix,$g_content;
	$options = get_option('titleWTTB_WPUserToolboxControl');

	if (empty($options))
	{
		$m_title = '';
	}
	else
	{
		$m_title = $options;
	}
	if (isset($_POST['HiddenWTTB_WPUserToolboxControl']))
	{
		$titleWTTB_WPUserToolboxControl = sanitize_text_field($_POST['HiddenWTTB_WPUserToolboxControl']);
		update_option('titleWTTB_WPUserToolboxControl',$titleWTTB_WPUserToolboxControl);
	}

	echo '<div style="width:250px">';
	echo __( 'Input Widget Title Here:', 'wp-user-toolbox' );
	echo '<br />';
	echo '<input  type="text" id="HiddenWTTB_WPUserToolboxControl" name="HiddenWTTB_WPUserToolboxControl" value="'.$m_title.'" style="margin:5px 5px;width:200px" />';
	echo '</div>';
}


function WTTB_WPUserToolboxSidebarPro($argssidebarsidebar = null)
{
	global $wpdb,$table_prefix,$g_content;
	$before_widget = '';
	$after_widget = '';
	if (!empty($argssidebar))
	{
		extract($argssidebar);
	}

	$options = get_option('titleWTTB_WPUserToolboxControl');

	if (empty($options))
	{
		$m_title = '';
	}
	else
	{
		$m_title = $options;
	}


	echo $before_widget;
	echo '<div class="sidebarWTTB_WPUserToolbox">';
	if (!empty($m_title))
	{
		echo "<div class='sidebarWTTB_WPUserToolboxTitle'>" . $m_title . "</div>";
	}

	global $table_prefix,$wpdb,$post;

	
	$return_content = '';
	$return_content .= '<div class="WTTB_WPUserToolbox_widget">';
	$return_content .= WTTB_WPUserToolboxGetCurrentTimeDate();
	$return_content .= '</div>';
	echo "</div>";
	echo $return_content;
}

add_action('widgets_init', 'WTTB_WPUserToolboxWidgetInitPro');

