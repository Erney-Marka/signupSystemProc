<?php

// объявляем использование сторой типизации
declare(strict_types=1);

// только модели в паттерне MVC можно подключаться и слать запросы базе данных

// ПОЛУЧАЕМ ИМЯ ПОЛЬЗОВАТЕЛЯ ИЗ БАЗЫ
function get_username(object $pdo, string $username)
{
    // !!! не подключаемся к базе так как на странице где функция используется уже есть подключение к ней

    // запрос к базе данных - получить поле username(* используется когда хотят получить все поля из базы, нам нужно только одно поэтому указываем его явно) из таблицы users где username из таблицы равен нашему заполнителю
    $query = 'SELECT username FROM users WHERE username = :username;';

    // подготовленные заявления - отправляя запросы отдельно от фактических данных от пользователя мы отделяем данные от запроса, что предотвращает внедрение sql-инъекций

    // PDO::prepare - Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект, в параметры передается корректный SQL-запрос, 
    $stmt = $pdo->prepare($query);

    // связываем данные и отправляем отдельно
    // метод PDOStatement::bindParam — Привязывает параметр запроса к переменной. Связывает переменную PHP с именованным или неименованным параметром подготавливаемого SQL-запроса.
    // в параметрах передается 1-заполнитель использованный для запроса, 2-переменная в которой хранится значение
    $stmt->bindParam(':username', $username);

    // PDOStatement::execute — Запускает подготовленный запрос на выполнение
    $stmt->execute();

    //PDOStatement::fetch — Извлечение следующей строки из результирующего набора. Извлекает следующую строку из результирующего набора объекта PDOStatement.
    // PDO::FETCH_ASSOC - параметр определяет, что результат выборки будет получен в виде массива индексированного именами столбцов результирующего набора
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}


// ПОЛУЧАЕМ ПОЧТУ ПОЛЬЗОВАТЕЛЯ ИЗ БАЗЫ
function get_email(object $pdo, string $email)
{
    $query = 'SELECT email FROM users WHERE email = :email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}


// СОЗДАЕМ ЗАПИСЬ В БАЗУ
function set_user(object $pdo, string $username, string $password, string $email)
{
    $query = 'INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);';
    $stmt = $pdo->prepare($query);

    $options = ['cost' => 12];
    $pwdHash = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pwd', $pwdHash);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}
