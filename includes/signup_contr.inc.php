<?php

// объявляем использование сторой типизации
declare(strict_types=1);


// ПРОВЕРКА ЗАПОЛНЕНИЯ СТРОК
// в параметры функции передаются имя пользователя, пароль и почта
function is_input_empty(string $username, string $password, string $email) { 
    // функция empty() проверяет пустая переменная или нет, если пустая возвращает true
    // через ИЛИ проверяются значения и если хоть одно пустое условие считается true и возвращает значение внутри
    if (empty($username) || empty($password) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

// ПРОВЕРКА ДЕЙСТВИТЕЛЬНО ЛИ ПОЧТА ЯВЛЯЕТСЯ ПОЧТОЙ
function is_email_invalid(string $email) { 
    // filter_var() - Фильтрует переменную с помощью определённого фильтра
    // FILTER_VALIDATE_EMAIL - Проверяет, что значение является корректным e-mail.
    // условие проверяет почту по фильтру и если оно не валидно возвращает true
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

// ЗАНЯТО ЛИ ИМЯ ПОЛЬЗОВАТЕЛЯ
function is_username_taken(object $pdo, string $username) {
    // используем функцию которую подготовили в документе модель(так как идет подключение к базе)
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

// ЗАНЯТА ЛИ ПОЧТА
function is_email_registered(object $pdo, string $email) {
    // используем функцию которую подготовили в документе модель(так как идет подключение к базе)
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $password, string $email)
{
    // запускает функцию созданную в модели 
    set_user($pdo, $username, $password, $email);
}