/**
 * Created by kieran.fahy on 2/16/2015.
 */

var Plugins = function() {

    "use strict";

    /**
     * Daterangepicker
     */
    var initDaterangepicker = function() {
        if ($.fn.daterangepicker) {
            $('.range').daterangepicker({
                    startDate: moment(),
                    endDate: moment().add('days',14),
                    minDate: '01/01/2015',
                    maxDate: '12/31/2018',
                    dateLimit: { days: 60 },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Last 7 Days': [moment().subtract('days', 6), moment()],
                        'Last 30 Days': [moment().subtract('days', 29), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                        'Next 14 Days': [moment(), moment().add('days',14)]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-sm btn-primary',
                    cancelClass: 'btn-sm',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom Range',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                },

                function (start, end) {
                    var range_updated = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');

                    var start_range = start.format('YYYY-MM-DD');
                    var end_range = end.format('YYYY-MM-DD');

                    var urlSeg = window.location.href.split("/").pop();

                    $.ajax({
                        url: urlSeg,
                        type:'get',
                        data: {"start_range": start_range, "end_range": end_range},
                        success: function(data){
                            var result = $('<div />').append(data).find('.table').html();
                            $('.table').html(result);
                        }
                    });

                    App.blockUI($(".table"));
                    setTimeout(function () {
                        App.unblockUI($(".table"));
                    }, 1000);

                    $('.range span').html(range_updated);
                });

            $('.range span').html(moment().format('MMMM D, YYYY') + ' - ' + moment().add('days', 14).format('MMMM D, YYYY'));
        }
    }




return {

    // main function to initiate all plugins
    init: function () {
        initDaterangepicker(); // Daterangepicker for dashboard
    }
};

}();