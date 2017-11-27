<?php
require "defaultincludes.inc";
require_once "mrbs_sql.inc";

checkAuthorised();

try{
  $db = new PDO('mysql:host=' . $db_host . ';dbname='. $db_database .';charset=utf8mb4;port:3306', $db_login, $db_password);

   $query = $db->query('SELECT * FROM mrbs_categorias order by categoria');

   $categorias = $query->fetchAll(PDO::FETCH_ASSOC);



   $id       = $result[0][id];
   $materia  = $result[0][materia];
   $creditos = $result[0][creditos];
   $profesor = $result[0][profesor];
   $horario  = $result[0][horario];
   $url      = $result[0][url];
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
  $url      = "";
  $titulo   = "Nueva Materia";
  } else {

       $query = $db->query('SELECT * FROM mrbs_materias where id=' . $_GET[id]);

       $result = $query->fetchAll(PDO::FETCH_ASSOC);

       $query = $db->query('SELECT categoria_id FROM mrbs_mat_cat where materia_id=' . $_GET[id]);

       $mat_cat = $query->fetchAll(PDO::FETCH_ASSOC);


       $id       = $result[0][id];
       $materia  = $result[0][materia];
       $creditos = $result[0][creditos];
       $profesor = $result[0][profesor];
       $horario  = $result[0][horario];
       $url      = $result[0][url];
       $titulo   = "Editar Materia";

}

if ($_POST[materia] != ""){

    if ($_POST[id] == ""){
      $sql = "INSERT INTO mrbs_materias (materia, creditos, profesor, horario, url) VALUES ('". $_POST[materia] . "','" . $_POST[creditos] ."','". $_POST[profesor] . "','" . $_POST[horario] ."','" . $_POST[url] . "')";
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
      $sql = "UPDATE mrbs_materias SET materia='". $_POST[materia] ."', creditos='" . $_POST[creditos] . "', profesor='" . $_POST[profesor] . "', horario='" . $_POST[horario] . "', url='" . $_POST[url] . "' WHERE id=" . $_POST[id];
      $stmt = $db->prepare($sql);
      $stmt->execute();
      //Que la base verifique el form y luego el form la base64_decode
      $query = $db->query('SELECT id, categoria_id FROM mrbs_mat_cat where materia_id=' . $_POST[id]);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $base_cat) {
        $bien = false;
        foreach ($_POST[categorias] as $form_cat) {
          if ($base_cat[categoria_id] == $form_cat) {
            $bien = true;
          }
        }
        if (!$bien){
          $sql_base = $sql_base . 'DELETE FROM mrbs_mat_cat WHERE id=' . $base_cat[id] . ';';
        }
      }
      foreach ($_POST[categorias] as $form_cat) {
        $bien = false;
        foreach ($result as $base_cat) {
          if ($form_cat == $base_cat[categoria_id]) {
            $bien = true;
          }
        }
        if (!$bien){
          $sql_base = $sql_base . 'INSERT INTO mrbs_mat_cat (materia_id, categoria_id) VALUES (' . $_POST[id] .','. $form_cat  . ');';
        }
      }

      $db->exec($sql_base);

      header("Location: ./materias.php");
      exit;
      }
}
 ?>

 <?php print_header($day, $month, $year, $area, isset($room) ? $room : ""); ?>

 <form class="form_general" id="main" action="./materias-subir.php" method="post">
   <fieldset>
     <legend><?php echo $titulo ?></legend>

     <div class="div_name">
       <label for="nombre" style="width: 10%">Id:</label>
       <input type="text" name="id" value="<?php echo $id ?>" readonly placeholder="No Completar" style="width: 45em" required>
     </div>

     <div class="div_name">
       <label for="nombre" style="width: 10%">Materia:</label>
       <input type="text" name="materia" value="<?php echo $materia ?>" placeholder="Ej: Gestión del Conocimiento" style="width: 45em" required>
     </div>

     <div class="div_creditos">
       <label for="creditos" style="width: 10%">Creditos:</label>
       <input type="number" name="creditos" value="<?php echo $creditos ?>" min="1" max="3" placeholder="De 1 a 3 creditos" style="width: 45em" required>
     </div>

     <div class="div_profesor">
       <label for="profesor" style="width: 10%">Profesor:</label>
       <input type="text" name="profesor" value="<?php echo $profesor ?>" placeholder="Ej: Oscar Rodríguez Robledo, Tito Avalos" style="width: 45em" required>
     </div>

     <div class="div_horario">
       <label for="horario" style="width: 10%">Horario:</label>
       <input type="text" name="horario" value="<?php echo $horario ?>" placeholder="9 a 12" style="width: 45em" required>
     </div>

     <div class="div_url">
       <label for="url" style="width: 10%">Horario:</label>
       <input type="text" name="url" value="<?php echo $url ?>" placeholder="http://materia.austral.edu.ar" style="width: 45em" required>
     </div>

     <div class="" style="margin-top: 1em">
     <label for="categorias" style="width: 10%">Categorias:</label>
       <div class="group" style="width:90%">
         <?php
         foreach ($categorias as $value) {
           echo "<label style='width:28%'>";
           $tilde = false;
           foreach ($mat_cat as $value2) {
             if ($value[id] == $value2[categoria_id]){
               $tilde = true;
             }
           }
           if ($tilde) {
             echo "<input type='checkbox' name='categorias[]' value='". $value[id] ."' checked>" . $value[categoria];
           } else {
             echo "<input type='checkbox' name='categorias[]' value='". $value[id] ."'>" . $value[categoria];
           }
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
