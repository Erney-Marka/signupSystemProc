<?php

declare(strict_types=1);


// ПРОВЕРКА ЗАПОЛНЕНИЯ СТРОК
function is_input_empty(string $username, string $password, string $email)
{
    if (empty($username) || empty($password) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

// ПРОВЕРКА ДЕЙСТВИТЕЛЬНО ЛИ ПОЧТА ЯВЛЯЕТСЯ ПОЧТОЙ
function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

// ЗАНЯТО ЛИ ИМЯ ПОЛЬЗОВАТЕЛЯ
function is_username_taken(object $pdo, string $username)
{
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

// ЗАНЯТА ЛИ ПОЧТА
function is_email_registered(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $password, string $email)
{
    set_user($pdo, $username, $password, $email);
}
