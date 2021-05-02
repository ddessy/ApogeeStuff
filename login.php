<?php
session_start();

include 'repositories/UserRepository.php';

$userRepository = new UserRepository();

$email = $_POST['username'];
$password = $_POST['password'];
echo phpinfo();
$userId = $userRepository->getUserByEmailAndPassword($email, $password);

if (isset($_POST['login_check'])) {
    if ($userId > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $userId;
    } else {
        echo "error";
    }
} else {
    if (!empty($userId)) {

        $_SESSION['email'] = $email;
        $_SESSION['id'] = $userId;

        header('location: quiz.php');
    } else {
        header('location: index.php');
    }
}
?>