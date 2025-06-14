<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Access denied. Please log in.";
    echo "<meta http-equiv='refresh' content='3; URL=homepage.php'>";
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

</head>
<body>
<?php include("burger.php");?>

<div class="head">
  <h1>Report</h1>
</div>

<form < id="form1" name="form1" action="reportpost.php" enctype="multipart/form-data" method="POST">
>
  <div class="camera">
  <div class="camera-container">
    <p class="addPhoto">Add Photo</p>
    <input type="file" name="picture" id="picture" />
  </div>

  <div class="report-section-form">
    <h2 class="addReport">Add Report</h2>

    
      <!-- Report Text -->
      <input type="text" id="reportInput" name="report_text" placeholder="Text" class="report-input" />

      <h3 class="addcategory">Category</h3>
      <div class="chckbxcategory">
        <label class="checkbox-item">
          <input type="checkbox" name="site[]" value="Infrastructure" /> Infrastructure
        </label>
        <label class="checkbox-item">
          <input type="checkbox" name="site[]" value="Facilities" /> Facilities
        </label>
        <label class="checkbox-item">
          <input type="checkbox" name="site[]" value="Safety" /> Safety
        </label>
        <label class="checkbox-item">
          <input type="checkbox" name="site[]" value="Other" /> Others
        </label>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="send-button" name="submit">Send</button>
  
  </div>
</form>
</div>
</body>
</html>
