
var apiChart = null;
var skillChart = null;

jQuery(document).ready(function () {
    apiChart = jQuery('#apiChart');
    jQuery('#charttype').bind('change', changeChartTypeHandler);
});

var changeChartTypeHandler = function() {
    var charttype = jQuery('#charttype').val();
    var sessionid = jQuery('#sessionid').val();

    if( charttype !== 'none') {
        var url = './chart/chart_api.php';
        var params = {
            sessionid: sessionid,
            type: charttype
        };
        jQuery.get(url, params, redrawChart).fail(function(data) {
            destroyChart();
            alert(data.responseJSON.meta.msg);
        });
    }
};

var destroyChart = function() {
    if( skillChart !== null ) {
        skillChart.destroy();
    }
};

var redrawChart = function(data) {
    if( data.meta.status === 'error' ) {
        alert(data.meta.msg);
        return;
    }

    destroyChart();
    skillChart = new Chart(apiChart, {
        type: data.data.charttype,
        data: data.data.chartdata,
        options: data.data.chartoptions
    });
};
