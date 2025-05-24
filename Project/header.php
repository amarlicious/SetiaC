<!-- header.php -->
<style>
    .header {
        background-color: #788BFF; /* Use your preferred blue */
        color: white;
        padding: 10px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-family: Arial, sans-serif;
    }

    .left-header {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .left-header img {
        height: 60px;
    }

    .slogan {
        font-size: 14px;
        color: white;
    }

    .nav {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .nav a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .nav a.active {
        color: #FF5C8A; /* Highlighted active menu item */
    }

    .avatar {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
    }
</style>

<div class="header">
    <div class="left-header">
        <img src="logo.png" alt="Setia Logo"> <!-- Replace with your image -->
        <div class="slogan">
            <div>Stay Together, Stay Setia</div>
            <div style="color: #00FFD1;">live.learn.work.play</div>
        </div>
        <img src="50years.png" alt="50 Years" style="height: 50px;"> <!-- Optional 50 years image -->
    </div>

    <div class="nav">
        <a href="home.php" class="active">Home</a>
        <a href="reports.php">Reports</a>
        <img src="user.jpg" alt="User Avatar" class="avatar">
    </div>
</div>
