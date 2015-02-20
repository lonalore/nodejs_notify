<?php
/**
 * @file
 * Class installations to handle configuration forms on Admin UI.
 */

require_once('../../class2.php');

if (!getperms('P'))
{
	header('location:' . e_BASE . 'index.php');
	exit;
}

// [PLUGINS]/nodejs_notify/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('nodejs_notify', true, true);

/**
 * Class nodejs_notify_admin.
 */
class nodejs_notify_admin extends e_admin_dispatcher
{

	protected $modes = array(
		'main' => array(
			'controller' => 'nodejs_notify_main_ui',
			'path' => null,
		),
		'notify' => array(
			'controller' => 'nodejs_notify_notify_ui',
			'path' => null,
		),
	);

	protected $adminMenu = array(
		'main/prefs' => array(
			'caption' => LAN_AC_NODEJS_NOTIFY_01,
			'perm' => 'P',
		),
		'notify/send' => array(
			'caption' => LAN_AC_NODEJS_NOTIFY_03,
			'perm' => 'P',
		),
	);

	protected $menuTitle = LAN_PLUGIN__NODEJS_NOTIFY_NAME;

}

/**
 * Class nodejs_notify_admin_ui.
 */
class nodejs_notify_main_ui extends e_admin_ui
{

	protected $pluginTitle = LAN_PLUGIN__NODEJS_NOTIFY_NAME;
	protected $pluginName = "nodejs_notify";
	protected $preftabs = array(
		LAN_AC_NODEJS_NOTIFY_02,
	);
	protected $prefs = array(
		'nodejs_notify_time' => array(
			'title' => LAN_AI_NODEJS_NOTIFY_01,
			'description' => LAN_AD_NODEJS_NOTIFY_01,
			'type' => 'number',
			'data' => 'int',
			'tab' => 0,
		),
		'nodejs_notify_pos' => array(
			'title' => LAN_AI_NODEJS_NOTIFY_05,
			'description' => LAN_AD_NODEJS_NOTIFY_02,
			'type' => 'dropdown',
			'writeParms' => array(
				'top-left' => LAN_AI_NODEJS_NOTIFY_06,
				'top-right' => LAN_AI_NODEJS_NOTIFY_07,
				'bottom-left' => LAN_AI_NODEJS_NOTIFY_08,
				'bottom-right' => LAN_AI_NODEJS_NOTIFY_09,
				'center' => LAN_AI_NODEJS_NOTIFY_10,
			),
			'tab' => 0,
		),
	);
}

/**
 * Class nodejs_notify_notify_ui.
 */
class nodejs_notify_notify_ui extends e_admin_ui
{

	protected $pluginTitle = LAN_PLUGIN__NODEJS_NOTIFY_NAME;
	protected $pluginName = "nodejs_notify";

	function init() {
		if (isset($_POST['submit'])) {
			$mes = e107::getMessage();

			e107_require_once(e_PLUGIN . 'nodejs/nodejs.main.php');
			nodejs_broadcast_message($_POST['subject'], $_POST['message']);

			$mes->addSuccess(LAN_AC_NODEJS_NOTIFY_04);
		}
	}

	function sendPage()
	{
		$frm = e107::getForm();

		$html = $frm->open('notify-form', 'post', 'admin_config.php?mode=notify&action=send');

		$html .= '<div class="control-group">';
		$html .= '<label class="control-label col-sm-2" for="subject">' . LAN_AI_NODEJS_NOTIFY_03 . '</label>';
		$html .= '<div class="controls">';
		$html .= $frm->text('subject', '', 100, array('size' => 'large', 'required' => 1));
		$html .= '</div>';
		$html .= '</div>';

		$html .= '<div class="control-group">';
		$html .= '<label class="control-label col-sm-2" for="message">' . LAN_AI_NODEJS_NOTIFY_04 . '</label>';
		$html .= '<div class="controls">';
		$html .= $frm->textarea('message', '', 3, 100, array('required' => 1));
		$html .= '</div>';
		$html .= '</div>';

		$html .= '<div class="control-group">';
		$html .= '<div class="controls">';
		$html .= $frm->button('submit', 1, 'submit', LAN_AI_NODEJS_NOTIFY_02);
		$html .= '</div>';
		$html .= '</div>';

		$html .= $frm->close();

		echo $html;
	}
}

new nodejs_notify_admin();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN . "footer.php");
exit;
