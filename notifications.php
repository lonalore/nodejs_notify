<?php

/**
 * @file
 * Render a page with a notification settings form.
 */

if(!defined('e107_INIT'))
{
	require_once('../../class2.php');
}

if(!e107::isInstalled('nodejs_notify'))
{
	header('Location: ' . e_BASE . 'index.php');
	exit;
}

// [PLUGINS]/nodejs_notify/languages/[LANGUAGE]/[LANGUAGE]_front.php
e107::lan('nodejs_notify', false, true);

require_once(HEADERF);


/**
 * Class notifications.
 */
class notifications
{

	/**
	 * Store plugin preferences.
	 *
	 * @var mixed|null
	 */
	private $plugPrefs = null;


	/**
	 * Store field items loaded from plugin addon files.
	 *
	 * @var array
	 */
	private $rowItems = array();


	/**
	 * Constructor.
	 */
	function __construct()
	{
		// Get plugin preferences.
		$this->plugPrefs = e107::getPlugConfig('nodejs_notify')->getPref();
		$this->rowItems = $this->getFormItems();

		if(!empty($this->rowItems) && USERID > 0)
		{
			$this->loadIncludes();

			if(vartrue($_POST['update_notification_settings'], false))
			{
				$this->submitForm();
			}

			$this->renderForm();
		}
		else
		{
			header('Location: ' . e_HTTP);
			exit;
		}
	}


	/**
	 * Submit callback for Notification settings form.
	 */
	function submitForm()
	{
		$db = e107::getDb();
		$ms = e107::getMessage();

		$allowedFields = array();
		foreach($this->rowItems as $plugin => $data)
		{
			foreach($data['group_items'] as $item)
			{
				$allowedFields[] = 'user_plugin_' . $plugin . '_' . $item['field_alert'];
				$allowedFields[] = 'user_plugin_' . $plugin . '_' . $item['field_sound'];
			}
		}

		$fields = array();
		foreach($allowedFields as $field)
		{
			$fields[$field] = (int) vartrue($_POST[$field], 0);
		}

		$update = $fields;
		$update['WHERE'] = 'user_extended_id = ' . USERID;

		$result = $db->update('user_extended', $update);

		if($result == 0)
		{
			$fields['user_extended_id'] = USERID;
			$db->insert('user_extended', $fields);
		}

		$ms->addSuccess(LAN_NODEJS_NOTIFY_FRONT_04);
	}


	/**
	 * Render Notification settings form.
	 */
	function renderForm()
	{
		$ms = e107::getMessage();
		$template = e107::getTemplate('nodejs_notify');
		$sc = e107::getScBatch('nodejs_notify', true);
		$tp = e107::getParser();
		$form = e107::getForm();

		$text = $ms->render();
		$text .= $form->open('nodejs_notify_notifications', 'post', e_SELF);

		foreach($this->rowItems as $plugin => $data)
		{
			$header = array(
				'title_alert' => LAN_NODEJS_NOTIFY_FRONT_02,
				'title_sound' => LAN_NODEJS_NOTIFY_FRONT_03,
			);

			$sc->setVars($header);
			$items = $tp->parseTemplate($template['NOTIFICATIONS']['GROUP_ITEMS']['HEADER'], true, $sc);

			foreach($data['group_items'] as $item)
			{
				$row = array(
					'item_label' => $item['label'],
					'item_alert' => 'user_plugin_' . $plugin . '_' . $item['field_alert'],
					'item_sound' => 'user_plugin_' . $plugin . '_' . $item['field_sound'],
				);

				$sc->setVars($row);
				$items .= $tp->parseTemplate($template['NOTIFICATIONS']['GROUP_ITEMS']['ROW'], true, $sc);
			}

			$items .= $tp->parseTemplate($template['NOTIFICATIONS']['GROUP_ITEMS']['FOOTER'], true, $sc);

			$group = array(
				'group_title'       => $data['group_title'],
				'group_description' => $data['group_description'],
				'group_items'       => $items,
			);

			$sc->setVars($group);
			$text .= $tp->parseTemplate($template['NOTIFICATIONS']['GROUP'], true, $sc);
		}

		$text .= '<div class="actions text-center">';
		$text .= $form->hidden('update_notification_settings', 1);
		$text .= $form->submit('submit', LAN_NODEJS_NOTIFY_FRONT_05);
		$text .= '</div>';

		$text .= $form->close();

		e107::getRender()->tablerender(LAN_NODEJS_NOTIFY_FRONT_01, $text);
		unset($text);
	}


	/**
	 * Load field items using plugin addon files.
	 *
	 * @return array
	 */
	function getFormItems()
	{
		$sql = e107::getDb();

		$items = array();
		$enabledPlugins = array();

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

		return $items;
	}


	function loadIncludes()
	{
		e107::css('nodejs_notify', 'libraries/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css');
		e107::js('nodejs_notify', 'libraries/bootstrap-switch/js/bootstrap-switch.min.js', 'jquery', 5);
		e107::js('nodejs_notify', 'js/nodejs_notify.notifications.js', 'jquery', 5);

		e107::js('settings', array('nodejs_notify' => array(
			'onText'  => LAN_NODEJS_NOTIFY_FRONT_06,
			'offText' => LAN_NODEJS_NOTIFY_FRONT_07,
		)));
	}

}


new notifications();

require_once(FOOTERF);
exit;
