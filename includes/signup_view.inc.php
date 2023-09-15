<?php

declare(strict_types=1);


function signup_inputs()
{
    // проверяем заполнено ли имя пользователя, корректно ли заполнено
    if (isset($_SESSION['signup_data']['username']) && !isset($_SESSION['errors_signup']['username_taken'])) {
        echo '<input type="text" name="username" placeholder="Username" class="input" value="' . $_SESSION['signup_data']['username'] . '">';
    } else {
        echo '<input type="text" name="username" placeholder="Username" class="input">';
    }

    // повторяем ввод пароля
    echo '<input type="password" name="pwd" placeholder="Password" class="input">';

    // проверяем заполнена ли почта, корректно ли заполнена
    if (isset($_SESSION['signup_data']['email']) && !isset($_SESSION['errors_signup']['email_used']) && !isset($_SESSION['errors_signup']['invalid_email'])) {
        echo '<input type="text" name="email" placeholder="E-Mail" class="input" value="' . $_SESSION['signup_data']['email'] . '">';
    } else {
        echo '<input type="text" name="email" placeholder="E-Mail" class="input" value="">';
    }

    unset($_SESSION['signup_data']['signup_data']);
}

// проверка ошибок при регистрации на индексной странице
function check_signup_errors()
{
    if (isset($_SESSION['error_signup'])) {
        $errors = $_SESSION['error_signup'];

        echo '<br>';

        foreach ($errors as $error) {
            echo '<p class="form_error">' . $error . '</p>';
        }

        unset($_SESSION['error_signup']);
    } else if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
        echo '<br>';
        echo '<p class="form_success">Signup success!</p>';
    }
}
