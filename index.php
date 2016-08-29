<?php
session_start();
require_once('database.php');
require_once('User.php');
require_once('Post.php');
require_once('UserStat.php');
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
 $bgroundRand = rand(1, 4);
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
                  </div>			
              </div> 
              <div class="active-links">
                <div id="session">
                    <?php 
                                // Match found in db
                    if (isset($_SESSION['loggedin']) == false) {
                        ?>
                        <!-- if not logged in, display login form -->
                        <form action='login.php' method='post'>
                         Username: <input type="text" name="username" /> 
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
            </div>
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
                            <h2>Twitbay Listings</h2>
                        </div>
                
                        <div class="screen-name-and-location">
                            <span class="screen-name screen-name-Hicksdesign pill">@Twitbay</span>
                                Cardiff, Wales, UK
                        </div>

                        <div class="bio">
                            Only the finest products, services, bric-a-brac and budget bargains - all served 
                        with a dash of ASP.NET goodness...
                        </div>

                        <div class="url">
                            <a target="_blank" rel="me nofollow" href="http://www.spiderstudios.co.uk/">http://www.gotham.com/</a>
                        </div>
                    </div>
                </div>
        <ul class="stream-tabs">
            <li class="stream-tab stream-tab-tweets active">
                <a class="tab-text">All Posts</a>
            </li>
            <li class="stream-tab stream-tab-tweets active">
                <a class="tab-text">My Posts</a>
            </li>
        </ul>
    </div>
    <div class="stream-manager">
        <div class="js-stream-manager" id="profile-stream-manager">
            <div class="stream-container">
                <div class="stream stream-user">

                    <?php
                        $posts = new Post;     
                        $posts->getAllPosts();
                    ?>

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

        <!-- End of user list                    -->


        <hr />

        <div class="profile-subpage-call-out">

             <!-- TODO - If logged in, display text box where user can post -->
             <?php if (isset($_SESSION['loggedin'])) {
                echo "What're ya sellin'?";
            } else {
                echo "Yo, you're not logged in.";
            }
            ?>  
            <!-- ??? -->
            <!-- End of posting form -->


            <!-- TODO - If not logged in, display a sign up form -->
            <!-- ??? -->
            <!-- End of signup form -->

        <hr />

	       <!-- TODO - If logged in, display a summary of cart stats, together with
                a link to enable folks to checkout -->
            <!-- ??? -->
            <!-- end of cart details -->

        </div>
                          </div>
                          <hr class="component-spacer">
                      </div> <!-- /component -->

                      <div class="component">
                       <div class="dashboard-profile-annotations clearfix">
                          <h2 class="dashboard-profile-title">
                             <img src="twitbay_files/megaphone.png" alt="Acme Rocket Bikes" class="profile-dashboard" width="24">
                             Twitbay Stats
                         </h2>
                     </div>
                     <!-- TODO - display site stats pulled from database -->
                     <ul class="user-stats clearfix">
                      <li>
                        <?php 
                        $user = new UserStat;
                        ?>
                        <a class="user-stats-count">
                            <?php $user->countUsers(); ?>
                            <span class="user-stats-stat">Users</span></a>
                        </li>
                        <li>
                            <a class="user-stats-count">
                                <?php $user->countPosts(); ?>
                                <span class="user-stats-stat">Posts</span></a>
                            </li>
                            <li>
                               <a class="user-stats-count">£100,000<span class="user-stats-stat">Sales</span></a>
                           </li>
                       </ul>
                       <!-- end of stats -->

                       <hr class="component-spacer">
                   </div> <!-- component -->
               </div> <!-- /profile-dashboard -->
               <hr class="component-spacer">
           </div> <!-- route-profile -->

           <!-- IE conditional comment -->
		<!--[if lte IE 6]>
  		<script>using('bundle/ie6').load();</script>
          <![endif]-->
      </body>
      </html>
