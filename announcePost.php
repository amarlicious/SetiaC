

<?php
session_start();
// Sertakan fail koneksi database
// Pastikan laluan ke connect.php betul dari lokasi fail ini.
// Berdasarkan perbincangan sebelum ini, jika reportSubmitted.php di 'adminfile'
// dan connect.php di 'dakzulLatest', laluan ini adalah betul.
require_once 'connect.php'; 

// Semak sama ada pengguna sudah log masuk
if (!isset($_SESSION['username'])) { 
    echo "Akses ditolak. Sila log masuk.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>"; // Redirect ke halaman login
    exit();
}

$report_details = null; // Pembolehubah untuk menyimpan butiran laporan

// Semak jika report_id dihantar melalui URL (GET parameter)
if (isset($_GET['report_id'])) {
    $report_id = $_GET['report_id'];

    // Dapatkan butiran laporan dari database
    // JOIN dengan jadual residence untuk dapatkan username penghantar
    $sql = "SELECT r.*, res.username AS reporter_username 
            FROM reports r 
            JOIN residence res ON r.user_id = res.id 
            WHERE r.report_id = ?"; 
    
    

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $report_id); // 'i' untuk integer (report_id)
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $report_details = $result->fetch_assoc();
        } else {
            // Laporan tidak ditemui dalam database
            echo "<p style='color: red; text-align: center;'>Laporan tidak ditemui dalam sistem.</p>";
        }
        $stmt->close();
    } else {
        // Ralat penyediaan statement SQL
        echo "<p style='color: red; text-align: center;'>Ralat pangkalan data: " . $conn->error . "</p>";
    }
} else {
    // report_id tidak dihantar melalui URL
    echo "";
}

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Submit report</title>
    <link rel="stylesheet" href="css/reportSubmit.css" />
    <style>
      
        .report-summary {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px; /* Lebar maksimum ringkasan laporan */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            line-height: 1.6;
        }
        .report-summary p {
            margin-bottom: 8px;
        }
        .report-summary strong {
            display: inline-block;
            width: 100px; /* Lebar tetap untuk label */
            vertical-align: top; /* Jajarkan ke atas jika teks panjang */
        }
        .report-summary span {
            display: inline-block;
            width: calc(100% - 110px); /* Lebar sisa untuk nilai */
            vertical-align: top;
        }
        .report-image {
            max-width: 100%;
            height: auto;
            display: block; /* Pastikan gambar berada di baris sendiri */
            margin-top: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .center-text {
            text-align: center;
        }
        .report-summary h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
         .header {
            background-color: #7B61FF;
            color: white;
            padding: 1px;
            display: flex;
            align-items: center;
            justify-content: flex-start; 
            gap: 20px; 
            font-family: Arial, sans-serif;
        }
       #text {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 id="text">Report Submit</h1>
    </div>

    <div class="main-content">
        <div class="bulatan">
            <img class="icon" src="image/right icon.jpg" alt="Success" />
        </div>
        <div class="text">
            <p>Announcement Submit!</p>
        </div>


    </div>
    
    <div>
        <a href="main.php"><button class="home-button">Home</button></a>
    </div>

</body>
</html>