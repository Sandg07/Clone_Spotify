<nav>
  <ul>
    <li class="links">
      <a href="./homepage.php">Home</a>
    </li>
    <li class="links">
      <a href="./songs.php">Songs</a>
    </li>
    <li class="links">
      <a href="./artists.php">Artists</a>
    </li>
    <li class="links">
      <a href="./playlists.php">Playlists</a>
    </li>
    <?php if (isset($_SESSION['email'])) : ?>
      <li class="links">
        <a href="./favorite.php">Favorite</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>