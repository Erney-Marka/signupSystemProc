<?php
// защита сессий

// переопределение настроек php.ini - будет использовать только cookies для хранения идентификатора сессии на стороне клиента (включили)
ini_set('session.use_only_cookies', 1);

// переопределение настроек php.ini - включает режим строгого идентификатора, если браузер получил неопределенный ID - то ему будет присвоен новый
ini_set('session.use_strict_mode', 1);

// удалить файл куки по истечении времени
session_set_cookie_params([ //Устанавливает параметры сессионной cookie
    'lifetime' => 1800, // время жизни 30 минут
    'domain' => 'localhost', // работает на локальном домене
    'path' => '/signupSystemProc', // работает по любому из путей домена
    'secure' => true, // безопасность, гарантирует что мы будем запускать файл куки только внутри защищенного веб сайта
    'httponly' => true // только по протоколу http, ограничивает любой доступ со стороны к скриптам нашего клиента
]);

session_start();

// запуск обновления сессии на каждые 30 минут, см. подробно в документе my_crud -> config.inc.php

function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

if (!isset($_SESSION['last_regeneration'])) {
    // session_regenerate_id(true);
    // $_SESSION['last_regeneration'] = time();

    regenerate_session_id(); // вместо дублирования кода используем созданную функцию
} else {

    $interval = 60 * 30;

    if (time() - $_SESSION['last_regeneration'] >= $interval) {
        // session_regenerate_id(true);
        // $_SESSION['last_regeneration'] = time();

        regenerate_session_id();
    }
}


