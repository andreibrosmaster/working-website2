<?php
include('db_connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nicene U Login</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>


    <div class="hero">
    <video autoplay loop muted>
      <source src="form-asset\course-video.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" id="loginBtn">Log In</button>
                <button type="button" class="toggle-btn" id="registerBtn">Register</button>
            </div>
            <div class="social-icons">
            <img src="form-asset/fb.png" alt="">
            <img src="form-asset/tw.png" alt="">
            <img src="form-asset/gp.png" alt="">
        </div>
        <form id="login" class="input-group" name="form-login" action="db_connection.php" method="POST">
            <input type="text" class="input-field" placeholder="Username" name="login_username" required>
            <input type="text" class="input-field" placeholder="Password" name="login_password" required>
            <input type="checkbox" class="checkbox"><span class="span-btn" name="login_remember" >Remember Password</span>
            <button type="submit" class="submit-btn" name="loginBtn">Log In</button>
    </form>
    <form id="register" class="input-group" name="form-register" action="db_connection.php" method="POST">
            <input type="text" class="input-field" placeholder="Username" name="register_username" required>

            <input type="text" class="input-field" placeholder="First Name" name="register_fname" required>
            <input type="text" class="input-field" placeholder="Last Name" name="register_lname" required>

            <input type="email" class="input-field" placeholder="Email" name="register_email" required>
            <input type="text" class="input-field" placeholder="Password" name="register_password" required>
            <input type="checkbox" class="checkbox" name="register_agree" value="1"><span class="span-btn" >I agree to terms and Conditions</span>
            <button type="submit" class="submit-btn" name="registerBtn">Register</button>
    </form>
        </div>
        
    </div>
    


</body>
</html>