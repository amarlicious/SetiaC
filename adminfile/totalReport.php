<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .report-summary-card {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .report-summary-card h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2em;
        }
        .report-summary-card .count {
            font-size: 4em;
            color: #7B61FF; /* Warna seperti butang anda */
            font-weight: bold;
            margin-bottom: 20px;
        }
        .report-summary-card p {
            color: #666;
            font-size: 1.1em;
        }
    </style>
</head>
<body>

    <div class="report-summary-card">
        <h2>Jumlah Laporan Dihantar</h2>
        <?php
       
        include 'connect.php';

      
        $sql = "SELECT COUNT(*) AS total_reports FROM reports";
        $result = $conn->query($sql);

        // Semak jika query berjaya
        if ($result) {
            $row = $result->fetch_assoc();
            $totalReports = $row['total_reports'];
            echo '<div class="count">' . $totalReports . '</div>';
            echo '<p>Setakat ini, terdapat laporan yang telah dihantar.</p>';
        } else {
            echo '<p class="error">Ralat mengambil data: ' . $conn->error . '</p>';
        }

        // Tutup sambungan pangkalan data
        $conn->close();
        ?>
    </div>

</body>
</html>