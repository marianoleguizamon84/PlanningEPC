<?php
require "defaultincludes.inc";
require_once "mrbs_sql.inc";

print_header($day, $month, $year, $area, isset($room) ? $room : "");

$db = new PDO('mysql:host=' . $db_host . ';dbname='. $db_database .';charset=utf8mb4;port:3306', $db_login, $db_password);

   $query = $db->query('SELECT * FROM mrbs_materias order by materia');

   $result = $query->fetchAll(PDO::FETCH_ASSOC);

 ?>

 <h2>Materias</h2>

 <table class="admin_table display" style="margin-bottom: 1em;">
   <tr>
     <th>Materia</th>
     <th>Creditos</th>
     <th>Profesor</th>
     <th>Horario</th>
     <th>Categorias</th>
   </tr>
   <?php foreach ($result as $value) {
     echo "<tr>";
     echo "<td><a href='./materias-subir.php?id=".$value[id]."'>" . $value[materia] . "</a></td>";
     echo "<td style='text-align: center'>" . $value[creditos] . "</td>";
     echo "<td>" . $value[profesor] . "</td>";
     echo "<td style='text-align: center'>" . $value[horario] . "</td>";
     echo "<td></td>";
     echo "</tr>";
   } ?>
 </table>

<div style="margin-bottom: 2em;">
  <button type="button" name="button" id="agregar" class="btn_agregar">Agregar Materia</button>
</div>

 <script type="text/javascript">
   var agregar = document.getElementById('agregar');
   var cancelar = document.getElementById('cancelar');
   var modal = document.getElementById('myModal');
   var categorias = <?php echo json_encode($result); ?>;

   agregar.onclick = function (){
     location.replace("./materias-subir.php");
   }

 </script>
