<?php
session_start();

if (isset($_POST['submit'])) {
    if (!empty($_SESSION)) {
        header("Location: reportSubmit.php");
        exit();
    } else {
        session_destroy();
        echo "Sorry. Your login attempt was not successful. Please try again!<br>";
        echo "<meta http-equiv='refresh' content='3; URL=index.php'>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Report</title>
  <link rel="stylesheet" href="../css/report.css" type="text/css" />
  <script>
    function validateForm(event) {
      const text = document.getElementById("reportInput").value.trim();
      const checkboxes = document.querySelectorAll('input[name="site[]"]:checked');
      
      if (text === "") {
        alert("Please fill in the report text.");
        event.preventDefault(); // Halang submit
        return false;
      }

      if (checkboxes.length === 0) {
        alert("Please select at least one category.");
        event.preventDefault(); // Halang submit
        return false;
      }

      return true;
    }
  </script>
</head>
<body>
<?php include("burger.php");?>

<div class="head">
  <h1>Report</h1>
</div>

<div class="camera">
  <div class="camera-container">
    <p class="addPhoto">Add Photo</p>
    <input type="file" name="picture" id="picture" />
  </div>

  <div class="report-section-form">
    <h2 class="addReport">Add Report</h2>

    <form action="report.php" method="POST" onsubmit="return validateForm(event)">
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
    </form>
  </div>
</div>
</body>
</html>
