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
            background:rgb(169, 165, 165);
        }
        header {
            background-image: url('../image/home.png');
            background-size: cover;
            background-position: center;
            color: white;
            height: 730px;
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
            height: 730px;
        }
        header .contentfirst {
            position: relative;
            z-index: 2;
        }
         header h1 {
            font-size: 2em;
        }
         header h1 span {
             color: #7B61FF;
        } 

        section.about {
             position: relative;
             background: url('../image/home.png') center/cover no-repeat; /* Gambar background jika ada */
             color: white; /* teks lebih jelas atas overlay gelap */
             padding: 160px 20px;
             overflow: hidden;
        }
        section.about .overlay {
             position: absolute;
             top: 0; left: 0; right: 0; bottom: 0;
             background: rgba(0, 0, 0, 0.5); /* warna gelap lut */
             z-index: 1;
            width: 100%;
            height: 730px;
        }
        .about-content {
             position: relative;
             z-index: 2; /* supaya atas overlay */
             text-align: center;
             max-width: 700px;
            margin: 0 auto;
        }

        .cara { /*section luar*/
        padding: 150px 100px;
        text-align: center;
        /*background-image: url('image/home.png');*/
        }
        .cara h2{
        font-size: 2em;
        margin-bottom: 40px;
        color:#f0f0f0;
        }
        .cara-container{  /*container setiap satu cara itu*/
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        }
        .carapart{
        background: #7B61FF;
        padding: 20px;
        width: 250px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(101, 8, 8, 0.1);
        color:#f0f0f0;
        }      
    </style>
</head>


<body>
    

    <header>
        <div class="overlay"></div>
        <div class="btn-right">
            <button onclick="location.href='index.php'">Sign in</button>
            <button onclick="location.href='register.html'">Register</button>
        </div>
        <div class="contentfirst">
            <h1>See Something? Say Something. <span>SetiaC</span> Makes Reporting Easy. </h1>
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

     <?php include("../footer.php"); ?>
</body>
</html>