<?php
require "defaultincludes.inc";
require_once "mrbs_sql.inc";

try{
  $db = new PDO('mysql:host=' . $db_host . ';dbname='. $db_database .';charset=utf8mb4;port:3306', $db_login, $db_password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($_POST[ide] == ""){
    $sql = "INSERT INTO mrbs_categorias (categoria, codigo, color) VALUES ('". $_POST[categoria] . "','" . $_POST[codigo] . "','" .$_POST[color] ."')";
    $db->exec($sql);
    header("Location: ./categorias.php");
    exit;
  } else {
    $sql = "UPDATE mrbs_categorias SET categoria='". $_POST[categoria] ."', codigo='". $_POST[codigo] ."', color='" . $_POST[color] . "' WHERE id=".$_POST[ide];
    $stmt = $db->prepare($sql);
    $stmt->execute();
    header("Location: ./categorias.php");
    exit;
    }
  }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
 ?>

 // print_header($day, $month, $year, $area, isset($room) ? $room : "");
 <a href="./categorias.php">Volver a categorias</a>

 <footer>Fin</footer>
