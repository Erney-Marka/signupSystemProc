<?php

$host = "mysql:host=localhost;dbname=dbsignup";
//$dbname = 'dbsignup';
$dbusername = 'root';
$dbpassword = '';


// модель исключений try catch
// в блоке try - обработка потенциальных исключений
// если возникает ошибка, то можно сделать что-то еще
try { 
    // запуск соединения с базой с помощью класса PDO 
    // new PDO - это встроенный класс для подключения к базе
    $pdo = new PDO($host, $dbusername, $dbpassword);
    // атрибуты для подключения к PDO
    // setAttribute() - устанавливает атрибуты подключению PDO
    // PDO::ATTR_ERRMODE - Режим сообщения об ошибках PDO. Может принимать одно из следующих значений...
    // PDO::ERRMODE_EXCEPTION - одно из значение PDO::ATTR_ERRMODE которое выбрасывает PDOException - которое мы ловим в условии к блоку catch и присваиваем переменной $e
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 

// блок catch - ловит исключение и возвращает что с ним сделать
catch (PDOException $e) { // 
    // die() - Вывести сообщение и прекратить выполнение текущего скрипта
    // getMessage() - Возвращает сообщение исключения в виде строки.
    // способ вывести сгенерированное сообщение об ошибке, в переменной $e будет храниться ошибка полученная от PDOException, getMessage() ее выведет
    die('Connection failed: ' . $e->getMessage()); 
}