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
    <title>Playlists page</title>
</head>

<body>


    <!-- nav bar -->
    <div class="main-nav-bar">
        <?php
        include './nav.php';
        ?>
    </div>
    <hr>

    <!-- main -->
    <h2>Playlists page</h2>
    <?php
    // Greet the User
    if (isset($_SESSION['email'])) {
        // Ask for user's information
        $conn = mysqli_connect('localhost', 'root', '', 'spotify');
        $query = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "'";

        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        echo 'Hello' . ' ' . $user['first_name'] . ' , here are your playlists: ' . '<br>';

        //echo "<img width='100px' src='" . $user['poster'] . "'>";
    } else {
        // redirect 
        header('Location: login.php');
    }

    if (isset($_SESSION['email'])) {
        // Ask for user's information
        $conn = mysqli_connect('localhost', 'root', '', 'spotify');
        //$query = "SELECT * FROM playlists JOIN users ON playlists WHERE user_id LIKE '" . $_SESSION['email'] . "'";

        $query = "SELECT p.* , u.first_name 
        FROM playlists p 
        JOIN users u 
        ON p.user_id = u.user_id 
        WHERE u.email LIKE '" . $_SESSION['email'] . "'";

        $result = mysqli_query($conn, $query);
        $playlists = mysqli_fetch_assoc($result);
    } else {
        // redirect 
        header('Location: login.php');
    }
    ?>


    <table border="1" width="50%">
        <thead>
            <th>Id playlist: </th>
            <th>Title: </th>
            <th>Date of creation :</th>
        </thead>
        <?php foreach ($result as $playlists) : ?>
            <tbody>
                <tr>
                    <td><?= $playlists['playlist_id']; ?></td>
                    <td><?= $playlists['title']; ?></td>
                    <td><?= $playlists['creation_date']; ?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

    <h3>Create new playlist</h3>
    <form method="POST" action="">
        <input type="text" name="title" placeholder="Title">
        <br></br>
        <!-- <input type="date" name="today" value="<?php // echo date("Y-m-d", strtotime($_POST['today'])); 
                                                    ?>"> -->
        <br>
        <button type=" submit" name="submitBtn" value="Submit">Submit</button>
    </form>
    </br>






    <?php

    // Submit playlist only when form is submitted
    if (isset($_POST['submitBtn'])) {
        // by default, no errors
        $errors = array();

        // username, mail and password must not be empty !
        if (empty($_POST['title']))
            $errors['title'] = 'Title is mandatory<br>';

        if (empty($errors)) {

            $title = $_POST['title'];
            //$creation_date = date("Y-m-d");
            $creation_date = date("Y-m-d", strtotime($_POST['now'])); // still need to correct date
            $user_id = $_SESSION['user_id'];

            echo $creation_date;

            // 1. Connect to my DB
            $conn = mysqli_connect('localhost', 'root', '', 'spotify');
            $query = "INSERT INTO playlists (title, creation_date, user_id)
                   VALUES ('$title', $creation_date, $user_id)";

            echo $query;
            // 2. Execute the query
            $result = mysqli_query($conn, $query);

            // INSERT/UPDATE/DELETE returns true OR false
            if ($result) {
                echo 'Successfully inserted in the DB';
            } else
                echo 'Problem inserting in the DB';
        } else {
            foreach ($errors as $errorMsg) {
                echo $errorMsg . '<br>';
            }
        }
    }
    ?>
    </section>

    <section class="logout">
        <?php
        // playlist button to redirect to the playlist page
        if (isset($_POST['logoutBtn']))
            header('Location: login.php');
        ?>
        <br>
        <form action="" method="POST">
            <input type="submit" name="logoutBtn" value="Log out">
        </form>
        </br>
    </section>
    </section>
</body>

</html>