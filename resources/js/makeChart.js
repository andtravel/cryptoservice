import Chart from 'chart.js/auto';

fetch('/chart/data')
    .then(response => response.json())
    .then(data => {
        let count = 0
<<<<<<< HEAD
        let key;
        for (key in data) {
            count++
            const labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]
=======
        console.log(data)
        let key;
        for (key in data) {
            count++
            const labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
>>>>>>> feature_mail_service
            const dataLine = {
                label: key,
                data: data[key],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            };
            const ctx = document.getElementById(key).getContext('2d');
            const chartKey = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [dataLine]
                },
            });
        }
    });
