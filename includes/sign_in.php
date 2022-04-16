<?php
  session_start();
  require "config.php";

  //получаем в переменные данные из name
  $email = $_POST['email'];
  $password1 = $_POST['password1'];
  $password1 = md5($password1);

  $check_user = mysqli_query($connection, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password1'");
  if (mysqli_num_rows($check_user) > 0) 
  {
    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
      "id" => $user['id'],
      "full_name" => $user['full_name'],
      "email" => $user['email']
    ];

    header('Location: ../pages/my_account_s.php');
  } else
  {
    $_SESSION['message'] = 'Неверный email или пароль!';
    header('Location: ../pages/my_account.php');
  }