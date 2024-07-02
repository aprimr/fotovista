<?php
include 'connection.php';
include 'extras/calc-time.php';
session_start();
if ($_SESSION['logged_in']) {

    $username = $_GET['username'];
    $image_path = $_SESSION['image_path'];
    //fetch profile data from db
    $fetch = "SELECT * FROM registered_users WHERE `username` = '$username' ";
    $fetch_result = mysqli_query($conn, $fetch);

    while ($row = mysqli_fetch_array($fetch_result)) {

        ?>

        <!DOCTYPE html>
        <lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="shortcut icon" href="img/fotovista.png" type="image/x-icon">
                <link rel="stylesheet"
                    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
                <link rel="stylesheet" href="global.css">
                <title>FotoVista - <?php echo $username ?></title>
            </head>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                    text-decoration: none;
                    font-family: poppins;
                    box-sizing: border-box;
                }

                /* navbar */
                .nav {
                    position: fixed;
                    top: 0;
                    height: 60px;
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 0 50px;
                    background-color: #fff;
                    box-shadow: 2px 2px 10px silver;
                }

                .nav .logo {
                    display: flex;
                    align-items: center;
                    margin-left: 100px;
                }

                .nav .logo img {
                    height: 30px;
                    width: 30px;
                    margin-right: 10px;
                    -webkit-animation: spin 1s linear infinite;
                    -moz-animation: spin 1s linear infinite;
                    animation: spin 1s linear infinite;
                }

                .nav .logo p {
                    font-size: 20px;
                }

                /* profile */
                .nav .profile {
                    height: 48px;
                    background-color: #e7e7e7;
                    border-radius: 5px;
                    padding: 3px 9px;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    line-height: 10px;
                    margin-right: 100px;
                }

                .nav .profile a {
                    display: flex;
                }

                .nav .profile a img {
                    height: 35px;
                    width: 35px;
                    margin-right: 10px;
                    border-radius: 50%;
                }

                .nav .profile a p {
                    line-height: 15px;
                    color: black;
                    margin: 0 10px 0 0;
                    font-size: 14px;
                    margin-top: 2.5px;
                }

                .nav .profile a p .username {
                    font-weight: 500;
                    color: #587DC7;
                }

                .nav .profile .logout-btn {
                    color: black;
                    background-color: #fff;
                    border-radius: 4px;
                    height: 35px;
                    width: 35px;
                }

                .nav .profile .logout-btn :hover {
                    color: #587DC7;
                    transform: scale(1.02);
                }

                .nav .profile .logout-btn a span {
                    font-size: 25px;
                    margin: 5px 0 0 5px;
                    color: #57B0A2;
                }
                .nav .profile .setting {
                        display: none;
                }


                /* profile-section */
                .profile-wrapper {
                    display: flex;
                    justify-content: center;
                    height: 450px;
                    width: 100%;
                    padding: 20px;
                }

                .profile-wrapper .profile-section {
                    text-align: center;
                    width: 500px;
                    margin: auto;
                    margin-bottom: 0;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 1px 1px 20px silver;
                }

                .profile-wrapper .profile-section img {
                    border-radius: 50%;
                    height: 100px;
                    width: 100px;
                    border: 3px solid #587DC7;
                }

                .profile-wrapper .profile-section .fullname {
                    font-family: Inter;
                    font-size: 25px;
                }

                .profile-wrapper .profile-section .username {
                    font-family: Inter;
                    margin: 5px 0 10px 0;
                    color: #587DC7;
                }

                .profile-wrapper .profile-section .btn {
                    margin: 20px 170px;
                    background-color: #587DC7;
                    height: 35px;
                    line-height: 35px;
                    font-size: 15px;
                    color: white;
                    border-radius: 5px;
                    cursor: pointer;
                }

                .profile-wrapper .profile-section .btn:hover {
                    background-color: #7399e6;
                }

                .profile-wrapper .profile-section .counts {
                    font-family: Inter;
                    display: flex;
                    justify-content: space-around;
                    padding: 5px 50px;
                }

                .profile-wrapper .profile-section .counts p {
                    font-size: 13px;
                }

                .profile-wrapper .profile-section .counts .likes num {
                    color: #F59F34;
                }

                .profile-wrapper .profile-section .counts .followers num {
                    color: #D22F3F;
                }

                .profile-wrapper .profile-section .counts .posts num {
                    color: #57B0A2;
                }

                /* posts */
                .post-wrapper {
                    display: flex;
                    justify-content: center;
                    width: 100%;
                    padding: 10px;
                }

                .post-wrapper .post-section {
                    text-align: center;
                    width: 500px;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 1px 1px 20px silver;
                }

                .post-wrapper .post-section .top {
                    display: flex;
                }

                .post-wrapper .post-section .top img {
                    margin-left: 10px;
                    margin-right: 15px;
                    border: 3px solid #587DC7;
                    border-radius: 50%;
                    height: 50px;
                    width: 50px;
                }

                .post-wrapper .post-section .top .text-area {
                    text-align: left;
                    align-content: space-around;
                }

                .post-wrapper .post-section .top .text-area .username {
                    font-family: Inter;
                }

                .post-wrapper .post-section .top .text-area .time {
                    font-size: 12px;
                    font-weight: 400;
                }

                .post-wrapper .post-section .caption {
                    text-align: left;
                    margin: 5px 0 10px 10px;
                }

                .post-wrapper .post-section .photo-area img {
                    width: 100%;
                    border-radius: 8px;
                    height: auto;
                }

                .post-wrapper .post-section .bottom {
                    margin: 5px 10px;
                    display: flex;
                    justify-content: space-between;
                }

                .post-wrapper .post-section .bottom .love-wrapper,
                .post-wrapper .post-section .bottom .comment-wrapper {
                    display: flex;
                    gap: 10px;
                    cursor: pointer;
                }
                
                /* responsive */
                @media (max-width: 600px) {
                    
                    .nav {
                        width: 100%;
                        padding: 0 10px;
                    }

                    .nav .logo {
                        margin-left: 0px;
                    }

                    .nav .profile {
                        margin-left: 20px;
                        margin-right: 0px;
                    }

                    .nav .profile .setting {
                        display: flex;
                        margin-right: 10px;
                    }

                    .profile-wrapper .profile-section .btn{
                        width: 80px;
                    }
                    .profile-wrapper{
                        width: 360px;
                    }
                }


                /* fotovista logo spin */
                @-webkit-keyframes spin {
                    100% {
                        -webkit-transform: rotate(360deg)
                    }

                    ;
                }

                @-moz-keyframes spin {
                    100% {
                        -webkit-transform: rotate(360deg)
                    }

                    ;
                }

                @keyframes spin {
                    100% {
                        -webkit-transform: rotate(360deg)
                    }

                    ;
                }
            </style>


            <!-- navbar -->
            <div class="nav">
                <div class="logo">
                    <img src="img/fotovista.png">
                    <p>FotoVista</p>
                </div>
                <div class="profile">
                    <a>
                        <img src="<?php echo $image_path ?>">
                        <p> K xa sathi ! <br><span class="username">@<?php echo $_SESSION['username'] ?></span></p>
                    </a>
                    <div class="logout-btn setting">
                        <a href="setting.php?username=<?php echo $_SESSION['username']?>"><span class="material-symbols-outlined">settings</span></a>    
                    </div>
                    <div class="logout-btn">
                        <a href="home.php"><span class="material-symbols-outlined">home</span></a>
                    </div>
                </div>
            </div>

            <?php
            //fetch profile pic
            $fetch_profile_pic = "SELECT * FROM profile_pic where username= '$username' ";
            $fetch_profile_pic_result = mysqli_query($conn, $fetch_profile_pic);

            while ($img = mysqli_fetch_assoc($fetch_profile_pic_result)) {
                $profile_image = $img["file"];
                $_SESSION['profile_img_path'] = !empty($profile_image) ? "Images/profile/" . htmlspecialchars($profile_image) : "img/10011_.jpg";
            }
            //stores profile pic path
            $profile_img_path = $_SESSION['profile_img_path'];
            ?>
            <!-- profile area -->
            <div class="profile-wrapper">
                <div class="profile-section">
                    <img src="<?php echo $profile_img_path; ?>">
                    <p class="fullname"> <?php echo $row['fullname']; ?></p>
                    <p class="username">@ <?php echo $username ?></p>
                    <p class="btn">Follow +</p>
                    <div class="counts">
                        <div class="likes">
                            <num>20</num>
                            <p>Likes</p>
                        </div>
                        <div class="followers">
                            <num><?php echo $row['followers']; ?></num>
                            <p>Followers</p>
                        </div>
                        <div class="posts">
                            <num>30</num>
                            <p>Posts</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- posts -->
            <?php
            $fetch = "SELECT * FROM `posts` WHERE username = '$username' ORDER BY post_id DESC;";
            $fetch_query = mysqli_query($conn, $fetch);

            $posts = [];
            while ($row = mysqli_fetch_assoc($fetch_query)) {
                $posts[] = $row;
            }
            foreach ($posts as $post):
                $post_id = $post['post_id'];
                //fetch post pic
                $fetch_post = "SELECT * FROM post_pic WHERE post_id = '$post_id' ";
                $fetch_post_result = mysqli_query($conn , $fetch_post);

                while($row=mysqli_fetch_assoc($fetch_post_result)){
                    $post_img =$row["file"];
                    $_SESSION['post_img'] = !empty($post_img) ? "Images/posts/" . htmlspecialchars($post_img) : "../img/1_no_img_found-$#.png";
                }
                //stores post pic path
                $post_path = $_SESSION['post_img'];
                ?>
                <div class="post-wrapper">
                    <div class="post-section">
                        <div class="top">
                            <img src="<?php echo $profile_img_path; ?>">
                            <div class="text-area">
                                <p class="username">@ <?php echo $username ?></p>
                                <p class="time">• <?php echo calc_time($post['time']) ?></p>
                            </div>
                        </div>

                        <p class="caption"><?php echo $post['caption'] ?></p>
                        <div class="photo-area">
                            <img src="<?php echo $post_path; ?>">
                        </div>
                        <div class="bottom">
                            <div class="love-wrapper">
                                <span class="material-symbols-outlined">favorite</span>
                                <p><?php echo $post['love']; ?></p>
                            </div>
                            <div class="comment-wrapper">
                                <span class="material-symbols-outlined">chat_bubble</span>
                                <p><?php echo $post['comment-no']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>


 <?php
            endforeach;
    }
} else { //redirect to login page if login session is false
    echo "<script>window.location.href = 'extras/session-expired.html';</script>";
}
?>
    </body>

    </html>