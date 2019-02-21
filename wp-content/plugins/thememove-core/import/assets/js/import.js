'use strict';

window.tm_import = {};

(function (tm_import, $) {
    tm_import = tm_import || {};

    $.extend(tm_import, {
        ajax_url: tm_import_vars.ajax
    });

}).apply(this, [window.tm_import, jQuery]);

(function (tm_import, $) {
    tm_import = tm_import || {};

    $.extend(tm_import, {
        ImportDummy: {
            init: function () {

                this.interval = 0;
                this.fake2Timeout;
                this.noticeTimeout;
                this.errorTimeout;
                this.intervalClerer;

                this.$select = $('#dummy-select');
                this.$submit = $('#dummy-submit');
                this.$form = $('#dummy-form');
                this.$response = $('#dummy-response');
                this.$progressBar = $('#dummy-form .progress');

                this.selectDummy();
                this.importAction();
            },
            selectDummy: function () {
                var self = this;

                self.$select.on('change', function () {
                    var screenshot_src = self.$select.find(':selected').attr('data-screenshot');
                    var imported = self.$select.find(':selected').attr('data-imported');
                    var $page_preview = $('.page-preview', self.$form);
                    var $img = $('img', $page_preview);

                    self.clearResponseArea();

                    if ('undefined' != typeof screenshot_src) {
                        $img.attr('src', screenshot_src);
                    }

                    if ('undefined' != typeof imported && 'true' == imported) {
                        $page_preview.addClass('imported').find('span').remove();
                        $img.after('<span>Imported</span>');
                    } else {
                        $page_preview.removeClass('imported');
                        $page_preview.find('span').remove();
                    }

                    if ('' == self.$select.val()) {
                        self.$submit.attr('disabled', 'disabled');
                    } else {
                        self.$submit.removeAttr('disabled');
                    }

                });
            },
            importAction: function () {
                var self = this;

                self.$form.on('submit', function (e) {

                    e.preventDefault();

                    $(this).addClass('loading');

                    clearInterval(self.intervalClerer);

                    self.initialLoading(30, 50, 70);

                    self.clearResponseArea();

                    var data = $(this).serialize(),
                        selected = self.$select.find(':selected');

                    data += '&action=import_dummy';

                    self.importAjax(data);
                });
            },
            importAjax: function (data) {
                var self = this;

                $.ajax({
                    url: tm_import.ajax_url,
                    data: data,
                    dataType: 'json',
                    timeout: 1000000,
                    success: function (response) {

                        if (!response) {
                            self.$response.html('<div class="import-warning">Empty AJAX response, please try again.</div>').fadeIn();
                        } else if (response.status == 'success') {
                            self.$response.html('<div class="import-success">' + response.message + '</div>').fadeIn();

                            self.$select.find(':selected').attr('data-imported', 'true');

                            $('.page-preview', self.$form).addClass('imported').find('span').remove();
                            $('.page-preview img', self.$form).after('<span>Imported</span>');

                        } else if (response.status == 'fail') {
                            self.$response.html('<div class="import-error">' + response.message + '</div>').fadeIn();
                        } else {
                            self.$response.html('<div class="">' + response + '</div>').fadeIn();
                        }

                    },
                    error: function (response) {
                        self.$response.html( '<div class="import-warning">Import AJAX problem. Please try import data manually.</div>' ).fadeIn();
                        console.log(response);
                        console.log('Import ajax ERROR');
                    },
                    complete: function () {

                        self.clearInitialLoading();

                        self.$form.removeClass('loading');

                        self.updateProgress(self.$progressBar, 100, 0);

                        self.$progressBar.parent().find('.import-notice').remove();

                        self.intervalClerer = setTimeout(function () {
                            self.destroyProgressBar(200);
                        }, 2000);
                    },
                });
            },
            initialLoading: function (fake1progress, fake2progress, noticeProgress) {
                var self = this;

                self.destroyProgressBar(0);

                self.updateProgress(self.$progressBar, fake1progress, 200);

                self.fake2Timeout = setTimeout(function () {
                    self.updateProgress(self.$progressBar, fake2progress, 100);
                }, 25000);

                self.noticeTimeout = setTimeout(function () {
                    self.updateProgress(self.$progressBar, noticeProgress, 100);
                    self.$progressBar.after('<p class="import-notice small">Please wait,t theme needs much time to download all attachments</p>');
                }, 60000);

                self.errorTimeout = setTimeout(function () {
                    self.$progressBar.parent().find('.import-notice').remove();
                    self.$progressBar.after('<p class="import-error small">Something wrong with import. Please try to import data manually</p>');
                }, 3100000);
            },
            clearInitialLoading: function () {
                clearTimeout(this.fake2Timeout);
                clearTimeout(this.noticeTimeout);
                clearTimeout(this.errorTimeout);
            },
            destroyProgressBar: function (hide) {
                this.$progressBar.hide(hide).find('div').attr('aria-valuenow', 0).width(0);
            },
            updateProgress: function (el, to, interval) {
                el.show();

                clearInterval(this.interval);

                var from = el.find('div').attr('aria-valuenow'),
                    i = from;

                if (interval == 0) {
                    el.find('div').attr('aria-valuenow', 100).width(el.find('div').attr('aria-valuenow') + '%');
                } else {
                    this.interval = setInterval(function () {
                        if (i == to) {
                            clearInterval(this.interval);
                        } else {
                            i++;
                            el.find('div').attr('aria-valuenow', i).width(el.find('div').attr('aria-valuenow') + '%');
                        }
                    }, interval);
                }
            },
            clearResponseArea: function () {
                this.$response.fadeOut(200, function () {
                    $(this).html('');
                });
            }
        }
    });

}).apply(this, [window.tm_import, jQuery]);

(function (tm_import, $) {
    $(document).ready(function () {
        if (typeof tm_import.ImportDummy !== 'undefined') {
            tm_import.ImportDummy.init();
        }
    });
}).apply(this, [window.tm_import, jQuery]);