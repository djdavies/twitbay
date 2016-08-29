<?php
class Post {

    public function getAllPosts() {
        require('database.php');
        //TODO: add user images.
        if ($result = $mysqli->query('SELECT posts.content, users.name, posts.date FROM posts INNER JOIN users ON posts.user_id=users.id;')) {
            while ($rows = $result->fetch_assoc()) {
?>
                <a class="tweet-screen-name user-profile-link">
                    <?php echo $rows['name']; ?>
                </a>
                <p class="tweet-text js-tweet-text">
                    <?php echo $rows['content']; ?>
                </p>
                <p class="tweet-timestamp">
                    <?php echo $rows['date']; ?>
                </p>
<?php   
            }
        }
    }
}
