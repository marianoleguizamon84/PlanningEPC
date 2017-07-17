<?php
require "defaultincludes.inc";
require_once "mrbs_sql.inc";

print_header($day, $month, $year, $area, isset($room) ? $room : "");

$db = new PDO('mysql:host=' . $db_host . ';dbname='. $db_database .';charset=utf8mb4;port:3306', $db_login, $db_password);

   $query = $db->query('SELECT * FROM mrbs_categorias order by categoria');

   $result = $query->fetchAll(PDO::FETCH_ASSOC);

 ?>

 <h2>Categorias</h2>

 <table class="admin_table display" style="margin-bottom: 1em">
   <tr>
     <th>Categoria</th>
     <th>Color</th>
   </tr>
   <?php foreach ($result as $value) {
     echo "<tr>";
     echo "<td onclick=editar(" . $value[id] . ")>" . $value[categoria] . "</td>";
     echo "<td><div class='color' title='".$value[categoria]."' style='background-color: " . $value[color] . ";'></div></td>";
     echo "</tr>";
   } ?>
 </table>

<div style="margin-bottom: 2em;">
  <button type="button" name="button" id="agregar" class="btn_agregar">Agregar Categoria</button>
</div>


 <div id="myModal" class="modal">

   <div class="modal-content">
     <form class="form" action="./categorias-subir.php" method="post">
       <h3 id="modal_Titulo">Editar Categoria</h3>
       <div class="campo">
         <label for="ide">Id:</label>
         <input id="ide" type="number" name="ide" readonly placeholder="No Completar">
       </div>
       <div class="campo">
         <label for="categoria">Categoria: </label>
         <input id="categoria" type="text" name="categoria" placeholder="Ej: Obligatoria Todas Las Maestrías, Diplomatura Comunicación Interna">
       </div>
       <div class="campo">
         <label for="color">Color: </label>
         <input id="color" type="color" name="color">
       </div>
       <div class="botones">
         <input id="cancelar" type="button" value="Cancelar">
         <input id="enviar" type="submit" value="Enviar">
       </div>
     </form>
   </div>
 </div>
 <script type="text/javascript">
   var agregar = document.getElementById('agregar');
   var cancelar = document.getElementById('cancelar');
   var modal = document.getElementById('myModal');
   var categorias = <?php echo json_encode($result); ?>;

   agregar.onclick = function (){
     document.getElementById('modal_Titulo').innerText = "Nueva Categoria"
     document.getElementById('ide').value = "";
     document.getElementById('categoria').value = "";
     document.getElementById('color').value = "";
     document.getElementById('enviar').value = "Crear";
     modal.style.display = "block";
   }

   cancelar.onclick = function(){
     modal.style.display = "none";
   }

   window.onclick = function(event){
     if (event.target == modal){
       modal.style.display = "none";
     }
   }

   function editar(id){
     for (var i = 0; i < categorias.length; i++) {
       if (categorias[i].id == id){
         var cat = categorias[i].categoria;
         var col = categorias[i].color;
       }
     }
     document.getElementById('modal_Titulo').innerText = "Editar Categoria"
    document.getElementById('ide').value = id;
    document.getElementById('categoria').value = cat;
    document.getElementById('color').value = col;
    document.getElementById('enviar').value = "Editar";
    modal.style.display = "block";
   }
 </script>
