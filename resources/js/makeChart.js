import Chart from 'chart.js/auto';

fetch('/chart/data')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const labels = [1,2,3,4,5,6,7,8,9,10,11,12]
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'График',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });
    });
