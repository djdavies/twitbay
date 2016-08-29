<?php
class Post {

    public function getAllPosts() {
        require('database.php');
        //TODO: add user images.
        if ($result = $mysqli->query('SELECT posts.content, users.name, users.image, posts.date FROM posts INNER JOIN users ON posts.user_id=users.id;')) {
            while ($rows = $result->fetch_assoc()) {
?>  
                <div id="stream-items-id" class="stream-items">
                <!-- TODO - start of a posting - note that all postings will need to be created from DB -->
                    <div media="true" class="js-stream-item stream-item">
                        <div class="stream-item-content tweet js-actionable-tweet stream-tweet" id="font-size">
                            
                            <div class="tweet-image" id="visible-overflow">
                                <img src="images/<?php echo $rows['image'];?>" alt="Post pic" class="user-profile-link" height="48" width="48"> 
                            </div>
                     
                            <div class="tweet-content">
                                <a class="tweet-screen-name user-profile-link">
                                    <?php echo $rows['name']; ?>
                                </a>
                                <p class="tweet-text js-tweet-text">
                                    <?php echo $rows['content']; ?>
                                </p>
                                <p class="tweet-timestamp">
                                    <?php echo $rows['date']; ?>
                                </p>
                            </div> <!-- tweet-content -->
                        </div> <!-- /stream-item-content -->
                    </div> <!-- stream-item -->
                </div>
<?php   
            }
        }
    }

    public function setPost($content, $price, $username) {
        require('database.php');
        // These could probably be combined into a subquery?
        if ($result = $mysqli->query("SELECT id as sale_id FROM users WHERE email = 'batman@gotham.com'")) {
            while ($row = $result->fetch_assoc()) {
                $sale_id = $row['sale_id'];
            }
        }

        $sale = $mysqli->query("INSERT INTO posts (content, price, user_id) VALUES ('$content', $price, $sale_id)");

        if ($sale === TRUE) {
            echo 'Record created successfully';
        } else {
                echo 'Record nope..';
        }

        echo $content . $price . $sale_id;
    }
}       
