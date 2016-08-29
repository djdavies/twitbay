<?php
	require('Post.php');

	$selling = new Post;
	$selling->setPost($_POST['content'], $_POST['price'], $_POST['username']);
?>