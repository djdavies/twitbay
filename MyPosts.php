<?php
class MyPosts {
    public function getMyPosts($user) {
        require('database.php');
    //    $user = $_SESSION('username');
        var_dump($_SESSION);
    //    if ($result = $mysqli->query("select posts.content from posts left join users on posts.user_id=users.id where email = $user")) {
    //        echo 'yes!';
    //    }
    //        var_dump($user);
    }

}
    $posts = new MyPosts;
    echo $posts->getMyPosts($_SESSION['username']);
