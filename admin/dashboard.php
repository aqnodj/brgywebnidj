<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management System</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>

    <!-- for pie chart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!-- end pie chart -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        #sidebar {
            width: 200px;
            float: left;
        }
        #content {
            margin-left: 220px;
            padding: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: black;
        }
        a:hover {
            color: blue;
        }
        .total-container {
            width: 250px; /* Set a fixed width for the total population container */
            margin: 20px auto; /* Center the container with auto margins */
            padding: 10px;
            border: 1px solid #ddd; /* Optional: styling for the total container */
            border-radius: 5px;
            background-color: #f9f9f9; /* Optional: background color */
            text-align: center; /* Center text inside the container */
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <div class="logo">
            <img src="../logonav.png" alt="Logo">
        </div>
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Admin Dashboard</a></li>
           
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div id="content">
        <button id="toggle-btn"><i class="fas fa-bars"></i></button>
        <h1>Admin Dashboard</h1>

        <!-- Pie Chart Container -->
        <div class="container">
            <center>
                <div id="container" style="width: 100%; height: 400px;"></div>
            </center>
        </div>

        <?php
        include "../connections.php"; // Connection file with database
        $query = "SELECT * FROM purok_population"; // Query for the purok table
        $getData = $connections->query($query);

        $totalPopulation = 0; // Initialize total population

        // Prepare data for Highcharts
        $chartData = [];
        if ($getData->num_rows > 0) {
            while ($row = $getData->fetch_object()) {
                $chartData[] = [
                    'name' => $row->purok_name,
                    'y' => $row->population
                ];
                $totalPopulation += $row->population; // Sum population
            }
        } else {
            echo "<p>No data found.</p>";
        }
        ?>

        <div class="total-container">
            <h2>Total Population: <?php echo $totalPopulation; ?></h2> <!-- Display total population -->
        </div>

        <script>
            // Prepare data for Highcharts
            let chartData = [];
            <?php
            if (!empty($chartData)) {
                foreach ($chartData as $data) {
                    echo "chartData.push({ name: '{$data['name']}', y: {$data['y']} });";
                }
            }
            ?>

            // Build the chart
            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Resident Population by Purok'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b> (<b>{point.percentage:.1f}%</b>)'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Population',
                    colorByPoint: true,
                    data: chartData
                }],
                credits: {
                    enabled: false // Disable credits
                }
            });
        </script>
    </div>
</body>
</html>
