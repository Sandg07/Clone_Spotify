<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Register page</title>
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
    <h2>Register page</h2>
    <p>Welcome New User</p>
    <form method="POST" action="">
        <input type="text" name="firstname" placeholder="firstname">

        <br></br>
        <input type="text" name="lastname" placeholder="lastname">

        <br></br>
        <input type="email" name="email" placeholder="Email adress">

        <br></br>
        <input type="password" name="password" placeholder="Password">

        <br></br>
        <input type="password" name="cpassword" placeholder="Confirm password">

        <br></br>
        <button type=" submit" name="registerBtn" value="Register">Register</button>
    </form>

    <br>
    <br>

    <!-- redirection for Log in / register page -->
    <div style="margin-top: 10px">
        Already have an account?
        <a href="./login.php"> <strong>Log in</strong> </a>
    </div>
    <?php




    // Register only when form is submitted
    if (isset($_POST['registerBtn'])) {
        // by default, no errors
        $errors = array();

        // username, mail and password must not be empty !
        if (empty($_POST['firstname']))
            $errors['firstname'] = 'Firstname is mandatory<br>';

        if (empty($_POST['lastname']))
            $errors['lastname'] = 'Lastname is mandatory<br>';

        if (empty($_POST['email']))
            $errors['email'] = 'Email is mandatory<br>';

        if (empty($_POST['password']) || empty($_POST['cpassword']))
            $errors['password'] = 'Password is mandatory<br>';
        else if ($_POST['password'] != $_POST['cpassword'])
            $errors['password'] = 'Passwords don\'t match<br>';

        if (empty($errors)) {
            $conn = mysqli_connect('localhost', 'root', '', 'spotify');

            $firstname = '';
            $lastname = '';
            $email = '';
            $password = '';
            $confirmPassword = '';

            // Easier for the query
            $mail = $_POST['email'];

            $query = "SELECT *
                    FROM users
                    WHERE email = '$mail";


            // 2. Execute the query
            $result = mysqli_query($conn, $query);

            // INSERT/UPDATE/DELETE returns true OR false
            if ($result) {
                echo 'Email already exists, please log-in';
                header('Location: login.php');
            } else {

                $sanitizedMail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                // mail must be a valid one
                if (!filter_var($sanitizedMail, FILTER_VALIDATE_EMAIL))
                    $errors['email'] = 'Email is not valid<br>';

                // password must be hashed
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);


                // Create variables for the query (easier to use)
                $firstName = $_POST['firstname'];
                $lastName = $_POST['lastname'];

                // 1. Connect to my DB
                $conn = mysqli_connect('localhost', 'root', '', 'spotify');
                $query = "INSERT INTO users(first_name, last_name, email, password)
                   VALUES('$firstName', '$lastName', '$sanitizedMail', '$hashedPassword')";

                echo $query;
                // 2. Execute the query
                $result = mysqli_query($conn, $query);

                // INSERT/UPDATE/DELETE returns true OR false
                if ($result) {
                    echo 'Successfully inserted in the DB';
                    header('Location: login.php');
                } else
                    echo 'Problem inserting in the DB';
            }
        } else {
            foreach ($errors as $errorMsg) {
                echo $errorMsg . '<br>';
            }
        }
    }
    ?>
</body>

</html>