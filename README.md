Node.js Notify (e107 v2 plugin)
===============================

Displaying realtime notifications originated from Node.js server. The plugin uses the jGrowl jQuery library to display messages, and AudioJS to play sound alert.

Requirements:
- e107 CMS v2
- Node.js (*nodejs*) plugin
- (optional) Node.js PM (*nodejs_pm*) plugin
- (optional) Node.js Forum (*nodejs_forum*) plugin [under development]

Features:
- Broadcast notification: Admins can send broadcast messages to logged in users
- Provides a NodeJS (JavaScript) callback to display messages
- Provides a simple API to allow other plugins to use a global "Notification Settings" form, where user can enable/disable diferent kind of notifications (popup message and/or sound alert). To use this global form, you have to use *'e_nodejs_notify.php'* addon file in your plugin directory, and you have to define two EUFs (Extended User Field) in your *plugin.xml*. These EUF fields store user defined configurations to handle alert messages and sounds. You have to define two EUF fields to each configuration item. How does it work? See usage in *'nodejs_pm'* and *'nodejs_forum'* plugins.

### Questions about this project?

Please feel free to report any bug found. Pull requests, issues, and plugin recommendations are more than welcome!

### Donate with [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQYDBAMQ3D2UG)

If you think this plugin is useful and saves you a lot of work, a lot of costs (PHP developers are expensive) and let you sleep much better, then donating a small amount would be very cool.

[![Paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQYDBAMQ3D2UG)

Screenshots
===========

#### Admin UI
![Screenshot 1](https://www.dropbox.com/s/8xsrml04thjsqag/01.png?dl=1)

#### Displaying broadcast notification popup message, which was sent from Admin UI.
![Screenshot 2](https://www.dropbox.com/s/3pbqngycy86jnq1/02.png?dl=1)

#### Global Notification Settings form (*'nodejs_forum'* and *'nodejs_pm'* plugins are in use)
![Screenshot 3](https://www.dropbox.com/s/ekmhwvcqp9zwt3r/03.png?dl=1)



## Support on Beerpay
Hey dude! Help me out for a couple of :beers:!

[![Beerpay](https://beerpay.io/lonalore/nodejs_notify/badge.svg?style=beer-square)](https://beerpay.io/lonalore/nodejs_notify)  [![Beerpay](https://beerpay.io/lonalore/nodejs_notify/make-wish.svg?style=flat-square)](https://beerpay.io/lonalore/nodejs_notify?focus=wish)