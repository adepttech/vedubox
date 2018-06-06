<?php

/**
* Plugin Name: tscorenew
* Description:	An awesome plugin for used for get LMS data from vedubox.
* Version:		1.0.0
* Author:		Shailendra Kumar(adepttechsolution.com)
*/


//ob_start();
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('tscorenew', '1.0.0');
define('TSCORE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TSCORE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TSCORE_ASSETS_URL', plugins_url('assets', __FILE__));
define('TSCORE_VIEW_URL', plugins_url('views', __FILE__));
define('NETWORK', 'VEDUBOXPLUGIN');



include_once(TSCORE_PLUGIN_PATH.'/functions.php');
?>
