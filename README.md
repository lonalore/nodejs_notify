Node.js Notify (e107 v2 plugin)
===============================

Displaying realtime notifications originated from Node.js server. The plugin uses the jGrowl jQuery library to display messages, and AudioJS to play sound alert.

Requirements:
- e107 CMS v2
- NodeJS plugin (nodejs)
- NodeJS PM (optional)
- NodeJS Forum (optional) [under development]

Features:
- Broadcast notification: Admins can write broadcast messages for every logged in user
- Register a NodeJS (JavaScript) callback to display messages
- Provides a simple API to allow other plugins to use a global "Notification Settings" form, where user can enable/disable diferent kind of notifications (popup message and/or sound alert). To use this global form, you have to use 'e_nodejs_notify.php' addon file in your plugin directory, and you have to define two EUFs (Extended User Field) in your plugin.xml. These EUF fields store user defined configurations to handle alert messages and sounds. You have to define two EUF fields per configuration items. How does it work? See examples in 'nodejs_pm' and 'nodejs_forum' plugins.

### Questions about this project?

Please feel free to report any bug found. Pull requests, issues, and plugin recommendations are more than welcome!

### Donate with [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQYDBAMQ3D2UG)

If you think this plugin is useful and saves you a lot of work, a lot of costs (PHP developers are expensive) and let you sleep much better, then donating a small amount would be very cool.

[![Paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQYDBAMQ3D2UG)

Screenshots
===========

### Admin UI
![Screenshot 1](https://www.dropbox.com/s/8xsrml04thjsqag/01.png?dl=1)

### Example for displaying broadcast notification popup message, which was sent from Admin UI.
![Screenshot 2](https://www.dropbox.com/s/3pbqngycy86jnq1/02.png?dl=1)

### Global Notification Settings form (currently I use 'nodejs_forum' and 'nodejs_pm' plugins)
![Screenshot 3](https://www.dropbox.com/s/ekmhwvcqp9zwt3r/03.png?dl=1)


