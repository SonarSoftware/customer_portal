$(document).ready(function(){
    var labels = [];
    var datasets = [
        {
            label: dataUsageLabel,
            borderColor: "rgba(255, 255, 255,1)",
            backgroundColor: "rgba(46, 153, 22,1)",
            borderWidth: 1,
            data: []
        }
    ];

    for (var k in historicalUsage) {
        labels.unshift(moment(historicalUsage[k]['timestamp']).utc().format("MMM Do, YYYY"));
        datasets[0].data.unshift(historicalUsage[k]['billable']);
    }

    ctx = $("#historicalUsage");
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'GB'
                    }
                }],
                xAxes: [{
                    stacked: true
                }],
                ticks: {
                    beginAtZero: true
                }
            }
        }
    });
});