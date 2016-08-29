<?php
    class UserStat {
        // Get count of all users in DB.
        public function countUsers() {
            require('database.php');
                if ($result = $mysqli->query('SELECT Count(Distinct id) as count
                    FROM users')) {
                        while ($row = $result->fetch_assoc()) {
                            echo $row['count'];
                        }
                }
        }

        public function countPosts() {
            require('database.php');
                if ($result = $mysqli->query('SELECT Count(Distinct id) as count
                    FROM posts')) {
                        while ($row = $result->fetch_assoc()) {
                            echo $row['count'];
                        }
                }
        }
    }
