<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #ece9ff, #ffffff);
        }
        header {
            background-image: url('../image/home.png');
            background-size: cover;
            background-position: center;
            color: white;
            height: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .btn-right  { /*kedudukan luar button*/
            position: absolute;
            top: 20px;
            right: 20px;
        }
         .btn-right button{ /*kedudukan dalaman button*/
            margin-left: 10px;
            padding: 8px 16px;
            background-color: #7B61FF;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-right button:hover { /*bilacursor atas button*/
            background-color: #d50909;
        }

        header .overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); /*lut hitam*/
            width: 100%;
            height: 600px;
        }
        header .contentfirst {
            position: relative;
            z-index: 2;
        }
        .subtext {
  font-size: 1.2em;
  color: #f0f0f0;
  margin-top: 10px;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}
         header h1 {
            font-size: 2em;
        }
         header h1 span {
             color: #7B61FF;
        } 

       section.about {
  position: relative;
  background: url('../image/gym2.jpg') center/cover no-repeat;
  color: white;
  padding: 160px 20px;
  overflow: hidden;
  text-align: center;
}

section.about .overlay {
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0, 0, 0, 0.6); /* lebih gelap = lebih kontras */
  z-index: 1;
  width: 100%;
  height: 100%;
}

.about-content {
  position: relative;
  z-index: 2;
  max-width: 800px;
  margin: 0 auto;
  padding: 40px;
  background: rgba(255, 255, 255, 0.1); /* kotak lut di tengah */
  border-radius: 10px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
  backdrop-filter: blur(5px); /* efek blur glass */
}

.about-content h4 {
  font-size: 36px;
  margin-bottom: 20px;
  color: #7B61FF; /* kuning lembut */
  text-transform: uppercase;
  letter-spacing: 1px;
}

.about-content p {
  font-size: 18px;
  line-height: 1.8;
  color: #f0f0f0;
}

    .cara {
  position: relative;
  background: url('../image/about.jpg') center/cover no-repeat;
  padding: 150px 20px;
  text-align: center;
  color: white;
  overflow: hidden;
}

.cara::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0, 0, 0, 0.6); /* overlay gelap lut */
  z-index: 1;
}

.cara h2 {
  position: relative;
  z-index: 2;
  font-size: 2.5em;
  margin-bottom: 40px;
  color: #7B61FF; /* supaya tajuk lebih menyerlah */
}

.cara-container {
  position: relative;
  z-index: 2;
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.carapart {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(4px);
  color: white;
  padding: 25px;
  width: 250px;
  border-radius: 10px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease;
}

.carapart:hover {
  transform: translateY(-5px);
}



     .info-section {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 30px;
  padding: 60px 40px;
  background: linear-gradient(to right, #f1f4ff, #ffffff); /* Latar lembut */
  border-top: 4px solid #7B61FF; /* Garis atas sebagai pemisah */
}

.map-container {
  flex: 1;
  min-width: 300px;
  height: 400px;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

.biz-info {
  flex: 1;
  min-width: 300px;
  padding: 30px;
  background-color: #ffffff;
  border-left: 6px solid #654bd1;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
  border-radius: 12px;
}

.biz-info h2 {
  color: #654bd1;
  margin-bottom: 15px;
  font-size: 28px;
}

.biz-info p {
  margin: 6px 0;
  font-size: 16px;
  color: #333;
  line-height: 1.6;
}

    </style>
</head>
<body>
    

    <header>
        <div class="overlay"></div>
        <div class="btn-right">
            <button onclick="location.href='../dakzulLatest/index.php'">Sign in</button>
            <button onclick="location.href='../dakzulLatest/register.html'">Register</button>
        </div>
        <div class="contentfirst">
            <h1>See Something? Say Something. <span>SetiaC</span> Makes Reporting Easy. </h1>
            <p class="subtext">Your voice matters. Together we build a safer, smarter community.</p>
        </div>
    </header>

    <section class="about">
        <div class="overlay"></div>
        <div class="about-content">
        <h4>About Us</h4>
        <p>SetiaC is an advanced platform designed for efficient reporting and tracking of various issues.
           It aims to streamline communication between residents and authorities, making it easier to identify problems,
           monitor progress, and resolve issues promptly. SetiaC leverages real-time data collection, user-friendly interfaces,
           and automated reporting tools to ensure that all relevant parties stay informed and responsive.
        </p>
        </div>
       
    </section>

    <section class="cara">

        <h2>Start in 3 Easy Steps</h2>
        <div class="cara-container">
            <div class="carapart">
                <h3>1. Sign Up / Sign In</h3>
                <p>Create your account or log in to your existing one.</p>
            </div>

            <div class="carapart">
                <h3>2. Report Your Issues</h3>
                <p>Describe your issue, attach media, and submit your report.</p>
            </div>

            <div class="carapart">
                <h3>3. Submit Your Report</h3>
                <p>Your issue is now live and being update for resolution.</p>
            </div>
        </div>

    </section>
    <section class="info-section">
  <div class="map-container">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3605.8222631551!2d101.7125552744704!3d2.9409716543981266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdc9889256815f%3A0x37247a314890ea23!2sSetia%20Seraya%20Residences!5e1!3m2!1sen!2smy!4v1750501363904!5m2!1sen!2smy" 
    width="100%" 
    height="100%" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>


  <div class="biz-info">
  <h2>Setia Putrajaya Galleria</h2>
  <p><strong>Operating Hours:</strong></p>
  <p>Monday – Friday: 9.00 am – 6.00 pm</p>
  <p>Saturday, Sunday & Public Holidays: 10.00 am – 6.00 pm</p>

  <br>

  <p><strong>Address:</strong></p>
  <p>Setia Putrajaya Galleria</p>
  <p>No. 5, Jalan P15H,</p>
  <p>Presint 15,</p>
  <p>62050 Putrajaya,</p>
  <p>Wilayah Persekutuan Putrajaya, Malaysia.</p>

  <br>

  <p><strong>Contact Number (Sales & Marketing):</strong></p>
  <p>+603 8861 6500</p>

  <br>

  <p><strong>Email:</strong></p>
  <p><a href="mailto:spj-sales@spsetia.com" style="color: #654bd1; text-decoration: underline;">spj-sales@spsetia.com</a></p>
  </div>
</section>
     <?php include("../footer.php"); ?>
</body>
</html>