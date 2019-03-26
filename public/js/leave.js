var date = new Date();
date.setDate(date.getDate());

let dateFormat = 'dd/mm/yyyy';
let startDate = $('.start-date');
let endDate = $('.end-date');
let fullDaySelector = $('.fullDaySelector');
let periodBoxSelector = $('.periodBoxSelector');
let hoursBoxSelector = $('.hoursBoxSelector');

fullDaySelector.hide();
periodBoxSelector.hide();
hoursBoxSelector.hide();

// get the non working days

$('.start-date').datepicker({
    format: dateFormat,    
    daysOfWeekDisabled: [0, 6]
}).on('changeDate', function () {
    showDays();
});

$('.end-date').datepicker({
    format: dateFormat,    
    daysOfWeekDisabled: [0, 6]

}).on('changeDate', function () {
    showDays();
})

// $('#hourStart').timepicker();
// $('#hourEnd').bootstrapMaterialDatePicker({ date: false });


$('.start-date, .end-date, #daySelector, #periodSelector, #hoursSelector, #leave-type').on('change', endDateChange);



function endDateChange() {

    let oneDaySummary = '<i class="ti-info-alt"></i> ' + 'You are taking ' + $('#leave-type :selected').text() +
        ' on ' + startDate.val() + '. ' + $('#daySelector :selected').text() + '.';
    let oneDaySummaryWithPeriod = '<i class="ti-info-alt"></i> ' + 'You are taking '  + $('#leave-type :selected').text() +
        ' on ' + startDate.val() + ' for ' + $('#daySelector :selected').text() + '. I will be absent in the ' + $(
            '#periodSelector :selected').text() + '.';

    let daySummary = '<i class="ti-info-alt"></i> ' + 'You are taking ' + $('#leave-type :selected').text() +
        ' from ' + startDate.val() + ' until ' + endDate.val() + '.';

    let oneDaySummaryWithHours = '<i class="ti-info-alt"></i> ' + $('#leave-type :selected').text() +
        ' on ' + startDate.val() + ' for ' + '. I will be absent from ' + $(
            '#hourStart').val() + ' until ' + $(
            '#hourEnd').val();

    if (startDate.val() == endDate.val()) {

        $('.fullDaySelector').show();

        $('.summary').empty().append(oneDaySummary);
        initializeDatepicker();

        if ($('#daySelector').val() == 1) {
            $('.periodBoxSelector').show();
            $('.hoursBoxSelector').hide();
            $('.summary').empty().append(oneDaySummaryWithPeriod);
            $('#num_nights').hide();
        } else if ($('#daySelector').val() == 3) {
            $('.periodBoxSelector').hide();
            $('.hoursBoxSelector').show();
            $('.summary').empty().append(oneDaySummaryWithHours);
            $('#num_nights').show();
        } else {
            $('.periodBoxSelector').hide();
            $('.summary').empty().append(oneDaySummary);
            $('#num_nights').show();
        }

    } else {

        $('.fullDaySelector').hide();
        $('.summary').empty().append(daySummary);
    }
}

function showDays() {

    var start = moment($('.start-date').datepicker('getDate'), dateFormat);
    var end = moment($('.end-date').datepicker('getDate'), dateFormat);

    if (start.isValid() && end.isValid()) {
        var duration = moment.duration(end.diff(start));
    }
    let total = duration.days() + 1;

    let normalMessage = `You're taking ${total} ${pluralize('day',total)} leave`;
    let moreThan10DaysMessage = `Holy smoke! You're taking ${total} ${pluralize('day',total)} leave`;

    total > 10 ? $('#num_nights').empty().append(moreThan10DaysMessage) : $('#num_nights').empty().append(normalMessage);

}

function initializeDatepicker() {
    startDate.datepicker();
    endDate.datepicker();
}
