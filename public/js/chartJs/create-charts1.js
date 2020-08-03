(function($) {

    var charts = {
        init: function() {
            // -- Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            this.ajaxGetConsumptionMonthlyData();

        },

        ajaxGetConsumptionMonthlyData: function() {
            var request = $.ajax({
                method: 'GET',
                url: 'complaint_status'
            });

            request.done(function(response) {
                console.log(response);
                charts.createCompletedJobsChart(response);
            });
        },

        /**
         * Created the Completed Jobs Chart
         */
        createCompletedJobsChart: function(response) {

            var ctx = document.getElementById("statusChart");
            var myLineChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: response.status,
                    datasets: [{
                        data: response.complaint_count_data,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#ff0000', '#00ff00', '#0000ff'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                // data: {
                //     // labels: response.category, // The response got from the ajax request containing all month names in the database
                //     datasets: [{
                //         label: "total",
                //         lineTension: 0.3,
                //         backgroundColor: ['#ff0000', '#00ff00', '#0000ff', '#ff00ff', '#00f0ff'],
                //         borderColor: "rgba(2,117,216,1)",
                //         pointRadius: 5,
                //         pointBackgroundColor: "rgba(2,117,216,1)",
                //         pointBorderColor: "rgba(255,255,255,0.8)",
                //         pointHoverRadius: 5,
                //         pointHoverBackgroundColor: "rgba(2,117,216,1)",
                //         pointHitRadius: 20,
                //         pointBorderWidth: 2,
                //         data: response.customer_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                //     }],
                // },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "#19252F",
                        bodyFontColor: "#fff",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: true,
                        caretPadding: 10,

                    },
                    legend: {
                        display: true
                    },
                    cutoutPercentage: 50,
                },
            });
        }
    };

    charts.init();

})(jQuery);