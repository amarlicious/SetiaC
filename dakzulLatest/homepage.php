<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HomePage</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    .background {
      background-image: url('image/home.png'); /* Local image */
      background-size: cover;
      background-position: center;
      height: 100vh;
      position: relative;
      color: white;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.4);
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 1;
    }

    .content {
      position: relative;
      z-index: 2;
      max-width: 80%;
    }

    .content h1 {
      font-size: 2.5em;
      font-weight: bold;
      line-height: 1.5;
    }

    .highlight {
      color: red;
    }

    .top-right {
      position: absolute;
      top: 20px;
      right: 20px;
      z-index: 2;
    }

    .top-right button {
      margin-left: 10px;
      padding: 8px 16px;
      background-color: white;
      color: #333;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .top-right button:hover {
      background-color: #ddd;
    }

    .nav {
      position: absolute;
      top: 10px;
      left: 15px;
      z-index: 2;
      font-size: 14px;
      color: #ccc;
    }

  </style>
</head>
<body>
  <div class="background">
    
    <div class="overlay"></div>

    <div class="nav">HomePage</div>

 
    <div class="top-right">
      <button onclick="location.href='index.php'">Sign in</button>
      <button onclick="location.href='register.html'">Register</button>
    </div>

    <div class="content">
      <h1>See Something? Say Something. <span class="highlight">SetiaC</span> Makes Reporting Easy.</h1>
    </div>

  <section class="about-section">
  <div class="overlay"></div>
  <div class="about-content">
    <h2>About Us</h2>
    <p>
      SetiaC is an advanced platform designed for efficient reporting and tracking of various issues. It aims to streamline communication between resident and authorities, making it easier to identify problems, monitor progress, and resolve issues promptly. SetiaC leverages real-time data collection, user-friendly interfaces, and automated reporting tools to ensure that all relevant parties stay informed and responsive.
    </p>
  </div>
</section>
  </div>
</body>
</html>