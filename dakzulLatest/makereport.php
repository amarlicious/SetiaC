<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reportText = htmlspecialchars($_POST['reportText'] ?? '');
    $categories = $_POST['categories'] ?? [];
    $uploadDir = 'uploads/';
    $uploadedFile = '';

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir);
    }

      if (isset($_FILES['uploadPhoto']) && $_FILES['uploadPhoto']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['uploadPhoto']['tmp_name'];
        $filename = basename($_FILES['uploadPhoto']['name']);
        $targetFile = $uploadDir . $filename;
        move_uploaded_file($tmpName, $targetFile);
        $uploadedFile = $targetFile;
      }

      echo "<p><strong>Report Submitted:</strong></p>";
      if ($uploadedFile) {
        echo "<p><strong>Uploaded Photo:</strong> <img src='$uploadedFile' width='200'></p>";
      }
    }
?> 

