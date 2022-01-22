<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php 


$conexion = new Conexion();

if($_POST){
    $nombre= $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $fecha = new DateTime();

    $imagen = $fecha->getTimestamp() . "_" . $_FILES["archivo"]["name"];

    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $conexion->ejecutar($sql);

    $imagen_temporal =  $_FILES["archivo"]["tmp_name"];

    move_uploaded_file($imagen_temporal, "imagenes/".$imagen);
    header("location:portafolio.php");

}

if($_GET){

    $id = $_GET["borrar"];

    $imagen = $conexion->consultar("SELECT imagen  FROM `proyectos`  WHERE `id` =" . $id);

    unlink("imagenes/".$imagen[0]["imagen"]);

    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =" . $_GET['borrar'];

    $conexion->ejecutar($sql);
    header("location:portafolio.php");
}

$array = $conexion->consultar("SELECT * FROM `proyectos`");

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
    <div class="card-header">
        Datos del proyecto
    </div>
    <div class="card-body">

    <form action="portafolio.php"  method="post" enctype="multipart/form-data">
        Nombre del proyecto: <input class="form-control" type="text" name="nombre" id="">
        <br/>
        Imagen del proyecto: <input class="form-control" type="file" name="archivo" id="">
        <br/>

        
          Descripción:
          <textarea class="form-control" name="descripcion" id="" rows="3"></textarea>

          <br/>
        <input class="btn btn-success" type="submit" value="Enviar proyecto">
    </form>
        
    </div>
    <div class="card-footer text-muted">
        ...
    </div>
</div>
        </div>

        <div class="col-md-6">
        <table class="table">
            <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
            <?php foreach ($array as $value) {?>
            <tr>
                <td ><?php echo $value[0]; ?></td>
                <td><?php echo $value[1]; ?></td>
                <td><img width="100" src=<?php echo "imagenes/".$value[2]?> alt="" srcset=""></td>
                <td><?php echo $value[3]; ?></td>
                <td><a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $value[0]; ?>" role="button">Eliminar</a></td>
            </tr>
            <?php }?>
    </tbody>
</table>
        </div>
        
    </div>
</div>

<?php include("pie.php"); ?>