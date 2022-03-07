<?php
include 'funciones.php';

$config = include 'config.php';

$resultado = [
    'error' => false,
    'mensaje' => ''
];

try{
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $id = $_GET['id'];
  $consultaSQL = "DELETE FROM alumnos WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  header('Location: /index.php');
  
}catch(PDOException $error){
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>
<!-- código de la página -->
<?php require "templates/footer.php"; ?>