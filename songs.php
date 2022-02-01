<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./CSS/style.css">
    <title>Songs page</title>
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


    <?php

    // Connect to my DB
    $conn = mysqli_connect('localhost', 'root', '', 'spotify');

    //1 QUERY DROPDOWN LIST

    if (isset($_SESSION['email'])) {

        $user_id = $_SESSION['user_id'];

        $query_all_playlist = "SELECT * 
    FROM playlists
    WHERE user_id = $user_id";
        // echo $query_all_playlist;

        $playlist_results = mysqli_query($conn, $query_all_playlist);
        $dropdown_list = mysqli_fetch_all($playlist_results, MYSQLI_ASSOC);

        $mydropdownlistValues = '';
        foreach ($dropdown_list as $playlist) {
            // echo $playlist['title'] . '<hr>';
            $mydropdownlistValues =  $mydropdownlistValues . '<option value="' . $playlist['playlist_id'] . '"> ' . $playlist['title'] . '</option>';
            // echo $mydropdownlistValues;
            //     // echo $key . '<br>';
            //     echo '<pre>';
            //     var_dump($dropdown_list);
            //     echo '</pre>';
            //     // echo '<pre>';
            //     // var_dump($dropdown_list[0]['title']);
            //     // echo '</pre>';

        }
    }

    // 2 QUERY ALL SONGS
    $query = 'SELECT songs.song_id, songs.title, songs.release_date, artists.name, categories.categ_name
FROM artists
INNER JOIN songs
ON artists.artist_id = songs.artist_id
INNER JOIN categories
ON songs.categ_id = categories.categ_id 
ORDER BY artists.name, songs.song_id ';
    // echo $query;
    // 3. Executing the query (send the query to the DB)
    $results = mysqli_query($conn, $query);

    // 4. Fetch the results in a associative array
    $songs = mysqli_fetch_all($results, MYSQLI_ASSOC);


    // Close the connection (you can close anywhere in the file)
    mysqli_close($conn);

    ?>
    <!-- main -->
    <h2>My Songs</h2>
    <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synth stumptown gastropub cornhole celiac swag. Brunch raclette vexillologist post-ironic glossier ennui XOXO mlkshk godard pour-over blog tumblr humblebrag. Blue bottle put a bird on it twee prism biodiesel brooklyn. Blue bottle ennui tbh succulents.</p>

    <!-- Message correctly inserted in favorite page -->
    <div id="add_favorites"> </div>
    <h3>List of all songs you liked in our ChickenWings_Beat website</h3>

    <?php
    // <!-- display all favorites -->
    if (isset($_SESSION['favoritesongs'])) {

        foreach ($_SESSION['favoritesongs'] as $i => $songvalue) {
            if ($_SESSION['favoritesongs'][$i])
                $_SESSION['favoritesongs'][$i] = $_SESSION['favoritesongs'][$i];
            echo 'Song ID : ' . $_SESSION['favoritesongs'][$i] .  '<br>';
        } //to remove double favorites if(favorite exist, display once)
    }
    ?>

    <!-- Songs container  -->
    <div id="results"></div>
    <div class="container">


        <table border="1" cellpadding="10px">
            <thead>
                <th>Title </th>
                <th>Artist </th>
                <th>Date of release </th>
                <!-- <th> Photo </th> -->
                <th>Categories</th>
                <?php if (isset($_SESSION['email'])) : ?>
                    <th>Add song to playlist</th>
                    <th>Add to favorites</th>
                <?php endif; ?>
            </thead>
            <tbody>
                <?php foreach ($songs as $song) : ?>
                    <tr>
                        <td> <?= strtoupper($song['title']); ?> </td>
                        <td><?= $song['name']; ?></td>
                        <td> <?= $song['release_date']; ?> </td>

                        <!-- <td> <img src="' . <?= $song['photo']; ?> . '" width="100px"> </td> -->
                        <td><?= $song['categ_name']; ?> </td>

                        <?php if (isset($_SESSION['email'])) : ?>
                            <td>
                                <select id="dropdownSong<?= $song['song_id']; ?>">
                                    <option value="">--Please choose an option--</option>
                                    <?= $mydropdownlistValues; ?>
                                </select>
                                <button name="addBtn" id="addBtn" value="<?= $song['song_id']; ?>">ADD</button>
                            </td>
                            <td><i style="color:red" class="far fa-grin-hearts liked_icon" name="<?= $song['title']; ?>" id="<?= ($song['song_id']); ?>"></i></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Message correctly inserted in playlist -->
        <div id="results"> </div>


        <!-- JQUERY FOR AJAX CALL -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


        <!-- AJAX call on button to insert in Playlist table -->
        <script>
            /* Wait for the page to be loaded/ready */
            $('button').click(function(e) {

                // 'Stop' the form
                e.preventDefault();
                console.log(this.value);
                // console.log($('#dropdownSong1'));
                console.log($('#dropdownSong' + this.value)[0].value);
                // Ajax call
                $.ajax({
                        url: "insertSong_in_userPlaylist.php",
                        method: "get",
                        data: {
                            idSong: this.value,
                            idPlaylist: $('#dropdownSong' + this.value)[0].value
                        }
                    })
                    .done(function(result) {
                        // If AJAX call worked
                        $("#results").html(result);
                        // alert('insert in playlist content');
                    })
                    .fail(function(result) {
                        console.log("AJAX FAILED");
                    });
            });
        </script>

        <!-- AJAX call on LIKE icon to add in Favorite page -->
        <script>
            /* Wait for the page to be loaded/ready */
            $('.fa-grin-hearts').click(function(e) {
                // 'Stop' the form
                e.preventDefault();

                let id = $(this).attr('id');
                let title = $(this).attr('name');
                // .toggle('.liked_icon');
                console.log(id);
                // Ajax call
                $.ajax({
                        url: "add_favorite.php",
                        method: "get",
                        data: {
                            id: id,
                            title: title
                        }
                    })
                    .done(function(result) {
                        // If AJAX call worked
                        // $("#add_favorites").html(result);
                        // alert('insert in playlist content');
                    })
                    .fail(function(result) {
                        console.log("AJAX FAILED");
                    });
            });
        </script>

</body>

</html>