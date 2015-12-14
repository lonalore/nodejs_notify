var e107 = e107 || {'settings': {}, 'behaviors': {}};

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
                $.jGrowl(message.data.body, {
                    header: message.data.subject,
                    sticky: true,
                    position: notifyPosition
                });
            }

            if (message.playsound !== false) {
                // Play sound.
                e107.Nodejs.callbacks.nodejsNotifySoundAlert.callback();
            }
        }
    };

    e107.Nodejs.callbacks.nodejsNotifySoundAlert = {
        callback: function () {
            var settings = e107.settings.nodejs_notify,
                audioSel = 'audio[id*="pm-alert"]',
                html;

            var soundPath = settings.sound_path + '/sounds/message.mp3';
            html = '<audio id="pm-alert-2" class="alert" src="' + soundPath + '"></audio>';

            $('body').append(html);

            if ($(audioSel).length) {
                $(audioSel).parent('.audiojs').find('.pause').click();
                $(audioSel).parent('.audiojs').remove();
            }

            $audionInstance = audiojs.create($(audioSel));

            if ($audionInstance[0].settings.hasFlash && $audionInstance[0].settings.useFlash) {
                $audionInstance[0].settings.autoplay = true;
            }

            $(audioSel).parent('.audiojs').find('.play').click();
            $(audioSel).parent('.audiojs').addClass('pn-nj-audiojs').hide();
        }
    };

})(jQuery);
