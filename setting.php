<?php
include 'connection.php';
include 'extras/calc-time.php';
session_start();
if ($_SESSION['logged_in'] && $_GET['username']) {

    $username = $_GET['username'];
    $password = $_SESSION['password'];
    $image_path = $_SESSION['image_path'];
    //fetch profile data from db
    $fetch = "SELECT * FROM registered_users WHERE `username` = '$username' ";
    $fetch_result = mysqli_query($conn, $fetch);

    while ($row = mysqli_fetch_array($fetch_result)) {
        $password = $row['password'];
        $_SESSION['password'] = $password;

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
                <title>FotoVista - Settings</title>
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
                /* setting-section */
                .setting-wrapper {
                    display: flex;
                    justify-content: center;
                    height: 710px;
                    width: 100%;
                    padding: 20px;
                }

                .setting-wrapper .setting-section {
                    text-align: center;
                    width: 400px;
                    margin: auto;
                    margin-bottom: 0;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 1px 1px 20px silver;
                }
                .setting-wrapper .setting-section h3{
                    color: #587DC7;
                    font-size: 23px;
                    font-weight: 600;
                    margin-bottom: 10px;
                }
                .setting-wrapper .setting-section .email {
                    margin: 10px;
                    margin-bottom: 15px;
                    text-align: left;
                }
                .setting-wrapper .setting-section  h4{
                    color: #587DC7;
                    font-size: 19px;
                    font-weight: 500;
                }
                .setting-wrapper .setting-section .email p{
                    font-size: 15px;
                }
                .setting-wrapper .setting-section .email p span{
                    color: #57B0A2;
                }
                .setting-wrapper .setting-section .password {
                    margin: 10px;
                    text-align: left;
                }
                .setting-wrapper .setting-section .input{
                    width: 100%;
                    height: 40px;
                    margin: 5px 0 10px 0;
                    padding-left: 8px;
                    border-radius: 3px;
                    border: 2px solid silver;
                    outline: none;
                }
                .setting-wrapper .setting-section .input:focus{
                    border-color: #587DC7;
                }
                .setting-wrapper .setting-section .btn{
                    border: none;
                    outline: none;
                    height: 30px;
                    width: 150px;
                    background-color: #F59F34;
                    cursor: pointer;
                    border-radius: 3px;
                }
                .setting-wrapper .setting-section .btn:hover{
                    background-color: #ffc37a;
                }
                .setting-wrapper .setting-section .delete {
                    margin: 10px;
                    text-align: left;
                }
                .setting-wrapper .setting-section .del{
                    background-color: #D22F3F;
                    color: white;
                }
                .setting-wrapper .setting-section .del:hover{
                    background-color: #f13548;
                    
                }
                .setting-wrapper .setting-section .cancel {
                    margin: 10px;
                    margin-bottom: 15px;
                    text-align: right;
                }
                .setting-wrapper .setting-section .cncl{
                    justify-content: right;
                    background-color: #57B0A2;
                    color: white;
                }
                .setting-wrapper .setting-section .cncl:hover{
                    background-color: #65d0c0;
                    
                }
                

                /*  */
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
                    <div class="logout-btn">
                        <a href="home.php"><span class="material-symbols-outlined">home</span></a>
                    </div>
                </div>
            </div>


            <div class="setting-wrapper">
                <div class="setting-section">
                    <h3>Settings</h3>
                    <div class="email">
                        <h4>Change email</h4>
                        <p>Current email : <span><?php echo $row['email'];}?></span></p>
                        <form method="post">
                            <input type="email" class="input" name="new_email" placeholder="Enter new email" required maxlength="50"><br>
                            <input type="submit" class="btn" name="email_btn" value="Change email">
                        </form>
                    </div>
                    <div class="password">
                        <h4>Change password</h4>
                        <form method="post">
                            <input type="text" class="input" name="old_pass" placeholder="Enter old password" required maxlength="30"><br>
                            <input type="text" class="input" name="new_pass" placeholder="Enter new password" required maxlength="30"><br>
                            <input type="submit" class="btn" name="pass_btn" value="Change password">
                        </form>
                    </div>
                    <div class="delete">
                        <h4>Delete account</h4>
                        <form method="post">
                            <input type="text" class="input" name="pass" placeholder="Enter password" required maxlength="30">
                            <button class="btn del" name="delete_btn">Delete account</button>
                        </form>
                    </div>
                    <div class="cancel">
                        <form method="post">
                            <button class="btn cncl" name="cancel_btn">Cancel</button>
                        </form>
                    </div>

                </div>
            </div>
            <?php
                //change email
                if(isset($_POST['email_btn'])){
                    $new_email = $_POST['new_email'];
                    $update= "UPDATE `registered_users` SET `email`= '$new_email' WHERE `username` = '$username' ";
                    if(mysqli_query($conn,$update)){
                        echo "<script>window.location.href = 'extras/session-expired.html';</script>";
                    }
                    else{
                        echo "<script>window.location.href = 'setting.php';</script>";
                    }
                }
                //change password
                if(isset($_POST['pass_btn'])){
                    $old_pass = $_POST['old_pass'];
                    $new_pass = $_POST['new_pass'];
                    if($password == $old_pass){
                        $update= "UPDATE `registered_users` SET `password`= '$new_pass' WHERE `username` = '$username' ";
                        if(mysqli_query($conn,$update)){
                            echo "<script>window.location.href = 'extras/session-expired.html';</script>";
                        }
                        else{
                            echo "<script>window.location.href = 'setting.php';</script>";
                        }
                    }
                    else{
                        echo "<script>alert('Incorrect old password.');</script>";
                        echo "<script>window.location.href = 'setting.php?username=$username';</script>";
                    }
                }
                //delete account
                if(isset($_POST['delete_btn'])){
                    $pass= $_POST['pass'];
                    if($password == $pass){
                        $delete = "DELETE FROM `registered_users` WHERE `username` = '$username' ";
                        if(mysqli_query($conn,$delete)){
                            echo "<script>window.location.href = 'extras/session-expired.html';</script>";  
                        }
                        else{
                            echo "<script>alert('Error deleting account.')</script>";
                        }
                        mysqli_query($conn,"DELETE FROM  `posts` WHERE `username` = '$username' ");
                        mysqli_query($conn,"DELETE FROM  `profile_pic` WHERE `username` = '$username' ");
                        mysqli_query($conn,"DELETE FROM  `posts_pic` WHERE `username` = '$username' ");

                    }
                    else{
                        echo "<script>alert('Incorrect password.')</script>";
                        echo "<script>window.location.href = 'setting.php?username=$username';</script>";
                    }
                }
                //cancel
                if(isset($_POST['cancel_btn'])){
                    echo "<script>window.location.href = 'home.php';</script>";
                }
            ?>


 <?php
                
 }
 else { //redirect to login page if login session is false
    echo "<script>window.location.href = 'extras/session-expired.html';</script>";
}

?>
    </body>

    </html>