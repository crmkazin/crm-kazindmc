<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Performance Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Staff Performance Comparison From 01/09/2024 To 30/11/2024 (Deepak Yadav, Ritu Panchal, Preeti Piwal)</h1>
    <canvas id="staffChart" width="800" height="400"></canvas>

    <script>
        // Prepare data from PHP
        const staffData = <?= json_encode($staffData); ?>;
        
        // Extract labels and datasets
        const labels = staffData.map(staff => staff.name);
        const datasets = [
            {
                label: 'Total Files',
                data: staffData.map(staff => staff["Total Files"]),
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Confirm',
                data: staffData.map(staff => staff["Confirm"]),
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Teal
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Pending',
                data: staffData.map(staff => staff["Pending"]),
                backgroundColor: 'rgba(255, 206, 86, 0.5)', // Yellow
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            },
            {
                label: 'Not Materialized',
                data: staffData.map(staff => staff["Not Materialized"]),
                backgroundColor: 'rgba(255, 99, 132, 0.5)', // Red
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Previous Confirm',
                data: staffData.map(staff => staff["Previous Confirm"]),
                backgroundColor: 'rgba(153, 102, 255, 0.5)', // Purple
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }
        ];

        // Chart configuration
        const config = {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Render the chart
        const ctx = document.getElementById('staffChart').getContext('2d');
        new Chart(ctx, config);
    </script>
</body>
</html>
