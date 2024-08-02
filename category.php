
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db_connection.php';
    $nombre=(isset($_POST['nombre']))? $_POST['nombre']:"";
    $descripcion=(isset($_POST['descripcion']))? $_POST['descripcion']:"";
    $encargado=(isset($_POST['encargado']))?$_POST['encargado']:"";
   
    $errores=array();
    if(empty($nombre)){
        $errores['nombre']="El campo nombre es obligatorio";
    }
    if(empty($descripcion)){
        $errores['descripcion']="El campo descripcion es obligatorio";
    }
    if(empty($encargado)){
        $errores['encargado']="El campo encargado es obligatorio";
    }
   
    if(empty($errores)){
        $query=$conn->query("insert into categorias (nombre,descripcion,encargado)
        values ('$nombre','$descripcion','$encargado')");
        if($query==1){
            echo "<p class='alert alert-danger'>Registro creado con exito</p>";
            header('Location: empleado.php');
            //echo "<script>window.location = 'main.php';</script>";

        }else{
            echo "<p class='alert alert-danger'>Error al crear el usuario</p>";
            
        }
    }else{
        foreach($errores as $error){
            echo "<p class='alert alert-danger text-center'>$error</p>";
            
        }
    }
    
}

?>