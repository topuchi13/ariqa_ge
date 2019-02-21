jQuery(document).ready(function ($) {

    $('#tm_popup_active').on('change', function () {

        if (!$(this).prop('checked')) {
            $('.cmb-row').addClass('inactive');
            $(this).closest('.cmb-row').removeClass('inactive');
        } else {
            $('.cmb2-id-tm-popup-appearance').removeClass('inactive');
            $('.cmb2-id-tm-popup-max-width').removeClass('inactive');
            $('.cmb2-id-tm-popup-display-animation').removeClass('inactive');
            $('.cmb2-id-tm-popup-closing-animation').removeClass('inactive');
            $('.cmb2-id-tm-popup-display-title').removeClass('inactive');

            $('.cmb2-id-tm-popup-show-post-type').removeClass('inactive');
            $('.cmb2-id-tm-popup-display').removeClass('inactive');
            $('.cmb2-id-tm-popup-display-role').removeClass('inactive');
            $('.cmb2-id-tm-popup-display-mode').removeClass('inactive');

            $('.cmb2-id-tm-popup-hide-title').removeClass('inactive');
            $('.cmb2-id-tm-popup-can-hide').removeClass('inactive');
            $('.cmb2-id-tm-popup-close-hide').removeClass('inactive');

            $('#tm_popup_show_post_type').trigger('change');
            $('.cmb2-id-tm-popup-display input[type="radio"]').trigger('change');
            $('#tm_popup_can_hide').trigger('change');
            $('#tm_popup_close_hides').trigger('change');

            $('.cmb2-id-tm-popup-display span').each(function () {
                if ($(this).parent().find('input[type="radio"]').prop('checked')) {
                    $(this).removeClass('inactive');
                }

            });
        }
    });

    $('#tm_popup_show_post_type').on('change', function () {

        var $select = $(this);
        var $postsRow = $('.cmb2-id-tm-popup-posts');
        var $excludeArchive = $('.cmb2-id-tm-popup-exclude-archive-page');

        if ($select.val() != 'custom') {
            $postsRow.addClass('inactive');

            if ($select.val() != 'page') {
                $excludeArchive.removeClass('inactive');
            } else {
                $excludeArchive.addClass('inactive');
            }
        } else {
            $postsRow.removeClass('inactive');
            $excludeArchive.addClass('inactive');
        }
    });

    $('.cmb2-id-tm-popup-display input[type="radio"]').on('change', function () {

        var $radio = $(this);
        var toggle = $radio.data('toggle');
        var $span = $('.cmb2-id-tm-popup-display span');

        $span.addClass('inactive');

        if ($radio.prop('checked')) {
            $(toggle).removeClass('inactive');
        }
    });

    $('#tm_popup_can_hide').on('change', function () {

        var $popupExpire = $('.cmb2-id-tm-popup-expire');

        if (!$('#tm_popup_close_hide').prop('checked') && !$(this).prop('checked')) {
            $popupExpire.addClass('inactive');
        } else {
            $popupExpire.removeClass('inactive');
        }
    });

    $('#tm_popup_close_hide').on('change', function () {

        var $popupExpire = $('.cmb2-id-tm-popup-expire');

        if (!$('#tm_popup_can_hide').prop('checked') && !$(this).prop('checked')) {
            $popupExpire.addClass('inactive');
        } else {
            $popupExpire.removeClass('inactive');
        }
    });

    $('#tm_popup_active').trigger('change');
    $('#tm_popup_show_post_type').trigger('change');
    $('.cmb2-id-tm-popup-display input[type="radio"]').trigger('change');
    $('#tm_popup_can_hide').trigger('change');
    $('#tm_popup_close_hide').trigger('change');

    $('.cmb2-id-tm-popup-display span').each(function () {
        if ($(this).parent().find('input[type="radio"]').prop('checked')) {
            $(this).removeClass('inactive');
        }

    });
});