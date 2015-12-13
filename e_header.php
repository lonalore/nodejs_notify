<?php
/**
 * @file
 * Class instantiation to prepare JavaScript configurations and include css/js
 * files to page header.
 */

if(!defined('e107_INIT'))
{
	exit;
}

e107_require_once(e_PLUGIN . 'nodejs/nodejs.main.php');


/**
 * Class nodejs_notify_e_header.
 */
class nodejs_notify_e_header
{

	function __construct()
	{
		self::include_components();
	}


	/**
	 * Include necessary CSS and JS files
	 */
	function include_components()
	{

		e107::css('nodejs_notify', 'libraries/jgrowl/jquery.jgrowl.min.css');
		e107::js('nodejs_notify', 'libraries/jgrowl/jquery.jgrowl.min.js', 'jquery', 2);

		$time = e107::getPlugConfig('nodejs_notify')->getPref('nodejs_notify_time', 3);
		$position = e107::getPlugConfig('nodejs_notify')->getPref('nodejs_notify_pos', 'bottom-left');

		e107::js('nodejs_notify', 'libraries/audiojs/audio.min.js', 'jquery', 2);

		$js_options = array(
			'notification_time' => $time,
			'position'          => $position,
			'sound_path'        => SITEURLBASE . e_PLUGIN_ABS . 'nodejs_notify',
		);

		e107::js('settings', array('nodejs_notify' => $js_options));
		e107::js('nodejs_notify', 'js/nodejs_notify.js', 'jquery', 5);
	}
}


// Class instantiation.
new nodejs_notify_e_header;
