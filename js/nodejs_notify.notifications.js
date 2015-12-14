var e107 = e107 || {'settings': {}, 'behaviors': {}};

(function ($) {

    /**
     * @type {{attach: e107.behaviors.nodejsNotifyNotifications.attach}}
     */
    e107.behaviors.nodejsNotifyNotifications = {
        attach: function (context, settings) {
            $('.nodejs-notify-settings-checkbox', context).once('nodejs-notify-settings-checkbox').each(function () {
                $(this).bootstrapSwitch({
                    size: 'mini',
                    onText: e107.settings.nodejs_notify.onText,
                    offText: e107.settings.nodejs_notify.offText
                });
            });
        }
    };

})(jQuery);
