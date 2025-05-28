<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Report</title>
  <link rel="stylesheet" href="../css/report.css" type="text/css" />
</head>
<body>
  <div class="head">
    <h1>Report</h1>
  </div>

  <div class="camera">
    <div class="camera-container">
      <p class="addPhoto">Add Photo</p>
    </div>

    <div class="report-section-form">
      <h2 class="addReport">Add Report</h2>

      <form action="process_report.php" method="POST">
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
        <button type="submit" class="send-button">Send</button>
      </form>
    </div>
  </div>
</body>
</html>
