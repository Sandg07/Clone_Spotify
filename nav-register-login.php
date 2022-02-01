<?php
session_start();

// Log out must be first (otherwise, you will still display user's information)
if (isset($_POST['logoutBtn']))
    session_destroy();
?>



<nav>
    <ul>
        <li>
            <a href="login.php">Log In</a>
        </li>
        <li>
            <a href="register.php">Register</a>
        </li>


        <?php if (isset($_SESSION['email'])) : ?>
            <li>
                <a href="account.php">Account page</a>
            </li>
            <li>
                <form action="" method="POST">
                    <input type="submit" name="logoutBtn" value="Log out">
                </form>
            </li>

        <?php endif; ?>

    </ul>
</nav>