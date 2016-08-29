<?php
class Image {

    public function getUserImage() {
        require('database.php');
        //TODO: add user images.
        if ($result = $mysqli->query('SELECT users.image FROM posts INNER JOIN users ON posts.user_id=users.id;')) {
            while ($rows = $result->fetch_assoc()) {
            	?>
	                <img src="images/<?php echo $rows['image'];?>" alt="Post pic" class="user-profile-link" height="48" width="48">  
	            <?php
            }
        }
    }
}