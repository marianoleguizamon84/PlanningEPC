<?php
require "defaultincludes.inc";
require_once "mrbs_sql.inc";

$long_descr = 'Hola a todos DAP DCI';
// $db = new PDO('mysql:host=' . $db_host . ';dbname='. $db_database .';charset=utf8mb4;port:3306', $db_login, $db_password);
// $query = $db->query('SELECT * FROM mrbs_categorias');
// $categorias = $query->fetchAll(PDO::FETCH_ASSOC);



$sql = "SELECT * FROM mrbs_categorias";
$categorias = sql_query($sql);
var_dump($categorias);


foreach ($categorias as $value) {
  $existe = stripos($long_descr, $value[codigo]);
  if ($existe) {
    $result = $result . '<span style="height:10px; width:10px; border-radius:50px; margin-left: 2px ; background-color: '.$value[color].'" title="' . $value[categoria] . '"></span>';
  }
}
echo $result;

 ?>

</div>
