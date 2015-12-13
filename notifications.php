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
	 * Constructor.
	 */
	function __construct()
	{
		// Get plugin preferences.
		$this->plugPrefs = e107::getPlugConfig('nodejs_notify')->getPref();

		$this->renderForm();
	}


	function renderForm()
	{
		$mes = e107::getMessage();
		$template = e107::getTemplate('nodejs_notify');
		$sc = e107::getScBatch('nodejs_notify', true);
		$tp = e107::getParser();
		$frm = e107::getForm();

		$text = '...';

		e107::getRender()->tablerender(LAN_NODEJS_NOTIFY_FRONT_01, $text);
		unset($text);
	}
}

new notifications();

require_once(FOOTERF);
exit;
