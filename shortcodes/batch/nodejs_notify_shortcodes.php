<?php

/**
 * @file
 * Class installation to define shortcodes.
 */

if(!defined('e107_INIT'))
{
	exit;
}


/**
 * Class nodejs_notify_shortcodes.
 */
class nodejs_notify_shortcodes extends e_shortcode
{

	private $plugPrefs = array();


	function __construct()
	{
		parent::__construct();
		$this->plugPrefs = e107::getPlugConfig('nodejs_notify')->getPref();
	}

}
