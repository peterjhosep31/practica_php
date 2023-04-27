<?php
  $url = "http://" . $_SERVER['HTTP_HOST'] . "/practicas";
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
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <ul class="nav navbar-nav">

      <li class="nav-item active">
        <a class="nav-link" href="#">Practica</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $url . '/index.php' ?>">Home</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $url . '/products.php'; ?>">Product</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">contact</a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <br /><br />
    <dic class="row">