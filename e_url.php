<?php

/**
 * @file
 * v2.x Standard  - Simple mod-rewrite module.
 */

if(!defined('e107_INIT'))
{
	exit;
}


/**
 * Class nodejs_notify_url.
 *
 * plugin-folder + '_url'
 */
class nodejs_notify_url
{

	function config()
	{
		$config = array();

		$config['index'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^notifications/?$',
			// Used by e107::url(); to create a url from the db table.
			'sef'      => 'notifications',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}nodejs_notify/notifications.php',
		);

		return $config;
	}

}
