<?php
	class Purchase {
		public function setPurchase($username, $buyingId) {
			require('database.php');
	        if ($result = $mysqli->query("SELECT id FROM users WHERE email = '$username'")) {
            		while ($row = $result->fetch_assoc()) {
            			$userId = $row['id'];
            		}
				
				// 1 marks it as 'in cart' (2 will be used to show 'sold')
				$mysqli->query("INSERT INTO posts_users (post_id, user_id, sold) VALUES ('$buyingId', '$userId', 1)");
			}
			header('Location: index.php');
		}

		// i.e. show cart contents
		public function getPurchase($username) {
			require('database.php');

			if (isset($username)) {
				if ($result = $mysqli->query("SELECT id FROM users WHERE email = '$username'")) {
					while ($row = $result->fetch_assoc()) {
						$userId = $row['id'];
					}

					// User has item in cart (sold: 0 = no items, 1 = items in cart, TODO: 2 = items bought)
					if ($result = $mysqli->query("SELECT post_id, user_id FROM posts_users WHERE user_id = '$userId' AND sold =1")) {
							$items = [];
							while ($row = $result->fetch_assoc()) {
								$items[] = $row['post_id'];
							}

							// You can buy multiple items...
							foreach ($items as $key) {
								if ($result = $mysqli->query("SELECT content, price FROM posts WHERE id = '$key'")) {
									while ($row = $result->fetch_assoc()) {	
									?>
										<?php 
											echo '* ' . $row['content'] . '<br>';?>
									<?php 	
									}
								}		
							}
					}
				}

			}
		}

		public function getSalesCost() {
			require('database.php');
			if ($result = $mysqli->query("SELECT SUM(price) FROM posts;")) {
				while ($row = $result->fetch_assoc()) {
					echo '$' .$row['SUM(price)'];
				}
			} else {
				echo 'No sales!';
			}
		}
	}
?>