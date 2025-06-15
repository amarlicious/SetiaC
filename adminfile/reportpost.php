<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    echo "Akses ditolak. Silakan masuk terlebih dahulu.";
    // Arahkan kembali ke halaman login setelah beberapa detik
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}

// Sertakan file koneksi database
// Sesuaikan path ini agar sesuai dengan lokasi file db_connection.php Anda.
// Contoh: Jika reportpost.php dan db_connection.php berada di folder yang sama.
require_once 'connect.php'; 

$responseMessage = ''; // Variabel untuk pesan respons

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $username = $_SESSION['username'];
    $report_text = $_POST['report_text'] ?? ''; 
    $categories = $_POST['site'] ?? [];
    $categories_string = implode(', ', $categories); // Ubah array kategori menjadi string yang dipisahkan koma

    $image_path = null; // Inisialisasi path gambar

    // --- Penanganan Unggah Gambar ---
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../uploads/"; // Direktori tempat gambar akan disimpan.
                                   // Pastikan direktori ini ada dan bisa ditulisi oleh server web.
                                   // Sesuaikan path ini dengan struktur folder Anda.
                                   // Contoh: Jika file PHP Anda di 'Project/' dan 'uploads/' di root,
                                   // maka '../uploads/' adalah path yang benar.

        // Buat direktori 'uploads' jika belum ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Buat direktori dengan izin 0777 (full permission), true untuk rekursif
        }

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif']; // Tipe file yang diizinkan
        $max_file_size = 5 * 1024 * 1024; // 5 MB

        $file_type = mime_content_type($_FILES['picture']['tmp_name']);
        $file_size = $_FILES['picture']['size'];

        // Validasi tipe file
        if (!in_array($file_type, $allowed_types)) {
            $responseMessage = "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        }
        // Validasi ukuran file
        else if ($file_size > $max_file_size) {
            $responseMessage = "Maaf,file Anda terlalu besar. Maksimum 5MB.";
        } else {
            // Hasilkan nama file yang unik untuk mencegah konflik dan masalah keamanan
            $file_extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
            $new_file_name = uniqid('report_', true) . '.' . $file_extension;
            $target_file = $target_dir . $new_file_name;

            // Pindahkan file yang diunggah ke direktori target
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
                $image_path = $target_file; // Simpan path relatif di database
            } else {
                $responseMessage = "Ada kesalahan saat mengunggah file Anda.";
            }
        }
    } else if (isset($_FILES['picture']) && $_FILES['picture']['error'] != UPLOAD_ERR_NO_FILE) {
        // Tangani error upload lainnya (selain dari UPLOAD_ERR_NO_FILE yang berarti tidak ada file yang diunggah)
        $responseMessage = "Ada kesalahan saat mengunggah gambar: Error Code " . $_FILES['picture']['error'];
    }

    // --- Simpan data ke database ---
    if (empty($responseMessage)) { // Hanya proses jika tidak ada kesalahan dari unggahan gambar
        try {
            // Gunakan prepared statement untuk mencegah SQL Injection
            $stmt = $conn->prepare("INSERT INTO reports (username, report_text, image_path, categories) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $report_text, $image_path, $categories_string);

            if ($stmt->execute()) {
                // Jika berhasil, arahkan ke halaman konfirmasi
                header("Location: reportsubmit.php");
                exit();
            } else {
                $responseMessage = "Error: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            $responseMessage = "Database error: " . $e->getMessage();
        }
    }
} else {
    $responseMessage = "Form tidak disubmit.";
}

// Tutup koneksi database
$conn->close();

// Jika ada pesan kesalahan, tampilkan di sini atau log
if (!empty($responseMessage)) {
    echo "<h1>Error</h1>";
    echo "<p>" . $responseMessage . "</p>";
    echo "<p>Anda akan diarahkan kembali ke halaman laporan dalam 5 detik.</p>";
    echo "<meta http-equiv='refresh' content='5; URL=report.php'>"; // Kembali ke form jika ada error
}
?>
