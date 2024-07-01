<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/fotovista.png" type="image/x-icon">
    <link rel="stylesheet" href="global.css">
    <title>FotoVista - Forgot password </title>
    <style>
        * {
            box-sizing: border-box;
            text-decoration: none;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
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
            margin: 20px 0 0 0;
        }
        .subheading{
            font-size: 15px;
            color: black;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .input-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input-field {
            outline: none;
            height: 50px;
            width: 325px;
            margin: 0 5px;
            font-size: 20px;
            text-align: center;
            border: 2px solid #c0c0c0;
            border-radius: 8px;
            transition: border-color 0.3s;
        }

        .input-field:focus {
            border-color: #587DC7;
        }

        form menu {
            padding-left: 0;
            font-size: 15px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 20px;
            width: 100%;
        }

        .continue-btn {
            font-size: 20px;
            background-color: #587DC7;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            height: 40px;
            width: 120px;
            color: white;
        }

        .hidden {
            display: none;
        }


         /* rewsponsive */
         @media (max-width: 600px) {
            body{
                background-color:white;
                height: 90vh;
            }
            .container{
                box-shadow: 0px 0px 0px white;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="../img/fotovista.png" alt="logo">
        <p>Forgot your password?</p>
        <p class="subheading">Enter your email address to get code.</p>
        <form>
            <div class="input-container">
                <input class="input-field" type="text" autocomplete="off" placeholder="Enter email">
            </div>
            <menu>
                <input class="continue-btn" type="button" value="Continue">
            </menu>
        </form>
    </div>
</body>

</html>
