<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KazinDMC CRM : Staff Performance Graphical</title>
    <link rel="icon" type="image/png" href="http://localhost/kazindmc/assets/images/favicon.ico" sizes="32x32" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2 style="text-align:center;font-weight:normal;">Staff Performance Report For <u style="font-weight: 600;color: #828487;">'<?=$staff_name?>'</u> From <u style="font-weight: 600;color: #828487;"><?=date('d M Y',strtotime($date_from))?></u> To <u style="font-weight: 600;color: #828487;"><?=date('d M Y',strtotime($date_to))?></u></h2>
    <canvas id="staffChart" width="800" height="200"></canvas>

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
                label: 'Cancel at arrival',
                data: staffData.map(staff => staff["cancel-at-arrival"]),
                backgroundColor: 'rgba(220, 53, 68, 0.5)', 
                borderColor: 'rgba(220, 53, 68, 1)',
                borderWidth: 1
            },
            {
                label: 'Not-materialized',
                data: staffData.map(staff => staff["not-materialized"]),
                backgroundColor: 'rgba(240, 113, 1, 0.5)', 
                borderColor: 'rgba(240, 113, 1, 1)',
                borderWidth: 1
            },
            {
                label: 'Pending',
                data: staffData.map(staff => staff["pending"]),
                backgroundColor: 'rgba(0, 0, 0, 0.5)', 
                borderColor: 'rgba(0, 0, 0, 1)',
                borderWidth: 1
            },
            {
                label: 'In-progress',
                data: staffData.map(staff => staff["in-progress"]),
                backgroundColor: 'rgba(102, 51, 153, 0.5)',
                borderColor: 'rgba(102, 51, 153, 1)',
                borderWidth: 1
            },
            {
                label: 'Confirm',
                data: staffData.map(staff => staff["confirm"]),
                backgroundColor: 'rgba(0, 132, 0, 0.5)',
                borderColor: 'rgba(0, 132, 0, 1)',
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
