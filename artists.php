<?php


// 1. Connect to my DB
$conn = mysqli_connect('localhost', 'root', '', 'spotify');

// 2. Prepare the query
$query = 'SELECT *
FROM artists
ORDER BY artist_id ';

// 3. Executing the query (send the query to the DB)
$results = mysqli_query($conn, $query);

// 4. Fetch the results in a associative array
$artists = mysqli_fetch_all($results, MYSQLI_ASSOC);


// Close the connection (you can close anywhere in the file)
mysqli_close($conn);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="./CSS/style.css">
    <title>Artists page</title>
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
        include './nav.php';
        ?>
    </div>
    <hr>

    <!-- main -->
    <h2>Artists page</h2>
    <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synth stumptown gastropub cornhole celiac swag. Brunch raclette vexillologist post-ironic glossier ennui XOXO mlkshk godard pour-over blog tumblr humblebrag. Blue bottle put a bird on it twee prism biodiesel brooklyn. Blue bottle ennui tbh succulents.</p>


    <div class="row-container">

        <?php foreach ($artists as $artist) : ?>
            <table border="1" cellpadding="10px">
                <thead>
                    <th width="400px" height="70px"><?= strtoupper($artist['name']); ?> </th>
                </thead>
                <tbody>
                    <tr>
                        <!-- <td id="<?= ($artist['artist_id']); ?>" style="display:none;"><?= ($artist['artist_id']); ?></td> -->
                        <td style="text-align: center"><i class="fas fa-info-circle" id="<?= ($artist['artist_id']); ?>"></i></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
            </table>
    </div>

    <!-- AJAX on-click  -->
    <div class="container" id="artists-container"> </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        /* Wait for the page to be loaded/ready */
        $('.fa-info-circle').click(function(e) {

            // 'Stop' the form
            e.preventDefault();
            // Ajax call
            $.ajax({
                    url: "get-artists.php",
                    method: "get",
                    data: {
                        id: this.id,
                    }
                })
                .done(function(result) {
                    // If AJAX call worked
                    $("#artists-container").html(result);
                })
                .fail(function(result) {
                    console.log("AJAX FAILED");
                });
        });
    </script>









</body>

</html>