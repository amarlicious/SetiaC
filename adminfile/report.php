<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Access denied. Please log in.";
    echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Report</title>
    <link rel="stylesheet" href="../css/report.css" type="text/css" />
    <style>
        /* Gaya untuk mesej ralat */
        .error-message {
            color: #d9534f; /* Merah untuk ralat */
            background-color: #f9d6d5; /* Latar belakang merah pucat */
            border: 1px solid #d9534f;
            border-radius: 6px;
            padding: 10px 15px;
            margin: 15px auto;
            width: fit-content;
            text-align: center;
            font-weight: bold;
            display: none; /* Sembunyikan secara lalai */
        }
    </style>
</head>
<body>
<?php include("burger.php");?>

<div class="head">
    <h1>Report</h1>
</div>

<form id="form1" action="reportpost.php" enctype="multipart/form-data" method="POST">
    <div class="camera">
        <div class="camera-container">
            <p class="addPhoto">Add Photo</p>
            <input type="file" name="picture" id="picture" />
        </div>

        <div class="report-section-form">
            <h2 class="addReport">Add Report</h2>
            <input type="text" name="report_text" id="report_text" placeholder="Text" class="report-input" />
            
            <h3 class="addcategory">Category</h3>
            <div class="chckbxcategory">
                <label class="checkbox-item"><input type="checkbox" name="site[]" value="Infrastructure" class="category-checkbox" /> Infrastructure</label>
                <label class="checkbox-item"><input type="checkbox" name="site[]" value="Facilities" class="category-checkbox" /> Facilities</label>
                <label class="checkbox-item"><input type="checkbox" name="site[]" value="Safety" class="category-checkbox" /> Safety</label>
                <label class="checkbox-item"><input type="checkbox" name="site[]" value="Other" class="category-checkbox" /> Others</label>
            </div>

            <!-- Div untuk memaparkan mesej ralat JavaScript -->
            <div id="validationMessage" class="error-message"></div>

            <button type="submit" class="send-button" name="submit">Send</button>
        </div>
    </div>
</form>

<script>
    // Dapatkan elemen borang
    const form = document.getElementById('form1');
    const pictureInput = document.getElementById('picture');
    const reportTextInput = document.getElementById('report_text');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox'); // Dapatkan semua checkbox kategori
    const validationMessage = document.getElementById('validationMessage'); // Div untuk mesej ralat

    // Tambah event listener untuk submit borang
    form.addEventListener('submit', function(event) {
        let isValid = true; // Bendera untuk menjejak sama ada borang sah atau tidak
        let errorMessage = ''; // Mesej ralat untuk dipaparkan

        // 1. Semak input gambar (picture)
        if (pictureInput.files.length === 0) {
            isValid = false;
            errorMessage += 'Please upload picture.<br>';
        }

        // 2. Semak input teks laporan (report_text)
        if (reportTextInput.value.trim() === '') {
            isValid = false;
            errorMessage += 'Please insert report text.<br>';
        }

        // 3. Semak sekurang-kurangnya satu kategori dipilih
        let isCategorySelected = false;
        for (let i = 0; i < categoryCheckboxes.length; i++) {
            if (categoryCheckboxes[i].checked) {
                isCategorySelected = true;
                break; 
            }
        }
        if (!isCategorySelected) {
            isValid = false;
            errorMessage += 'Please insert atleast one category.<br>';
        }

    
        if (!isValid) {
            event.preventDefault(); 
            validationMessage.innerHTML = errorMessage;
            validationMessage.style.display = 'block'; 
        } else {
            validationMessage.style.display = 'none'; 
        }
    });

    // Sembunyikan mesej ralat apabila pengguna mula menaip atau memilih
    pictureInput.addEventListener('change', function() {
        validationMessage.style.display = 'none';
    });
    reportTextInput.addEventListener('input', function() {
        validationMessage.style.display = 'none';
    });
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            validationMessage.style.display = 'none';
        });
    });

</script>
</body>
</html>