<?php
session_start();
$url = "http://" . $_SERVER['HTTP_HOST'] . "/practicas";
if (!isset($_SESSION['user'])) {
  header('Location:' . $url . '/admin');
} else {
  if ($_SESSION['user'] == 'ok') {
    $nameUser = $_SESSION['nameUser'];
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="<?php echo $url . '/admin/inicio.php'; ?>">inicio</a>
      <a class="nav-item nav-link" href="<?php echo $url . '/admin/section/product.php' ?>">Admin Products</a>
      <a class="nav-item nav-link" href="<?php echo $url . '/admin/section/closeSeccion.php' ?>">Cerrar sesion</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver web</a>
    </div>
  </nav>

  <div class="container">
    <br /><br />
    <div class="row">