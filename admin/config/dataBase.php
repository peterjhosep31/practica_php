<?php

  $host = 'localhost';
  $dataBase = 'library';
  $user = 'root';
  $password = '';
  $port = '3307';

  try {
    $conection = new PDO("mysql:host=$host;dbname=$dataBase;", $user, $password);
    if ($conection) {
      echo "<script >console.log('successful connection');</script>";
    }

  } catch (Exception $ex )  {
    echo $ex->getMessage();
  }

?>