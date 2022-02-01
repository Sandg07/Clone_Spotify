<?php

// Log out must be first (otherwise, you will still display user's information)
if (isset($_POST['logoutBtn']))
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Account page</title>
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
    <h2>Account page</h2>
    <h3>Your Information</h3>
    <?php

    /*
    Check if the user logged in before
    For this, check if(session['email']) exists
*/
    if (isset($_SESSION['email'])) {
        // Ask for user's information
        $conn = mysqli_connect('localhost', 'root', '', 'spotify');
        $query = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "'";

        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        echo 'Hello' . ' ' . $user['first_name'] . ' ' . 'email : ' . $user['email'];

        //echo "<img width='100px' src='" . $user['poster'] . "'>";
    } else {
        // redirect 
        header('Location: login.php');
    }

    ?>
    <?php foreach ($result as $user) : ?>
        <table border="1" width="50%">
            <tr>
                <th>Firstname:</th>
                <td><?= $user['first_name']; ?></td>
            </tr>
            <tr>
                <th>Lastname:</th>
                <td><?= $user['last_name']; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $user['email']; ?></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><?php echo $user['password']; ?></td>
            </tr>
        </table>
    <?php endforeach; ?>

    <!-- Uplload poster for user profile -->

    <div class="links">
        <h4><strong> Access now to your playlist, songs and favorites:</strong></h4>
        <a href="playlists.php">Playlists</a> -
        <a href="songs.php">Songs</a>

    </div>



    <!-- <form action="" method="POST">
            <br>
            <input type="button" name="playlistBtn" value="Playlists">
        </form>
    <?php
    // playlist button to redirect to the playlist page
    if (isset($_POST['playlistBtn']))
        header('Location: playlists.php');
    ?> -->

    <br>
    <form action="" method="POST">
        <input type="submit" name="logoutBtn" value="Log out">
    </form>
    </br>




</body>

</html>