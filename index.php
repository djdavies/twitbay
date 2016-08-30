<?php
session_start();
require_once('database.php');
require_once('User.php');
require_once('Post.php');
require_once('UserStat.php');
require_once('Purchase.php');
?>

<!DOCTYPE HTML>
<html class=" js">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Twitbay</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <link href="http://twitter.com/phoenix/iefavicon.ico" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="twitbay_files/phoenix_core_logged_out.css" type="text/css" media="screen">
        <style charset="utf-8" class="lazyload">
            @import "twitbay_files/phoenix_more.bundle.css";
            @import "twitbay_files/styles.css"
        </style>

        <?php
            $bgroundRand = rand(1, 5);
        ?>

        <style class="user-style-Hicksdesign-bg-img">
            body.user-style-Hicksdesign {
                background-image: url(twitbay_files/background<?php echo $bgroundRand ?>.jpg);
            }
        </style>
    </head>

    <body class="logged-out  mozilla user-style-Hicksdesign" id="bg-size">
        <div class="route-profile" id="doc">
            <div id="top-stuff">
                <div id="top-bar-outer">
                    <div id="top-bar-bg"></div>
                    <div id="top-bar">
                        <div style="left: 0px;" class="top-bar-inside">
                            <div class="static-links">
                                <div id="logo">
                                    <a id="gotham-logo" href="http://localhost/">
                                        <img src="twitbay_files/logo.png" alt="nope"/>
                                    </a>
                                </div> <!-- /logo -->			
                            </div> <!-- static-links -->
                            
                            <div class="active-links">
                                <div id="session">
                                    <?php 
                                        // Match found in db
                                        if (isset($_SESSION['loggedin']) == false) {
                                    ?>
                                            <!-- if not logged in, display login form -->
                                            <form action='login.php' method='post'>
                                                Email: <input type="text" name="username" /> 
                                                Password: <input type="text" name="password" />
                                                <input type="submit" value="Sign in" />
                                            </form>
                                             <!-- end of login -->
                                    <?php
                        			    // If the user IS logged in then display a welcome message.
                                        } else {
                                    ?> 
                                            <p>Welcome to Twitbay, <?php echo $_SESSION['username']; ?></p>
                                            <form action='logout.php' method='post'>
                                                <input type="submit" value="Log out" />
                                            </form>
                                            <?php 
                                                }; 
                                            ?>
                                </div> <!-- /session -->
                            </div> <!-- /active-links -->
                        </div> <!-- top-bar-inside -->
                    </div> <!-- top-bar -->
                </div> <!-- top-bar-outer -->
            </div> <!-- top-stuff -->
        </div> <!-- route-profile -->
        <div id="page-outer">
            <div class="profile-container" id="page-container">
                <div style="min-height: 683px;" class="main-content"> 
                    <div class="profile-header">
                        <div class="profile-info clearfix">
                            <div class="profile-image-container">
                                <img src="twitbay_files/megaphone.png" alt="Twitbay">
                            </div>
                            <div class="profile-details">
                                <div class="full-name">
                                    <h2>Gothambay Listings</h2>
                                </div>
                                <div class="screen-name-and-location">
                                    <span class="screen-name screen-name-Hicksdesign pill">@Gothambay</span>
                                        Gotham, DC Universe
                                </div>
                                <div class="bio">
                                    Gotham City or Gotham is a fictional city appearing in American comic books published by DC Comics, best known as the home of Batman. Batman's place of residence was first identified as Gotham City in Batman #4.
                                </div>
                                <div class="url">
                                    <a target="_blank" rel="me nofollow" href="https://en.wikipedia.org/wiki/Gotham_City">https://en.wikipedia.org/wiki/Gotham_City</a>
                                </div>
                            </div> <!-- /profile-details -->
                        </div> <!-- profile-info clearfix -->
                        <ul class="stream-tabs">
                            <li class="stream-tab stream-tab-tweets active">
                                <a class="tab-text">All Posts</a>
                            </li>
                            <li class="stream-tab stream-tab-tweets active">
                                <a class="tab-text">My Posts</a>
                            </li>
                        </ul>
                    </div> <!-- /profile-header -->
                    <div class="stream-manager">
                        <div class="js-stream-manager" id="profile-stream-manager">
                            <div class="stream-container">
                                
                                <div class="stream stream-user">
                                    <div id="stream-items-id" class="stream-items">
                                        <?php
                                            $posts = new Post;     
                                            $posts->getAllPosts();
                                        ?>
                                    </div> <!-- /stream-item -->
                                </div> <!-- stream-user -->
                            </div> <!-- /stream-container -->
                        </div> <!-- /profile-stream-manager -->
                    </div> <!-- /stream-manager -->
                </div> <!-- /main-content -->

                <div class="dashboard profile-dashboard">
                    <div class="component">
                        <div class="signup-call-out">
                            <h1>
                                <span>Twitbay Users</span>
                            </h1>
                            <h2>Don't miss products from your favourite users!</h2>
                            <!-- All users in DB -->
                            <?php
                                $userNames = new User;
                                $userNames->getUserNames();
                            ?>
                            <!-- End of user list -->
                            <hr />
                            <div class="profile-subpage-call-out">
                                <!-- If logged in, display text box where user can post -->
                                <?php 
                                    if (isset($_SESSION['loggedin'])) {
                                        $sellingUsername = $_SESSION['username'];
                                ?> 
                                        <form action="selling.php" name="sellingForm" method="post">
                                            What're ya sellin'?:<br>
                                            <textarea name="content" cols="40" rows="4"></textarea><br>
                                            What're ya askin' for it?:<br>
                                            <input type="number" step="0.01" name="price"><br> 
                                            <input type="hidden" name="username" value="<?php echo $sellingUsername; ?>">
                                            <input type="submit" value="Submit">
                                        </form>    
                                        <!-- End of posting form -->

                                    <!-- If not logged in, display a sign up form -->
                                    <?php
                                        } else {
                                    ?>  
                                            You aren't logged in. Sign up?
                                            <form action="register.php" name="register" method="post">    
                                                Username: <input type="text" name="username" /> <br>
                                                Email: <input type="text" name="email" /> <br>
                                                Password: <input type="text" name="password" /> <br>
                                                <input type="submit" value="Submit">
                                            </form>
                                        <?php
                                        }
                                    ?>  
                                    <!-- End of signup form -->
                                    <hr />
                            </div> <!-- /profile-subpage-call-out -->
                        </div> <!-- /signup-callout -->
                        <hr class="component-spacer">
                    </div> <!-- /component -->
                    
                   <!-- TODO - If logged in, display a summary of cart stats, together with a link to enable folks to checkout -->
                    <div class="component">
                        <div class="signup-call-out">
                            <h1>Cart Items</h1>
                            <p>
                                <?php 
                                    $inCart = new Purchase;
                                    $inCart->getPurchase($sellingUsername);    
                                ?>
                            </p>
                        </div> <!-- /signup-call-out -->
                    </div> <!-- /component -->
                    <!-- end of cart details -->

                    <div class="component">
                        <div class="dashboard-profile-annotations clearfix">
                            <h2 class="dashboard-profile-title">
                                <img src="twitbay_files/megaphone.png" alt="Acme Rocket Bikes" class="profile-dashboard" width="24">
                                    Twitbay Stats
                            </h2>
                        </div> <!-- /dashboard-profile-annotations clearfix -->
                        <!-- site stats pulled from database -->
                        <ul class="user-stats clearfix">
                            <li>
                                <?php 
                                    $user = new UserStat;
                                ?>
                                <a class="user-stats-count">
                                    <?php $user->countUsers(); ?>
                                        <span class="user-stats-stat">Users</span>
                                </a>
                            </li>
                            <li>
                                <a class="user-stats-count">
                                    <?php $user->countPosts(); ?>
                                    <span class="user-stats-stat">Posts</span>
                                </a>
                            </li>
                            <li>
                                <a class="user-stats-count">£100,000<span class="user-stats-stat">Sales</span></a>
                            </li>
                        </ul>
                        <!-- end of stats -->
                        <hr class="component-spacer">
                    </div> <!-- component -->
                </div> <!-- /profile-dashboard -->
            </div> <!-- /profile-container -->
        </div> <!-- /page-outer -->        
        <!-- IE conditional comment -->
        <!--[if lte IE 6]>
        	<script>using('bundle/ie6').load();</script>
        <![endif]-->
    </body>
</html>