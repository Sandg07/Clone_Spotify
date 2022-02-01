<?php

$artists = array();
$id = $_GET['id'];
// echo $id;

// 1. Connect to my DB
$conn = mysqli_connect('localhost', 'root', '', 'spotify');

// 2. Prepare the query
$query = 'SELECT artists.*, COUNT(songs.title) as number
FROM artists
JOIN songs ON artists.artist_id = songs.artist_id
WHERE artists.artist_id = ' . $id;
//' GROUP BY artists.artist_id'
// echo $query;

// 3. Executing the query (send the query to the DB)
$results = mysqli_query($conn, $query);

// 4. Fetch the results in a associative array
$artist = mysqli_fetch_all($results, MYSQLI_ASSOC);


// Close the connection (you can close anywhere in the file)
mysqli_close($conn);

//Display all artists

?>
<?php foreach ($artist as $info) : ?>
    <h3>About <?= strtoupper($info['name']); ?></h3>

    <table border="1" cellpadding="10px">
        <thead>
            <th> Name </th>
            <th> Date of birth </th>
            <th> Gender </th>
            <!-- <th> Photo </th> -->
            <th> Bio </th>
            <th>Number of songs written </th>
        </thead>
        <tbody>

            <tr>
                <td> <?= strtoupper($info['name']); ?> </td>
                <td> <?= $info['date_of_birth']; ?> </td>
                <td><?= $info['gender']; ?></td>
                <td width="50%">
                    <?php
                    echo substr($info['bio'], 0, 70);
                    if (strlen($info['bio']) > 70)
                        echo '...';
                    ?>
                </td>
                <!-- <td> <img src="' . <?= $info['photo']; ?> . '" width="100px"> </td> -->
                <td><?= $info['number']; ?> </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>



    <?php
    //Display all songs from the artist

    // 1. Connect to my DB
    $conn = mysqli_connect('localhost', 'root', '', 'spotify');

    // 2. Prepare the query 
    $query = 'SELECT artists.name, songs.title, songs.release_date
FROM artists 
JOIN songs ON artists.artist_id = songs.artist_id 
WHERE artists.artist_id = ' . $id . ' ORDER BY songs.title ';
    // echo $query;

    // 3. Executing the query (send the query to the DB)
    $results = mysqli_query($conn, $query);

    // 4. Fetch the results in a associative array
    $songs = mysqli_fetch_all($results, MYSQLI_ASSOC);

    // Close the connection (you can close anywhere in the file)
    mysqli_close($conn);

    //Display all artists

    ?>
    <br>
    <h3>Songs written: </h3>
    <br>
    <table border="1" cellpadding="10px">
        <thead>
            <th> Song title </th>
            <th> Date of release </th>
        </thead>
        <tbody>
            <?php foreach ($songs as $info) : ?>
                <tr>
                    <td> <?= $info['title']; ?> </td>
                    <td> <?= $info['release_date']; ?> </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>