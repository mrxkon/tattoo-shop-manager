(function ($) {

    $(document).ready(function () {

        // Flatpickr Settings

        $('#tsm_client_meta_birthday').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            locale: {
                firstDayOfWeek: 1
            }
        });

        $('#tsm_employee_meta_birthday').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            locale: {
                firstDayOfWeek: 1
            }
        });

        $('#tsm_ink_meta_expiration').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            locale: {
                firstDayOfWeek: 1
            }
        });

        $('#tsm_needle_meta_expiration').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            locale: {
                firstDayOfWeek: 1
            }
        });

        $('#tsm_appointment_meta_date').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            locale: {
                firstDayOfWeek: 1
            }
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
            defaultDate: firstMonthDay,
            locale: {
                firstDayOfWeek: 1
            }
        });

        $('#enddate').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d H:i:s",
            altFormat: 'd-M-Y',
            mode: 'single',
            shorthandCurrentMonth: true,
            defaultDate: lastMonthDay,
            locale: {
                firstDayOfWeek: 1
            }
        });

        istsmpanel = $('body').hasClass('toplevel_page_tattoo-shop-manager');

        if (istsmpanel) {
            $('#tsmrevenueform').submit();
        }

    });

})(jQuery);