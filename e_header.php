<?php
/**
 * @file
 * Class instantiation to prepare JavaScript configurations and include css/js
 * files to page header.
 */

if (!defined('e107_INIT')) {
  exit;
}

/**
 * Class nodejs_notify_e_header.
 */
class nodejs_notify_e_header {

  function __construct() {
    self::include_components();
  }

  /**
   * Include necessary CSS and JS files
   */
  function include_components() {

    e107::css('nodejs_notify', 'libraries/jgrowl/jquery.jgrowl.min.css');
    e107::js('nodejs_notify', 'libraries/jgrowl/jquery.jgrowl.min.js', 'jquery', 2);

    $options = nodejs_json_encode(array('notification_time' => 3));
    $js_config = 'var e107NodejsNotify = e107NodejsNotify || { settings: ' . $options . ' };';

    e107::js('inline', $js_config, NULL, 3);
  }

}

// Class instantiation.
new nodejs_notify_e_header;
