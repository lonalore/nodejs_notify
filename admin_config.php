<?php
/**
 * @file
 * Class installations to handle configuration forms on Admin UI.
 */

require_once('../../class2.php');

if (!getperms('P')) {
  header('location:' . e_BASE . 'index.php');
  exit;
}

// [PLUGINS]/nodejs_notify/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('nodejs_notify', TRUE, TRUE);

/**
 * Class nodejs_notify_admin.
 */
class nodejs_notify_admin extends e_admin_dispatcher {

  protected $modes = array(
    'main' => array(
      'controller' => 'nodejs_notify_admin_ui',
      'path' => NULL,
    ),
  );

  protected $adminMenu = array(
    'main/prefs' => array(
      'caption' => LAN_AC_NODEJS_NOTIFY_01,
      'perm' => 'P',
    ),
  );

  protected $menuTitle = LAN_PLUGIN__NODEJS_NOTIFY_NAME;

}

/**
 * Class nodejs_notify_admin_ui.
 */
class nodejs_notify_admin_ui extends e_admin_ui {

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
  );

}

new nodejs_notify_admin();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN . "footer.php");
exit;
