(function ($) {
    e107.Nodejs.callbacks.nodejsNotify = {
        callback: function (message) {
            var notifyTime = e107.settings.nodejs_notify.notification_time;
            var notifyPosition = e107.settings.nodejs_notify.position;

            if (notifyTime > 0) {
                $.jGrowl(message.data.body, {
                    header: message.data.subject,
                    life: (notifyTime * 1000),
                    position: notifyPosition
                });
            }
            else {
                $.jGrowl(message.data.body, {header: message.data.subject, sticky: true, position: notifyPosition});
            }
        }
    };
})(jQuery);
