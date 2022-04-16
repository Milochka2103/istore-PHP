<?php
  session_start();
  require "config.php";

  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if ($password1 === $password2) {

    $password1 = md5($password1);
    mysqli_query($connection, "INSERT INTO `users` (`id`, `full_name`,`email`, `password`) VALUES (NULL, '$full_name','$email', '$password1')");
    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: ../pages/my_account.php');
  } else {
    $_SESSION['message'] = 'Пароли не совпадают!';
    header('Location: ../pages/registr.php');
  }

