import { Chart, registerables } from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';
Chart.register(...registerables);

// admin dashboard chart monthly message trend.
$(function () {
    if (typeof convertObjectToArray !== 'undefined') {
        const dates = convertObjectToArray.map(function (e) {
            return e[0];
        });
        
        const msgCounts = convertObjectToArray.map(function (e) {
            return e[1];
        });
        
        const data = {
            labels: dates,
            datasets: [{
                label: 'Monthly Messages Trend',
                backgroundColor: '#7400B8',
                borderColor: '#80FFDB',
                data: msgCounts,
                datalabels: {
                    color: 'black',
                    anchor: 'end',
                    align: 'right'
                }
            }]
        };
        
        const config = {
            type: 'line',
            data: data,
            plugins: [ChartDataLabels],
            options: {}
        };
        
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );  
    }
})

// admin dashboard chart top 5 contacte.
$(function () {
    if (typeof topFiveContactsArray !== 'undefined') {

        const contactEmail = topFiveContactsArray.map(function (e) {
            return e[1]['contact_email'];
        });
        
        const contactTotalMessages = topFiveContactsArray.map(function (e) {
            return e[1]['totalMessages'];
        });
        
        const dataTopFive = {
            labels: contactEmail,
            datasets: [{
                backgroundColor: [
                    '#7400B8',
                    '#6930C3',
                    '#5E60CE',
                    '#5390D9',
                    '#4EA8DE'
                  ],
                data: contactTotalMessages,
                datalabels: {
                    color: 'white',
                }
            }]
        };
        
        const configTopFIve = {
            type: 'doughnut',
            data: dataTopFive,
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Top 5 Contacts'
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    }
                }
            }
        };
        
        const myChartTopFive = new Chart(
            document.getElementById('myChart2'),
            configTopFIve
        );
    }
})
