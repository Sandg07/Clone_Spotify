<!-- @format -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./CSS/style.css">
  <title>Homepage</title>
</head>

<body>

  <!-- nav bar for registration and login -->
  <div class="top-nav-bar">
    <?php
    require_once './nav-register-login.php';
    ?>

  </div>

  <!-- nav bar -->
  <div class="main-nav-bar">
    <?php
    require_once './nav.php';
    ?>

  </div>

  <!-- hero section -->
  <div class="container">

    <h1>“Music is the soundtrack of your life.” – Dick Clark</h1>
    <h3>
      Simple way to play your own music on any device connected to the web
    </h3>
    <br />
    <div name="login-btn" class="links">
      <a href="./login.php"> Login</a>
    </div>
    <br>
    <br>
    <div name="register-btn" class="sublinks"><a href="./register.php"> Create your account</a>
    </div>
  </div>
  <br>
  <!-- end of nav bar -->



  <!-- pagination -->


  <!-- footer bar  -->
  <hr>

  <div>
    <?php
    require_once 'footer.html';
    ?>
  </div>

</body>

</html>