<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="../css/report.css" type="text/css">
    
</head>

<body>
    <div class="head">
        <h1>Report</h1>
    </div>

    <div class="camera">
        <div class="camera-container"  src="../css/camera.jpeg" alt="camera icon">
            <p class="addPhoto">Add Photo</p>
        </div>

        <div class="report-section-form">
            <h2 class="addReport">Add Report</h2>
            <form action="process_report.php" method="POST">
                <input type="text" id="reportInput" name="report_text" placeholder="Text" class="report-input">
                </form>
        </div>

        <div class="category">

        <h3 class="addcategory">Category</h3>
            
<td><input type = "checkbox" name = "site[]" value="infra"/>Infrastructure
	<input type = "checkbox" name = "site[]" value="Facilities"/>Facilities
	<input type = "checkbox" name = "site[]" value="Safety"/>Safety
    <input type = "checkbox" name = "site[]" value="Other"/>Others
</td>	
        </div>
    </div>
</body>
</html>