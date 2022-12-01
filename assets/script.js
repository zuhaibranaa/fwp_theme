(function ($) {
    const abc = (e) => {
        let data = $('#hidden_load_more_form').serialize();
        let page = $('#page_number').val((c, p) => {
            return ++p;
        })

        jQuery.post(ajax_object.ajax_url, {
            action: "get_my_properties", data,
        }, (response) => {
            $('#properties').html(function (index, currentcontent) {
                currentcontent += response;
                return currentcontent;
            });
        });
    }

    const submitRegisterForm = () => {
        let data = $('#register_form_1').serializeArray();
        let d = {};
        $.each(data, function (i, field) {
            d[field.name] = field.value;
        });
        if (d.password === d.confirm_password) {
            delete d.confirm_password;
            jQuery.post(ajax_object.ajax_url, {
                action: "create_new_user", ...d,
            }, (response) => {
                alert(response);
            });
        } else {
            throw DOMException.VALIDATION_ERR;
        }
    }

    const submitLoginForm = () => {
        let data = $('#sign_in_form').serializeArray();
        let d = {};
        $.each(data, function (i, field) {
            d[field.name] = field.value;
        });

        jQuery.post(ajax_object.ajax_url, {
            action: "login_user", ...d,
        }, (response) => {
            alert(response);
        });
    }

    $(document).ready(function () {
        var Page = (function () {
            var $nav = $('#nav-dots > span'), slitslider = $('#slider').slitslider({
                    onBeforeChange: function (slide, pos) {

                        $nav.removeClass('nav-dot-current');
                        $nav.eq(pos).addClass('nav-dot-current');

                    }
                }),

                init = function () {

                    initEvents();

                }, initEvents = function () {

                    $nav.each(function (i) {

                        $(this).on('click', function (event) {

                            var $dot = $(this);

                            if (!slitslider.isActive()) {

                                $nav.removeClass('nav-dot-current');
                                $dot.addClass('nav-dot-current');

                            }

                            slitslider.jump(i + 1);
                            return false;

                        });

                    });

                };

            return {init: init};

        })();

        Page.init();
        // Call Ajax Requests
        abc();
        $("#load_more").on('click', abc);
        $('#register_form_1_reg_btn').on('click', submitRegisterForm);
        $('#sign_in_button').on('click', submitLoginForm);
        $("#owl-example").owlCarousel();
        $('.listing-detail span').tooltip('hide');
        $('.carousel').carousel({
            interval: 3000
        });
        $('.carousel').carousel('cycle');
    });
})(jQuery);
