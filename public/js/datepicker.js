/**
 * https://github.com/eternicode/bootstrap-datepicker
 */

jQuery(function ($) {
    $(document).ready(function () {
        $(".datepicker").datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1,
            todayBtn: true,
            language: "nl-BE",
            orientation: "bottom left",
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: true
        });
    });//einde doc.ready
});
