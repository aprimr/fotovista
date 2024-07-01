<?php
include 'connection.php';
include 'extras/calc-time.php';
session_start();
       
if ($_SESSION['logged_in']){

$username = $_SESSION['username'];


//fetch profile pic
$fetch_profile = "SELECT * FROM profile_pic where username= '$username' ";
$fetch_profile_result = mysqli_query($conn , $fetch_profile);

while($row=mysqli_fetch_assoc($fetch_profile_result)){
    $profile_image =$row["file"];
    $_SESSION['image_path'] = !empty($profile_image) ? "Images/profile/" . htmlspecialchars($profile_image) : "img/10011_.jpg";
}
//stores profile pic path
$image_path = $_SESSION['image_path'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="img/fotovista.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="global.css">
    <title>FotoVista - Home </title>
</head>

<body>

    <!-- navbar -->
    <div class="nav">
        <div class="logo">
            <img src="img/fotovista.png">
            <p>FotoVista</p>
        </div>
        <div class="profile">
            <a href="profile.php?username=<?php echo$_SESSION['username']?> ">
                <img src="<?php echo $image_path ?>">
                <p> K xa sathi ! <br><span class="username">@<?php echo $_SESSION['username'] ?></span></p>
            </a>
            <div class="logout-btn">
                <a href="logout.php"><span class="material-symbols-outlined">logout</span></a>
            </div>
        </div>
    </div>

    <!-- content area -->
    <div class="content">

        <!-- sidebar left -->
        <div class="side-bar-left">
            <div class="side-profile">
                <img src="<?php echo$image_path  ?>">
                <p class="side-bar-fullname"> <?php echo $_SESSION['fullname'] ?></p>
                <p class="side-bar-username">@ <?php echo $_SESSION['username'] ?></p>
                <div class="side-bar-btn">
                    <p>Quick Actions</p>
                    <div class="btn-1"><a href="profile.php?username=<?php echo $_SESSION['username']?>"><span class="material-symbols-outlined">person</span>PROFILE</a></div>
                    <div class="btn-2"><a href="setting.php?username=<?php echo $_SESSION['username']?>"><span class="material-symbols-outlined">settings</span>SETTING</a></div>
                    <div class="btn-3"><a href="logout.php"><span class="material-symbols-outlined">logout</span>LOGOUT</a></div>
                </div>
                <div class="side-bar-links">
                    <a href="extras/terms.html">Terms > </a>
                    <a style="color: transparent">About</a>
                    <a href="extras/about.html">About ></a>
                    <p>Made with <span>❤</span></p>
                </div>
            </div>
        </div>

        <!-- center  -->
        <?php 
        $fetch = "SELECT * FROM `posts` ORDER BY post_id DESC;";
        $fetch_query = mysqli_query($conn, $fetch);

        $posts = [];
        while ($row = mysqli_fetch_assoc($fetch_query)) {
            $posts[] = $row;
        }
        
        ?>
    
        <div class="center-area">
            <?php 
            foreach ($posts as $post): 
                $_SESSION['post_id'] = $post['post_id'];
                $post_id = $_SESSION['post_id'];
                $username_profile = $post['username'];

                //fetch post pic
                $fetch_post = "SELECT * FROM post_pic where post_id = '$post_id' ";
                $fetch_post_result = mysqli_query($conn , $fetch_post);

                while($row=mysqli_fetch_assoc($fetch_post_result)){
                    $post_img =$row["file"];
                    $_SESSION['post_img'] = !empty($post_img) ? "Images/posts/" . htmlspecialchars($post_img) : "../img/1_no_img_found-$#.png";
                }
                //stores post pic path
                $post_path = $_SESSION['post_img'];


                //fetch profile pic
                $fetch_profile_pic = "SELECT * FROM profile_pic where username= '$username_profile' ";
                $fetch_profile_pic_result = mysqli_query($conn , $fetch_profile_pic);

                while($img=mysqli_fetch_assoc($fetch_profile_pic_result)){
                    $profile_image =$img["file"];
                    $_SESSION['profile_image_path'] = !empty($profile_image) ? "Images/profile/" . htmlspecialchars($profile_image) : "img/10011_.jpg";
                }
                //stores profile pic path
                $profile_image_path = $_SESSION['profile_image_path'];
                  
            ?>
                <div class="card">
                    <div class="top">
                        <div class="top-wrapper">
                            <img src="<?php echo $profile_image_path ?>">
                            <div class="text-area">
                                <p class="username"><a href="profile.php?username=<?php echo $username_profile?> ">@ <?php echo $username_profile; ?></a></p>
                                <p class="time">• <?php echo calc_time($post['time']);?></p>
                            </div>
                            <!-- <span class="material-symbols-outlined">delete</span> yet to implement-->
                        </div>
                        <p class="caption"><?php echo $post['caption']; ?></p>
                    </div>
                    
                    <div class="photo-area">
                        <img src="<?php echo $post_path ?>">
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
            <?php endforeach; ?>
        </div>


        <!--  sidebar right -->
        <div class="side-bar-right">
            <div class="form-section">
                <p>Create a post</p>
                <form method="post" action="home.php" enctype="multipart/form-data">
                    <input type="text" id="caption" name="caption" placeholder="Write a caption" autocomplete="off" required>
                    <input type="file" name="image" class="file" id="file" accept="image/png" required>
                    <span id="file-name" class="file-label">No file chosen</span>
                    <label for="file" class="file-btn" id="file-btn">Upload File</label>
                    <input class="post-btn" name="post-btn" type="submit" value="Post">
                </form>
                <div class="other-projects">
                    <p>Top Profiles</p>
                    <div><a href="profile.php?username=aprim">aprim > </a></div>
                    <div><a href="profile.php?username=areg">areg > </a></div>
                    <div><a href="profile.php?username=test">test > </a></div>

                </div>
                <div class="copy">
                    <p>2024 @ areg - all rights reserved</p>
                </div>
            </div>

        </div>

        <?php // side bar right form control

        if (isset($_POST['post-btn'])) {
            $caption = $_POST['caption'];

            //for photo storing & inserting
            $file_name = $_FILES['image']['name'];
            $tempname = $_FILES['image']['tmp_name']; 
            $folder = 'Images/posts/'.$file_name;

            $insert_photo = "INSERT INTO post_pic (username , file) VALUES('$username','$file_name')";
            mysqli_query($conn , $insert_photo);

            move_uploaded_file($tempname,$folder);
            //

            $post = "INSERT INTO posts (username,caption) VALUES('$username','$caption')";

            if (mysqli_query($conn, $post)) {
                echo "<script>window.location.href = 'home.php';</script>";

                exit();
            } else {
                echo "<script>alert('insert unsuccess');</script>";
            }

        }

        ?>

        <?php // calculate time fucntion
}
else{ //redirect to login page if login session is false
    echo "<script>window.location.href = 'extras/session-expired.html';</script>";
}

        


    
        ?>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('file').addEventListener('change', function () {
            var fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.querySelector('.file-label').textContent = fileName;
        });
    });
</script>

</html>