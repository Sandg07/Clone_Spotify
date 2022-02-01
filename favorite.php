<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Favorite songs page</title>
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
    <h2>Your favorites songs</h2>
    <h3>List of all songs you liked in our ChickenWings_Beat website</h3>

    <?php

    // <!-- display all favorites -->

    if (isset($_SESSION['favoritesongs'])) {

        foreach ($_SESSION['favoritesongs'] as $i => $songvalue) {
            echo 'Song ID : ' . $_SESSION['favoritesongs'][$i] .  '<br>';
        }
    }
