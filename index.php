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

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<!-- codigo del boton para crear un boton -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="create.php"  class="btn btn-primary mt-4">Crear alumno</a>
      <hr>
    </div>
  </div>
</div>

<!-- Lista de los alumnos registrados -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3">Lista de alumnos</h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Edad</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($alumnos && $sentencia->rowCount() > 0) {
            foreach ($alumnos as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila["id"]); ?></td>
                <td><?php echo escapar($fila["nombre"]); ?></td>
                <td><?php echo escapar($fila["apellido"]); ?></td>
                <td><?php echo escapar($fila["email"]); ?></td>
                <td><?php echo escapar($fila["edad"]); ?></td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>
