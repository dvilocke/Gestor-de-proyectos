<?php  include ("cabecera.php");  ?>
<?php include("conexion.php"); ?>

<?php

$conexion = new Conexion();
$array = $conexion->consultar("SELECT * FROM `proyectos`");
$nombre = "";

if($_SESSION["login"]){
    $nombre = "Miguel";
} 
?>

<div class="p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Bienvenid@s <?php echo $nombre  ?></h1>
        <p class="lead">Este es un portafolio privado</p>
        <hr class="my-2">
        <p>Más información</p>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
<?php foreach ($array as $value) {?>
    <div class="col">
    <div class="card">
      <img src=<?php echo "imagenes/".$value["imagen"] ?> class="card-img-top" alt="imagen del proyecto">
      <div class="card-body">
        <h5 class="card-title"><?php echo $value["nombre"] ?></h5>
        <p class="card-text"><?php echo $value["descripcion"] ?></p>
      </div>
    </div>
  </div>

<?php }?>
</div>




<?php include("pie.php"); ?>