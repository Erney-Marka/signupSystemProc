<?php
//var_dump($_SERVER['REQUEST_METHOD']);

require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>

<body class="body">
    <div class="wrapper">
        <div class="container">

            <h3 class="title">Login</h3>

            <form action="includes/login.inc.php" method="post" class="form" class="input">
                <input type="text" name="username" placeholder="Username" class="input">
                <input type="password" name="pwd" placeholder="Password" class="input">
                <button class="btn">Login</button>
            </form>
        </div>

        <div class="container">

            <h3 class="title">Signup</h3>

            <form action="includes/signup.inc.php" method="post" class="form">
                <!-- <input type="text" name="username" placeholder="Username" class="input">
                <input type="password" name="pwd" placeholder="Password" class="input">
                <input type="text" name="email" placeholder="E-Mail" class="input"> -->

                <!-- функция для ввода описана в signup_view.inc.php -->
                <?php
                signup_inputs();
                ?>

                <button class="btn">Signup</button>
            </form>
        </div>
    </div>

    <?php
    // проверка ошибок при регистрации
    check_signup_errors();
    ?>

</body>

</html>