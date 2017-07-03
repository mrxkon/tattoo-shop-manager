(function ($) {

    $(document).ready(function () {

        // Appointments Menu

        hasapptax = $('body').hasClass('taxonomy-tsm-appointments-taxonomy');

        if (hasapptax) {
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('#toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').attr('aria-haspopup', 'false');
            $('a:contains("Appointment Types")').parent().addClass("current");
        }

        // Employees Menu

        hasstafftax = $('body').hasClass('taxonomy-tsm-employees-taxonomy');

        if (hasstafftax) {
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('#toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').attr('aria-haspopup', 'false');
            $('a:contains("Job Positions")').parent().addClass("current");
        }

        // Inks Menu

        hasinkstax = $('body').hasClass('taxonomy-tsm-inks-taxonomy');

        if (hasinkstax) {
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('#toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').attr('aria-haspopup', 'false');
            $('a:contains("Ink Companies & Sets")').parent().addClass("current");
        }

        // Needles Menu

        hasneedlestax = $('body').hasClass('taxonomy-tsm-needles-taxonomy');

        if (hasneedlestax) {
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('#toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('#toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-menu-open');
            $('a.toplevel_page_tattoo-shop-manager').addClass('wp-has-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').removeClass('wp-not-current-submenu');
            $('a.toplevel_page_tattoo-shop-manager').attr('aria-haspopup', 'false');
            $('a:contains("Needle Companies")').parent().addClass("current");
        }

        // Flatpickr Settings

        $('#tsm_client_meta_birthday').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true
        });

        $('#tsm_employee_meta_birthday').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true
        });

        $('#tsm_ink_meta_expiration').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true
        });

        $('#tsm_needle_meta_expiration').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true
        });

        $('#tsm_appointment_meta_date').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true
        });

        $('#tsm_appointment_meta_time').flatpickr({
            enableTime: true,
            noCalendar: true,
            enableSeconds: false,
            time_24hr: true,
            dateFormat: "H:i",
            defaultHour: 12,
            defaultMinute: 0
        });

        var theMonth = new Date();
        var firstMonthDay = new Date(theMonth.getFullYear(), theMonth.getMonth(), 1);
        var lastMonthDay = new Date(theMonth.getFullYear(), theMonth.getMonth() + 1, 0);

        $('#strdate').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            defaultDate: firstMonthDay
        });

        $('#enddate').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            defaultDate: lastMonthDay
        });

        istsmpanel = $('body').hasClass('toplevel_page_tattoo-shop-manager');

        if (istsmpanel) {
            $('#tsmrevenueform').submit();
        }

    });

})(jQuery);