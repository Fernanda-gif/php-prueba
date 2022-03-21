<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenid@</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenid@ <?= $user['email']; ?>
      <br>Tu sesion inicio con éxito
      <a href="logout.php">
        Cerrar sesion
      </a>
    <?php else: ?>
      <h1>Quieres iniciar sesión o registrarte</h1>

      <a href="login.php">iniciar sesion</a> or
      <a href="signup.php">Registrarte</a>
    <?php endif; ?>
  </body>
</html>