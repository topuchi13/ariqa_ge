jQuery(document).ready(function($){

    function custom_title_style () {
        var value = $("#infinity_title_style").val();
        switch(value) {
            case "bg_color":
                $(".cmb2-id-infinity-heading-image").hide();
                $(".cmb2-id-infinity-disable-parallax").hide();
                break;
            case "image":
            case "big-image":
                $(".cmb2-id-infinity-heading-bg-color").hide();
                break;
            default:
                $(".cmb2-id-infinity-heading-image").hide();
                $(".cmb2-id-infinity-disable-parallax").hide();
                $(".cmb2-id-infinity-heading-bg-color").hide();
                $(".cmb2-id-infinity-heading-color").hide();
        }
    }

    custom_title_style();

    if($("#infinity_disable_title").prop("checked")) {
        $(".cmb2-id-infinity-title-style").hide();
        $(".cmb2-id-infinity-heading-image").hide();
        $(".cmb2-id-infinity-disable-parallax").hide();
        $(".cmb2-id-infinity-heading-bg-color").hide();
        $(".cmb2-id-infinity-heading-color").hide();
        $(".cmb2-id-infinity-alt-title").hide();
    }

    //"Enable title" options
    $("#infinity_disable_title").change(function(){
        if($("#infinity_disable_title").prop("checked")) {
            $(".cmb2-id-infinity-title-style").slideUp();
            $(".cmb2-id-infinity-heading-image").slideUp();
            $(".cmb2-id-infinity-disable-parallax").slideUp();
            $(".cmb2-id-infinity-alt-title").slideUp();
            $(".cmb2-id-infinity-heading-bg-color").slideUp();
            $(".cmb2-id-infinity-heading-color").slideUp();
        } else {
            $(".cmb2-id-infinity-title-style").slideDown();
            $(".cmb2-id-infinity-heading-image").slideDown();
            $(".cmb2-id-infinity-disable-parallax").slideDown();
            $(".cmb2-id-infinity-alt-title").slideDown();
            $(".cmb2-id-infinity-heading-bg-color").slideDown();
            $(".cmb2-id-infinity-heading-color").slideDown();
            custom_title_style();
        }
    });

    // Choose heading title style
    $("#infinity_title_style").change(function(){
        var value = $(this).val();
        switch(value) {
            case "bg_color":
                $(".cmb2-id-infinity-heading-image").slideUp();
                $(".cmb2-id-infinity-disable-parallax").slideUp();
                $(".cmb2-id-infinity-heading-bg-color").slideDown();
                $(".cmb2-id-infinity-heading-color").slideDown();
                break;
            case "image":
            case "big-image":
                $(".cmb2-id-infinity-heading-image").slideDown();
                $(".cmb2-id-infinity-disable-parallax").slideDown();
                $(".cmb2-id-infinity-heading-bg-color").slideUp();
                $(".cmb2-id-infinity-heading-color").slideDown();
                break;
            default:
                $(".cmb2-id-infinity-heading-image").slideUp();
                $(".cmb2-id-infinity-disable-parallax").slideUp();
                $(".cmb2-id-infinity-heading-bg-color").slideUp();
                $(".cmb2-id-infinity-heading-color").slideUp();
        }
    });
});