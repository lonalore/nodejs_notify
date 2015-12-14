<?php

/**
 * @file
 * This file is loaded every time the core of e107 is included. ie. Wherever
 * you see require_once("class2.php") in a script. It allows a developer to
 * modify or define constants, parameters etc. which should be loaded prior to
 * the header or anything that is sent to the browser as output. It may also be
 * included in Ajax calls.
 */

// Register events.
$event = e107::getEvent();
$event->register('admin_plugin_install', 'nodejs_notify_update_addon_list');
$event->register('admin_plugin_uninstall', 'nodejs_notify_update_addon_list');
$event->register('admin_plugin_upgrade', 'nodejs_notify_update_addon_list');
$event->register('admin_plugin_refresh', 'nodejs_notify_update_addon_list');

/**
 * Callback function to update nodejs addon list.
 */
function nodejs_notify_update_addon_list()
{
	$fl = e107::getFile();

	$plugList = $fl->get_files(e_PLUGIN, "^plugin\.(php|xml)$", "standard", 1);
	$pluginList = array();
	$addonsList = array();

	// Remove Duplicates caused by having both plugin.php AND plugin.xml.
	foreach($plugList as $num => $val)
	{
		$key = basename($val['path']);
		$pluginList[$key] = $val;
	}

	foreach($pluginList as $p)
	{
		$p['path'] = substr(str_replace(e_PLUGIN, '', $p['path']), 0, -1);
		$plugin_path = $p['path'];

		if(is_readable(e_PLUGIN . $plugin_path . '/e_nodejs_notify.php'))
		{
			$addonsList[] = $plugin_path;
		}
	}

	e107::getPlugConfig('nodejs_notify')->set('nodejs_notify_addon_list', $addonsList)->save();
}
