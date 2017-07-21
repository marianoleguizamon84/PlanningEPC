<?php
require "defaultincludes.inc";
require_once "mrbs_sql.inc";

try{
  $db = new PDO('mysql:host=' . $db_host . ';dbname='. $db_database .';charset=utf8mb4;port:3306', $db_login, $db_password);

   $query = $db->query('SELECT * FROM mrbs_categorias order by categoria');

   $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

   $id       = $result[0][id];
   $materia  = $result[0][materia];
   $creditos = $result[0][creditos];
   $profesor = $result[0][profesor];
   $horario  = $result[0][horario];
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

if ($_GET[id] == 0){
  $id       = "";
  $materia  = "";
  $creditos = "";
  $profesor = "";
  $horario  = "";
  } else {

       $query = $db->query('SELECT * FROM mrbs_materias where id=' . $_GET[id]);

       $result = $query->fetchAll(PDO::FETCH_ASSOC);

       $id       = $result[0][id];
       $materia  = $result[0][materia];
       $creditos = $result[0][creditos];
       $profesor = $result[0][profesor];
       $horario  = $result[0][horario];

}

if ($_POST[materia] != ""){

    // echo "<pre>";
    // var_dump($_POST[categorias]);
    // die();

    if ($_POST[id] == ""){
      $sql = "INSERT INTO mrbs_materias (materia, creditos, profesor, horario) VALUES ('". $_POST[materia] . "','" . $_POST[creditos] ."','". $_POST[profesor] . "','" . $_POST[horario] ."')";
      $db->exec($sql);
      $nuevo_id = $db->lastInsertId();
      $sql2 = "";
      foreach ($_POST[categorias] as $value) {
        $sql2 =  $sql2 . "INSERT INTO mrbs_mat_cat (materia_id, categoria_id) VALUES (".$nuevo_id.",".$value.");";
      }
      $db->exec($sql2);
      header("Location: ./materias.php");
      exit;
    } else {
      $sql = "UPDATE mrbs_materias SET materia='". $_POST[materia] ."', creditos='" . $_POST[creditos] . "', profesor='" . $_POST[profesor] . "', horario='" . $_POST[horario] . "' WHERE id=" . $_POST[id];
      $stmt = $db->prepare($sql);
      $stmt->execute();
      //Buscar en la tabla las categorias que tiene y luego comparar.
      

      header("Location: ./materias.php");
      exit;
      }
}
 ?>

 <?php print_header($day, $month, $year, $area, isset($room) ? $room : ""); ?>

 <form class="form_general" id="main" action="./materias-subir.php" method="post">
   <fieldset>
     <legend>Nueva Materia</legend>

     <div class="div_name">
       <label for="nombre" style="width: 10%">Id:</label>
       <input type="text" name="id" value="<?php echo $id ?>" readonly placeholder="No Completar" style="width: 45em">
     </div>

     <div class="div_name">
       <label for="nombre" style="width: 10%">Materia:</label>
       <input type="text" name="materia" value="<?php echo $materia ?>" placeholder="Ej: Gestión del Conocimiento" style="width: 45em">
     </div>

     <div class="div_creditos">
       <label for="creditos" style="width: 10%">Creditos:</label>
       <input type="number" name="creditos" value="<?php echo $creditos ?>" min="1" max="3" placeholder="De 1 a 3 creditos" style="width: 45em">
     </div>

     <div class="div_profesor">
       <label for="profesor" style="width: 10%">Profesor:</label>
       <input type="text" name="profesor" value="<?php echo $profesor ?>" placeholder="Ej: Oscar Rodríguez Robledo, Tito Avalos" style="width: 45em">
     </div>

     <div class="div_horario">
       <label for="horario" style="width: 10%">Horario:</label>
       <input type="text" name="horario" value="<?php echo $horario ?>" placeholder="9 a 12" style="width: 45em">
     </div>

     <div class="" style="margin-top: 1em">
     <label for="categorias" style="width: 10%">Categorias:</label>
       <div class="group" style="width:90%">
         <?php
         foreach ($categorias as $key => $value) {
           echo "<label style='width:28%'>";
           echo "<input type='checkbox' name='categorias[]' value='". $value[id] ."'>" . $value[categoria];
           echo "</label>";
         }
         ?>
       </div>
   </div>

     <div style="width: 90%; margin-top: 2em; margin-bottom: 2em; margin-left: 6%">
       <input type="button" name="" value="Cancelar" onclick="volver()">
       <input type="submit" value="Enviar">
     </div>
   </fieldset>

 </form>

 <script type="text/javascript">
 function volver(){
   window.location.href = "./materias.php";
 }
 </script>
