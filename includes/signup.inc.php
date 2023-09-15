<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        $errors = [];

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
        if ($errors) {
            $_SESSION['error_signup'] = $errors;

            $signupData = [
                'username' => $username,
                'email' => $email
            ];

            $_SESSION['signup_data'] = $signupData;
            header('Location: ../index.php');

            die();
        }

        create_user($pdo, $username, $password, $email);
        header('Location: ../index.php?signup=success');

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
