<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Graph</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
      color: #333;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      padding-top: 40px;
    }

    .chart {
      width: 500px;
      height: 500px;
      background-color: #f7f7f7;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
      margin-bottom: 20px;
    }

    .chart canvas {
      width: 100% ;
      height: 300px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #7B61FF;
    }

    #edit-button {
      display: inline-block;
      padding: 10px 25px;
      background-color: #7B61FF;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.2s ease;
      font-weight: bold;
    }

    #edit-button:hover {
      background-color: #5b47d1;
    }
  </style>
</head>
<body>

  <div class="chart">
    <h2>Number of Reports by Category</h2>
    <canvas id="myChart"></canvas>
  </div>

  <a href="admin.php" id="edit-button">Back</a>

  <script src="chart-data.js"></script>
</body>
</html>
