<?php
class Post {

    public function getAllPosts() {
        require('database.php');
        //TODO: add user images.
        if ($result = $mysqli->query('SELECT posts.id, posts.content, users.name, users.image, posts.date, posts.price FROM posts INNER JOIN users ON posts.user_id=users.id;')) {
            while ($rows = $result->fetch_assoc()) {
?>  
                
                <!-- TODO - start of a posting - note that all postings will need to be created from DB -->
                    <div media="true" class="js-stream-item stream-item" name="<?php echo $rows['id'];?>">
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
                                <p class="tweet-price js-tweet-text">
                                    <em>Price: 
                                    <?php 
                                    if ($rows['price']) {
                                        echo '$' .$rows['price'];    
                                    } else {
                                        echo 'Priceless.';
                                    }
                                    ?></em>
                                </p>
                                <p class="tweet-timestamp">
                                    <?php echo $rows['date']; ?>
                                </p>

                                <form action="buying.php" name="buying" method="post">
                                    <input type='hidden' name="buyingId" value="<?php echo $rows['id'];?>">     
                                    <input type="submit" name="buying" value="Aaaah, I'll buy it at a high price!">
                                </form>
                            </div> <!-- tweet-content -->
                        </div> <!-- /stream-item-content -->
                    </div> <!-- stream-item -->
<?php   
            }
        }
    }

    public function setPost($content, $price, $username) {
        require('database.php');
        // These could probably be combined into a subquery?
        if ($result = $mysqli->query("SELECT id FROM users WHERE email = '$username'")) {
            while ($row = $result->fetch_assoc()) {
                $sale_id = $row['id'];
            }

            $mysqli->query("INSERT INTO posts (content, price, user_id) VALUES ('$content', $price, '$sale_id')");
        }
        
        header('Location: index.php');
    }
}       
