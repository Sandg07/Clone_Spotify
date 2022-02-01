
    <?php
    session_start();

    // echo 'Your favorites songs are ';

    // Getting the value sent by songs.php using ajax
    $songsID = $_GET['id'];

    // echo $_GET['id'];

    if (isset($_GET['id'])) {

        // ONLY INITIALIZE THIS TO AN EMPTY ARRAY IF IT DOESN'T EXIST AT ALL:
        if (!isset($_SESSION['favoritesongs'])) {
            $_SESSION['favoritesongs'] = [];
        }

        //ADD IN ARRAY
        function multiple_songsID_adder($getSongID)
        {
            array_push($_SESSION['favoritesongs'], $getSongID . $_GET['title']);
            // push($my_array, ['a'=>1,'b'=>2])

            // TESTING
            // echo sizeof($_SESSION['favoritesongs']);
        }
        //IF ELEMENT DO NOT EXIST 
        $position = array_search($songsID, $_SESSION['favoritesongs']);

        if ($position !== false) {
            echo "In position $position liked song is $songsID";

            // remove item at index 1 which is 'for'
            array_splice($_SESSION['favoritesongs'], $position, 1);
            // Print modified array
            // var_dump($_SESSION['favoritesongs']);
        } else {
            echo "New like! Add song $songsID!";
            multiple_songsID_adder($songsID);
        }

        // TESTING
        echo '<pre>';
        echo print_r($_SESSION['favoritesongs'], true);
        echo '</pre>';



        //success message
        echo '<span style="color:green"> successfully registered! </span>';
    } else {
        //error message
        echo '<span style="color:red"> Problem registering </span>';
    }







    ?>