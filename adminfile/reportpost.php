<?php
session_start();
require_once '../dakzulLatest/connect.php'; 

if (!isset($_SESSION['username'])) { 
    echo "Akses ditolak. Sila log masuk.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>"; 
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $user_id = null; 

    $sql_get_user_id = "SELECT id FROM residence WHERE username = ?";
    if ($stmt_id = $conn->prepare($sql_get_user_id)) {
        $stmt_id->bind_param("s", $username);
        $stmt_id->execute();
        $result_id = $stmt_id->get_result();
        if ($result_id->num_rows == 1) {
            $user_data = $result_id->fetch_assoc();
            $user_id = $user_data['id'];
        }
        $stmt_id->close();
    }

    if ($user_id === null) {
        echo "Ralat: User ID tidak ditemui untuk username ini. Sila log masuk semula.";
        echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
        exit();
    }

    $report_text = $_POST['report_text'];
    $categories = isset($_POST['site']) ? $_POST['site'] : []; 
    $category_string = implode(', ', $categories);
    $image_path = null; 

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['picture']['name'];
        $file_tmp_name = $_FILES['picture']['tmp_name'];
        $file_size = $_FILES['picture']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_ext = ['jpeg', 'jpg', 'png', 'gif'];

        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = uniqid('report_') . '.' . $file_ext;
            // Pastikan upload_dir ini betul.
            // Jika reportpost.php di 'adminfile' dan folder 'uploads' di root 'SetiaC':
            $upload_dir = '../uploads/'; // <--- KEMBALI KE LOKASI UPLOADS YANG BETUL
            // Jika folder 'uploads' berada dalam folder 'adminfile' yang sama:
            // $upload_dir = 'uploads/';
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); 
            }

            $destination = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp_name, $destination)) {
                $image_path = $destination;
            } else {
                echo "Gagal memuat naik gambar.<br>";
            }
        } else {
            echo "Format fail tidak dibenarkan. Sila muat naik JPEG, JPG, PNG atau GIF.<br>";
        }
    } else if (isset($_FILES['picture']) && $_FILES['picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "Ralat muat naik gambar: " . $_FILES['picture']['error'] . "<br>";
    }

    $sql_insert_report = "INSERT INTO reports (user_id, report_text, category, image_path) VALUES (?, ?, ?, ?)";

    if ($stmt_insert = $conn->prepare($sql_insert_report)) {
        $stmt_insert->bind_param("isss", $user_id, $report_text, $category_string, $image_path);

        if ($stmt_insert->execute()) {
            // Dapatkan ID laporan yang baru dimasukkan
            $new_report_id = $conn->insert_id; // <--- BARIS INI PENTING

            // Lakukan redirect menggunakan header() dan hantar report_id
            // Pastikan laluan ke reportSubmitted.php adalah betul RELATIF kepada reportpost.php
            // Jika reportpost.php dan reportSubmitted.php berada dalam folder 'adminfile' yang sama:
            header("Location: reportSubmit.php?report_id=" . $new_report_id);
            // Jika reportSubmitted.php berada di '../dakzulLatest/' dari reportpost.php (yang di adminfile):
            // header("Location: ../dakzulLatest/reportSubmitted.php?report_id=" . $new_report_id);
            
            exit(); // Sangat penting untuk keluar selepas header() redirect

            // BUANG BARIS INI: echo "Laporan berjaya dihantar!";
            // BUANG BARIS INI: echo "<meta http-equiv='refresh' content='3; URL=reportSubmit.php'>";
        } else {
            echo "Ralat ketika menghantar laporan: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    } else {
        echo "Ralat penyediaan statement laporan: " . $conn->error;
    }

    $conn->close();

} else {
    echo "Akses ditolak. Borang tidak dihantar.";
    echo "<meta http-equiv='refresh' content='3; URL=report.php'>";
    exit();
}
?>