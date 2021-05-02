<?php
include 'repositories/UserRepository.php';

$userRepository = new UserRepository();

session_start();

$email = $_POST['email'];
$name = $_POST['fullname'];
$password = $_POST['password'];

$userId = $userRepository->getUserIdByEmail($email);

if (isset($_POST['email_check'])) {
    if (!empty($userId)) {
        echo "userexists";
    }
} else {
    $password = md5($password);//encrypt the password before saving in the database

    $userId = $userRepository->registerUser($email, $password, $name);

    $_SESSION['email'] = $email;
    $_SESSION['id'] = $userId;

    header('location: quiz.php');
}

?>