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


	private $defaultValues = array();


	function __construct()
	{
		parent::__construct();
		$this->plugPrefs = e107::getPlugConfig('nodejs_notify')->getPref();

		$db = e107::getDb();
		$this->defaultValues = $db->retrieve('user_extended', '*', 'user_extended_id = ' . USERID);
	}


	function sc_group_title()
	{
		return $this->var['group_title'];
	}


	function sc_group_description()
	{
		return $this->var['group_description'];
	}


	function sc_group_items()
	{
		return $this->var['group_items'];
	}


	function sc_title_alert()
	{
		return $this->var['title_alert'];
	}


	function sc_title_sound()
	{
		return $this->var['title_sound'];
	}


	function sc_item_label()
	{
		return '<label>' . $this->var['item_label'] . '</label>';
	}


	function sc_item_alert()
	{
		$form = e107::getForm();

		$name = $this->var['item_alert'];
		$value = 1;
		$checked = boolval(vartrue($this->defaultValues[$name], 0));
		$options = array(
			'class' => 'nodejs-notify-settings-checkbox',
		);

		return $form->checkbox($name, $value, $checked, $options);
	}


	function sc_item_sound()
	{
		$form = e107::getForm();

		$name = $this->var['item_sound'];
		$value = 1;
		$checked = boolval(vartrue($this->defaultValues[$name], 0));
		$options = array(
			'class' => 'nodejs-notify-settings-checkbox',
		);

		return $form->checkbox($name, $value, $checked, $options);
	}

}
