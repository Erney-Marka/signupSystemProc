<?php

declare(strict_types=1);
// объявляем использование сторой типизации

// будет проверять отправлены ли эти данные обратно из-за сообщения об ошибке
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
    var_dump($_SESSION);
    echo '<br>';
    echo '<br>';
    if (isset($_SESSION['signup_data']['email']) && !isset($_SESSION['errors_signup']['email_used']) && !isset($_SESSION['errors_signup']['invalid_email'])) {
        var_dump($_SESSION);
        echo '<input type="text" name="email" placeholder="E-Mail" class="input" value="' . $_SESSION['signup_data']['email'] . '">';
    } else {
        echo '<input type="text" name="email" placeholder="E-Mail" class="input" value="">';
    }

    unset($_SESSION['signup_data']['signup_data']);
    
    // при получении ошибки заполнения данных почему-то поле остается заполнено хотя должно удалять значения
    // вероятно из-за того что в массив значение уже записано - как очистить массив?
    //при выполнении условия согласно дебагеру первый блок возвращает true, хотя судя по условию массив ошибок должен быть пустым и только в этом случае автозаполнять форму, есть предположение, что на момент проверки массив и правда пустой, потому что выполнение проверки ошибок выполняется позже, только после нажатия кнопки отправить массив получает остальные данные

    // удалось сделать так чтобы после регистрации поля очищались, потому что без unset($_SESSION['signup_data']) после регистрации данные оставались на месте
}

// проверка ошибок при регистрации на индексной странице
function check_signup_errors()
{
    // есть ли ошибки хранящиеся внутри сеанса
    // isset — Определяет, была ли установлена переменная значением, отличным от null
    if (isset($_SESSION['error_signup'])) {
        // проверка наличия ошибок делается для того чтобы удалить ошибки истекшей сессии
        // переменная равна сеансу содержащему ошибки
        $errors = $_SESSION['error_signup'];

        // выводим массив с ошибками через цикл
        echo '<br>';
        foreach ($errors as $error) {
            echo '<p class="form_error">' . $error . '</p>';
        }

        // unset — Удаляет переменную - эти данные больше не понадобятся внутри сеанса - сбросит значения переменной
        unset($_SESSION['error_signup']);

        // проверяет есть ли какие-то данные в url адресе (если есть они переданы методом get, поэтому проверяем эту суперглобальную с определенным ключом(signup) и равен ли этот ключ определенному значению(success))
    } else if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
        echo '<br>';
        echo '<p class="form_success">Signup success!</p>';
    }
}
