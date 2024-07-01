<?php include'connection.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/fotovista.png" type="image/x-icon">
    <link rel="stylesheet" href="global.css">
    <title>fotovista - signup</title>
    <style>
    * {
        text-decoration: none;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
    }

    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    img {
        height: 50px;
        width: auto;
        cursor:pointer;
        transform: rotate(0deg); 
        transition: transform 0.8s;
    }

    img:hover{
        transform: rotate(360deg);
    }

    p {
        color: #587DC7;
        font-weight: 600;
        font-size: 30px;
        margin: 20px 0;
    }

    .input-field {
        height: 50px;
        width: 300px;
        margin: 10px 0;
        font-size: 18px;
        padding: 0 10px;
        border: none;
        border-bottom: 2px solid silver;
        outline: none;
        transition: border-color 0.3s;
    }
    

    .input-field:focus {
        border-color: #587DC7;
    }

    .input-field::placeholder {
        color: #767676;
        font-weight: 500;
    }
    #profile-pic {
        display: none;
    }
    #pic-name{
        color: #ffc37a;
        font-size: 15px;
    }
     form label[for="profile-pic"] {
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #F59F34;
        color: white;
        font-size: 1em;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form label[for="profile-pic"]:hover {
        background-color: #ffc37a;
    }

    form .menu {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 20px;
        width: 100%;
    }

    .signup-btn {
        font-size: 18px;
        background-color: #587DC7;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        height: 40px;
        width: 100px;
        color: white;
    }

    form p {
        margin-top: 30px;
        font-size: 15px;
        color: #000;
        font-weight: 400;
    }

    form p a {
        font-size: 15px;
        color: #587DC7;
        font-weight: 400;
        text-decoration: none;
    }

    form p a:hover {
        text-decoration: underline;
    }


     /* responsive */
     @media (max-width: 600px) {
            body{
                background-color:white;
                height: 80vh;
            }
            .container{
                box-shadow: 0px 0px 0px white;
            }
        }



    </style>
</head>

<body>
    <div class="container">
        <img src="img/fotovista.png" alt="logo">
        <p>signup</p>
        <form method="post" action="signup.php" enctype="multipart/form-data">
            <input class="input-field" id="fullname" name="fullname" type="text" placeholder="Fullname" autocomplete="off" required maxlength="15"><br>
            <input class="input-field" id="username" name="username" type="text" placeholder="Username" autocomplete="off" required maxlength="12"><br>
            <input class="input-field" id="email" name="email" type="email" placeholder="Email" autocomplete="off" required><br>
            <input class="input-field" id="password" name="password" type="text" placeholder="Password" autocomplete="off" required><br>
            <span id="pic-name">No file choosen</span><br>
            <input class="input-field-pic" id="profile-pic" name="image" type="file" accept="image/png" required><br>
            <label for="profile-pic">Upload pic</label>
            
            
            <div class="menu">
                <input class="signup-btn" name="signup-btn" type="submit" value="Signup">
            </div>
            <p>Already have account ?<a name="login-btn" href="index.php"> Login</a></p>
        </form>
    </div>

    <?php 

    if(isset($_POST['signup-btn'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //for photo storing & inserting
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name']; 
        $folder = 'Images/profile/'.$file_name;

        $insert_photo = "INSERT INTO profile_pic (username , file) VALUES('$username','$file_name')";
        mysqli_query($conn , $insert_photo);

        move_uploaded_file($tempname,$folder);

        // 
        // Check if username or email already exists
        $fetch = "SELECT username, email FROM registered_users WHERE username = '$username' OR email = '$email'";
        $fetch_query = mysqli_query($conn, $fetch);

        if (mysqli_num_rows($fetch_query) > 0) {
            
            // Username or email already taken
            echo "<script>alert('Username or Email already exists.');</script>";
            echo "<script>window.location.href = 'signup.php';</script>";

        }
        else {
            // Insert the new user
            $insert_query = "INSERT INTO registered_users (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$password')";
        
            if (mysqli_query($conn, $insert_query)) {
                // Redirect to login page after successful insertion
                echo "<script>alert('User registration successful.');</script>";
                echo "<script>window.location.href = 'index.php';</script>";
                exit();
            }
        }
    } 
    
    ?>

    



</body>
<script>
    document.getElementById('profile-pic').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : 'No file chosen';
        document.getElementById('pic-name').textContent = fileName;
    });
</script>
</html>