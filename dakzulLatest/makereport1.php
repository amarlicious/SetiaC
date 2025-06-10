<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setia - Report</title>
</head>
<style>
#addreport {
  font-weight: bold;
  text-align: left;
  padding-left: 5px;
}
img{
  margin-left: auto;
  margin-right: auto;
}
.report {
  max-width: 1000px;
  max-height: 1000px;
  margin: 20px auto;
  background: #fff;
  padding: 20px;
  border-radius: 10px;
}
input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-top: 10px;
  margin-bottom: 10px;
}
.categories{
  padding: 10px;
  text-align: left;
}
button, .button, input[type="submit"] {
background-color: #7B61FF;
color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
  display: inline-block;
} 
button:hover, .button:hover {
  background-color: #654bd1;
}
</style>
<body>
  <?php include("reportheader.php");  ?>
  <main>
    <section class="report">
      <h2>Report</h2>
    <form action="makeReport.php" method="POST" enctype="multipart/form-data">
        <label for="uploadPhoto">
          <img src="add-image.png" alt="Add Photo" width="300px">
        </label>
        <input type="file" id="uploadPhoto" name="uploadPhoto" hidden>

        <div>
          <p id="addreport">Add Report</p>
          <input type="text" name="reportText" placeholder="Add Report">
        </div>

        <div class="categories">
          <p id="addreport">Category</p>
          <label><input type="checkbox" name="categories[]" value="Infrastructure"> Infrastructure</label>
          <label><input type="checkbox" name="categories[]" value="Facilities"> Facilities</label>
          <label><input type="checkbox" name="categories[]" value="Safety"> Safety</label>
          <label><input type="checkbox" name="categories[]" value="Security"> Security</label>
        </div>

        <button type="submit">Send</button>
      </form>
    </section>
  </main>
<?php include("footer.php");  ?>

</body>
</html>