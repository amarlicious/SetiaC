<?php

session_start();

// Semak jika pengguna log masuk
if (!isset($_SESSION['username'])) {
    echo "Access denied. Please log in.";
    echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
    exit();
}

// Ambil data dari borang
$report_text = $_POST['report_text'] ?? '';
$categories = $_POST['site'] ?? []; // array dari checkbox
$picturePath = '';

// Gabungkan kategori jadi string, contoh: "Infrastructure, Safety"
$category_string = implode(', ', $categories);

// Urus gambar
if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
    $uploadDir = 'report_uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $picturePath = $uploadDir . uniqid('rpt_') . '_' . basename($_FILES['picture']['name']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $picturePath);
}

// Dapatkan user ID dari sesi jika ada
$username = $_SESSION['username'];
$user_sql = "SELECT id FROM member WHERE username = '$username'";
$user_result = $conn->query($user_sql);

if ($user_result->num_rows === 1) {
    $user = $user_result->fetch_assoc();
    $user_id = $user['id'];

    // Simpan ke dalam table 'report'
    $sql = "INSERT INTO report (user_id, report_text, categories, image_path)
            VALUES ('$user_id', '$report_text', '$category_string', '$picturePath')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='message'>Report successfully submitted!</div>";
        echo "<meta http-equiv='refresh' content='3;URL=reportSubmit.php'>";
    } else {
        echo "<div class='message'>Database error: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='message'>User not found.</div>";
}

$conn->close();
?>
