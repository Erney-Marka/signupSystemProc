<?php
//var_dump($_SESSION['error_signup']);


// проверка, что на эту страницу попали через отправку формы, если попасть на страницу через урл то метод будет GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    try {
        require_once 'dbh.inc.php'; // подключаемся к базе

        // отсюда начинается использование модели MVC 
        // обязательно в таком порядке, сначала подключение к базе, потом модель, потом представление(тут не указан), потом контроллер
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // обработчики ошибок
        // создаем массив ошибок
        $errors = [];

        // если функция вернет значение true - выдать сообщение об ошибке

        // проверка заполнения полей
        if (is_input_empty($username, $password, $email)) {
            $errors['emtpy_input'] = 'Fill in all fields!';
        }

        // проверка правильности почты
        if (is_email_invalid($email)) {
            $errors['invalid_email'] = 'Invalid email used!';
        }

        // проверка занято ли имя пользователя
        if (is_username_taken($pdo, $username)) {
            $errors['username_taken'] = 'Username already taken!';
        }

        // проверка занята ли почта
        if (is_email_registered($pdo, $email)) {
            $errors['email_used'] = 'Email already registered!';
        }

        // включает файл сессий
        require_once 'config_session.inc.php';

        // проверяет массив ошибок, если не пустой отправляет на индексную страницу
        // если пользователь ввел не верные данные его отправляет на индексную страницу на которой не нужно заново заполнять некоторые поля
        if ($errors) {
            $_SESSION['error_signup'] = $errors;

            // в массиве будут храниться данные введенные пользователем
            $signupData = [
                'username' => $username,
                'email' => $email
            ];
            // присваиваем значение массива сессии
            $_SESSION['signup_data'] = $signupData;
            header('Location: ../index.php');
            
            die();
        }

        // создаем запись в базу (запускает функцию созданную в контроллере)
        create_user($pdo, $username, $password, $email);
        header('Location: ../index.php?signup=success');

        // прерывает подключение к базе
        $pdo = null;
        // прерывает выполнение подготовленных заявлений
        $stmt = null;

        die();

    } catch (PDOException $e) {
        // если подключение не удалось выводит сообщение об ошибке и убивает выполнение скрипта
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
