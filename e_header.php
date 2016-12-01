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
		e107::js('footer', '{e_PLUGIN}nodejs_notify/libraries/jgrowl/jquery.jgrowl.min.js', 'jquery', 2);

		$time = e107::getPlugConfig('nodejs_notify')->getPref('nodejs_notify_time', 3);
		$position = e107::getPlugConfig('nodejs_notify')->getPref('nodejs_notify_pos', 'bottom-left');

		e107::js('footer', '{e_PLUGIN}nodejs_notify/libraries/audiojs/audio.min.js', 'jquery', 2);

		$js_options = array(
			'notification_time' => $time,
			'position'          => $position,
			'sound_path'        => SITEURLBASE . e_PLUGIN_ABS . 'nodejs_notify',
			'user_settings'     => $this->getNotificationSettings(),
		);

		e107::js('settings', array('nodejs_notify' => $js_options));
		e107::js('footer', '{e_PLUGIN}nodejs_notify/js/nodejs_notify.js', 'jquery', 5);
	}

	/**
	 * Get user defined settings.
	 *
	 * @return array
	 */
	function getNotificationSettings()
	{
		$sql = e107::getDb();

		$items = array();
		$enabledPlugins = array();
		$settings = array();

		// Get list of enabled plugins.
		$sql->select("plugin", "*", "plugin_id !='' order by plugin_path ASC");
		while($row = $sql->fetch())
		{
			if($row['plugin_installflag'] == 1)
			{
				$enabledPlugins[] = $row['plugin_path'];
			}
		}

		$addonList = e107::getPlugConfig('nodejs_notify')->get('nodejs_notify_addon_list', array());

		foreach($addonList as $plugin)
		{
			if(!in_array($plugin, $enabledPlugins))
			{
				continue;
			}

			$file = e_PLUGIN . $plugin . '/e_nodejs_notify.php';

			if(!is_readable($file))
			{
				continue;
			}

			e107_require_once($file);
			$addonClass = $plugin . '_nodejs_notify';

			if(!class_exists($addonClass))
			{
				continue;
			}

			$addon = new $addonClass();
			$method = 'config';

			if(!method_exists($addon, $method))
			{
				$method = 'configurationItems';
			}

			if(!method_exists($addon, $method))
			{
				continue;
			}

			$return = $addon->$method();
			if(is_array($return))
			{
				$items[$plugin] = $return;
			}
		}

		$userData = $sql->retrieve('user_extended', '*', 'user_extended_id = ' . USERID);

		foreach($items as $plugin => $data)
		{
			foreach($data['group_items'] as $item)
			{
				$settings[$item['field_alert']] = true;
				$settings[$item['field_sound']] = true;

				$euf1 = 'user_plugin_' . $plugin . '_' . $item['field_alert'];
				$euf2 = 'user_plugin_' . $plugin . '_' . $item['field_sound'];

				if(isset($userData[$euf1]))
				{
					$settings[$item['field_alert']] = (bool) $userData[$euf1];
				}

				if(isset($userData[$euf2]))
				{
					$settings[$item['field_sound']] = (bool) $userData[$euf2];
				}
			}
		}

		return $settings;
	}

}


// Class instantiation.
new nodejs_notify_e_header;
