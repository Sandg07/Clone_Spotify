<?php
// start the session before any HTML tag:
// session_start();
//already in top nav bar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Login page</title>
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
    <hr>

    <!-- main -->
    <h2>Login page</h2>
    <p>Login to listen music on your account page</p>

    <form action="" method="post">
        <input type="email" name="email" placeholder="Email address"><br>
        <input type="password" name="password" placeholder="Enter password"><br>

        <input type="submit" name="submitBtn" value="Log-in">
    </form>

    <?php
    if (isset($_POST['submitBtn'])) {

        // Check if email OR password not empty
        $errors = array();

        // Check if email is empty
        if (empty($_POST['email']))
            $errors['email'] = 'Email is mandatory';

        if (empty($_POST['password']))
            $errors['password'] = 'Password is mandatory';

        // Check if users exists only if form OK
        if (count($errors) == 0) {

            $conn = mysqli_connect('localhost', 'root', '', 'spotify');

            // Easier for query
            $mail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

            $query = "SELECT *
            FROM users
            WHERE email = '$mail'";


            $results = mysqli_query($conn, $query);

            // Check if user exists in DB
            if (mysqli_num_rows($results) == 0)
                echo 'No user registered with this email address.';
            else {
                // Retrieve data about user
                $user = mysqli_fetch_assoc($results);




                if (password_verify($_POST['password'], $user['password'])) {  // password_verify used to dehash the password. for now all passwordsin the DB are not hashed.
                    // Remember log in : Save email in SESSION 
                    echo 'Successfully log-in !';
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['user_id'] = $user['user_id'];
                    header('Location: account.php');
                } else
                    echo 'Wrong password. Try again.';
            }
        } else {
            // Display errors
            foreach ($errors as $errorMsg) {
                echo '<span style="color:red">' . $errorMsg . '<span><br>';
            }
        }
    }
    ?>


    <br>
    <br>
    <!-- redirection for Log in / register page -->
    <div style="margin-top: 10px">
        New to ChickenWings_Beat?
        <a href="./register.php"> <strong>Create an account</strong> </a>
    </div>
</body>

</html>