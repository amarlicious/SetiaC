

<?php
session_start();
// Sertakan fail koneksi database
// Pastikan laluan ke connect.php betul dari lokasi fail ini.
// Berdasarkan perbincangan sebelum ini, jika reportSubmitted.php di 'adminfile'
// dan connect.php di 'dakzulLatest', laluan ini adalah betul.
require_once '../dakzulLatest/connect.php'; 

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
    echo "<p style='color: red; text-align: center;'>ID Laporan tidak diberikan untuk memaparkan butiran.</p>";
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
    <link rel="stylesheet" href="../css/reportSubmit.css" />
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
    </style>
</head>
<body>
    <div class="head">
        <h1>Report Submit</h1>
    </div>

    <div class="main-content">
        <div class="bulatan">
            <img class="icon" src="../image/right icon.jpg" alt="Success" />
        </div>
        <div class="text">
            <p>Report Submit Successfully!</p>
        </div>

        <?php if ($report_details): // Jika butiran laporan berjaya diambil, paparkan ?>
            <div class="report-summary">
                <h2 class="center-text">Report details</h2>
                <p><strong>Report's ID:</strong> <span><?php echo htmlspecialchars($report_details['report_id']); ?></span></p>
                <p><strong>User:</strong> <span><?php echo htmlspecialchars($report_details['reporter_username']); ?></span></p>
                <p><strong>Date:</strong> <span><?php echo htmlspecialchars(date('d M Y, H:i A', strtotime($report_details['report_date']))); ?></span></p>
                <p><strong>Categori:</strong> <span><?php echo htmlspecialchars($report_details['category']); ?></span></p>
                <p><strong>Report:</strong> <span><?php echo nl2br(htmlspecialchars($report_details['report_text'])); ?></span></p>
                <?php if ($report_details['image_path']): ?>
                    <p><strong>Picture:</strong></p>
                    <img src="<?php echo htmlspecialchars($report_details['image_path']); ?>" alt="Gambar Laporan" class="report-image" />
                <?php else: ?>
                    <p><strong>Picture:</strong> <span>No picture upload.</span></p>
                <?php endif; ?>
                
            </div>
        <?php endif; ?>
    </div>
    
    <div>
        <a href="../dakzulLatest/main.php"><button class="home-button">Home</button></a>
    </div>

</body>
</html>