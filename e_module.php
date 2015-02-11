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
$event->register('nodejs-js-handlers', 'nodejs_notify_js_handlers_callback');

/**
 * Node.js Javascript handlers.
 *
 * @param array $handlers
 * @return array $handlers
 */
function nodejs_notify_js_handlers_callback($handlers = array()) {
  $handlers[] = array(
    'plugin' => 'nodejs_notify',
    'file' => 'js/nodejs_notify.js',
  );

  return $handlers;
}
