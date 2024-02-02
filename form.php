<!DOCTYPE html>
<html lang="en">
<body>
    <p>twitch username:</p>
        <form action="start_oauth.php" method="post">
        <label for="username">twitch username:</label>
        <input type="text" id="username" name="username" required>
        <input type="submit" value="check followers">
    </form>

    <!-- should display the followers here with bullets -->
    <?php
    if (isset($followerData) && !empty($followerData)) {
        echo "followers for $username:";
        echo "<ul>";
        foreach ($followerData as $follower) {
            echo "<li>$follower</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
