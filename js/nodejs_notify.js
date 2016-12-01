var e107 = e107 || {'settings': {}, 'behaviors': {}};

(function ($)
{

	/**
	 * Display real-time notifications.
	 *
	 * @type {{callback: e107.Nodejs.callbacks.nodejsNotify.callback}}
	 */
	e107.Nodejs.callbacks.nodejsNotify = {
		/**
		 * @param message object
		 *  {
         *      type: '',
		 *		playsound: true,
		 *		data: {
		 *			subject: '',
		 *			body: ''
		 *		}
		 *	}
		 */
		callback: function (message)
		{
			var notifyTime = e107.settings.nodejs_notify.notification_time;
			var notifyPosition = e107.settings.nodejs_notify.position;
			var userSettings = e107.settings.nodejs_notify.user_settings;

			if(message.type)
			{
				if(userSettings.hasOwnProperty(message.type) && userSettings[message.type] == false)
				{
					return;
				}

				var soundKey = message.type + '_sound';

				if(userSettings.hasOwnProperty(soundKey) && userSettings[soundKey] == false)
				{
					message.playsound = false;
				}
			}

			if(notifyTime > 0)
			{
				$.jGrowl(message.data.body, {
					header: message.data.subject,
					life: (notifyTime * 1000),
					position: notifyPosition
				});
			}
			else
			{
				$.jGrowl(message.data.body, {
					header: message.data.subject,
					sticky: true,
					position: notifyPosition
				});
			}

			if(message.playsound !== false)
			{
				// Play sound.
				e107.Nodejs.callbacks.nodejsNotifySoundAlert.callback();
			}
		}
	};

	/**
	 * Play sound alert.
	 *
	 * @type {{callback: e107.Nodejs.callbacks.nodejsNotifySoundAlert.callback}}
	 */
	e107.Nodejs.callbacks.nodejsNotifySoundAlert = {
		callback: function ()
		{
			var settings = e107.settings.nodejs_notify;
			var soundPath = settings.sound_path + '/sounds/message.mp3';
			var audioElement = document.createElement('audio');
			audioElement.setAttribute('src', soundPath);
			audioElement.play();
		}
	};

})(jQuery);
