(function ($) {
  e107Nodejs.Nodejs.callbacks.nodejsNotify = {
    callback: function (message) {
      var notifyTime = e107NodejsNotify.settings.notification_time;
      var notifyPosition = e107NodejsNotify.settings.position;

      if (notifyTime > 0) {
        $.jGrowl(message.data.body, {header: message.data.subject, life: (notifyTime * 1000), position: notifyPosition});
      }
      else {
        $.jGrowl(message.data.body, {header: message.data.subject, sticky: true, position: notifyPosition});
      }
    }
  };
})(jQuery);
