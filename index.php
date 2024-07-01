<?php 
include 'connection.php' ;
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/fotovista.png" type="image/x-icon">
    <link rel="stylesheet" href="global.css">
    <title>fotovista - login</title>
    <style>
        * {
            text-decoration: none;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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
            cursor: pointer;
            transform: rotate(0deg);
            transition: transform 0.8s;
        }

        img:hover {
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

        form label {
            margin: 5px 0 5px 10px;
            display: flex;
            line-height: 15px;
            font-size: 18px;
            color: #767676;
        }

        form label input {
            align-items: center;
            height: 15px;
            width: 15px;
            margin: 0;
            margin-right: 5px;
        }

        form .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            width: 100%;
        }

        .forgot-pw {
            color: #587DC7;
            text-decoration: none;
        }

        .forgot-pw:hover {
            text-decoration: underline;
        }

        .login-btn {
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


        /* rewsponsive */
        @media (max-width: 600px) {
            body {
                background-color: white;
                height: 80vh;
            }

            .container {
                box-shadow: 0px 0px 0px white;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="img/fotovista.png" alt="logo">
        <p>login</p>
        <form method="post">
            <input class="input-field" name="email" type="text" placeholder="Email" autocomplete="off" required><br>
            <input class="input-field" name="password" type="text" placeholder="Password" autocomplete="off" required><br>
            <div class="menu">
                <a class="forgot-pw" href="extras/forgot-pw.php">Forgot password?</a>
                <input class="login-btn" name="login-btn" type="submit" value="Login">
            </div>
            <p>New to fotovista ?<a href="signup.php"> Signup</a></p>
        </form>
    </div>
    


    <?php
    if (isset($_POST['login-btn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $fetch = "SELECT email , password ,username ,fullname FROM registered_users";
        $fetch_query = mysqli_query($conn, $fetch);

        $_SESSION['logged_in'] = false;

        while ($row = mysqli_fetch_assoc($fetch_query)) {
            if ($email == $row['email'] && $password == $row['password']) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email'] = $row['email'];
                break;
            }
        }
 
        if ($_SESSION['logged_in'] == true) {          
            echo "<script>window.location.href = 'home.php';</script>";
        } else {
            
            echo "<script>alert('Incorrect email or password.');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }

    }
    ?>


</body>

</html>