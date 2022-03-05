<?php
include 'funciones.php';

$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  // consulta MySQL que usaremos para obtener la lista de alumnos.
  $consultaSQL = "SELECT * FROM alumnos";

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumnos = $sentencia->fetchAll();

  // Código que obtendrá la lista de alumnos

} catch(PDOException $error) {
  $error = $error->getMessage();
}
?>

<?php include "templates/header.php"; ?>

<!-- aqui va el codigo de la aplicacion -->

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="create.php"  class="btn btn-primary mt-4">Crear alumno</a>
      <hr>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>
