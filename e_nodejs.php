<?php
/**
 * @file
 *
 */


/**
 * Class nodejs_notify_nodejs.
 */
class nodejs_notify_nodejs
{

	/**
	 * Node.js Javascript handlers.
	 *
	 * @return array
	 *    The list of JavaScript handler files.
	 */
	public function jsHandlers()
	{
		return array(
			'js/nodejs_notify.js',
		);
	}


	/**
	 * Node.js message handlers.
	 *
	 * @return array
	 *    The list of message callbacks.
	 */
	public function msgHandlers()
	{
		return array();
	}


	/**
	 * Node.js user channels.
	 *
	 * @return array
	 *    The list of user channels.
	 */
	public function userChannels()
	{
		return array(// 'nodejs_notify_',
		);
	}


	/**
	 * Node.js user presence list.
	 *
	 * @param $account
	 *
	 * @return array
	 *    List of users who can see presence notifications about me.
	 */
	public function userPresenceList($account)
	{
		return array();
	}

}
