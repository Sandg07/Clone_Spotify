<?php

// retrieve id song and id playlist
$idSong = $_GET['idSong'];
$idPlaylist = $_GET['idPlaylist'];


// 1. Connect to my DB
$conn = mysqli_connect('localhost', 'root', '', 'spotify');

// 2. Prepare the query
$query = "INSERT INTO playlist_content (playlist_id, song_id) 
VALUES ($idSong, $idPlaylist)";
// echo $query;


// 3. Executing the query (send the query to the DB)
$results = mysqli_query($conn, $query);

// // 4. Fetch the results in a associative array
// $playlistContent = mysqli_fetch_assoc($results);


// INSERT/UPDATE/DELETE returns true OR false
if ($results)
    echo '<span style="color:green"> Successfully inserted in the playlist </span>';
else
    echo '<span style="color:red">Problem inserting in the DB</span>';


// var_dump($playlistContent) . '<br>';
// echo $results;
// Close the connection (you can close anywhere in the file)
mysqli_close($conn);

//Display all artists
