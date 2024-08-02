<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db_connection.php';
   
    $descripcion=(isset($_POST['descripcion']))? $_POST['descripcion']:"";
    $id=(isset($_POST['id']))?$_POST['id']:"";
   
    $errores=array();
    if(empty($descripcion)){
        $errores['nombre']="El campo descripcion es obligatorio";
    }
    if(empty($id)){
        $errores['descripcion']="El campo id es obligatorio";
    }
   
   
    if(empty($errores)){
        $query=$conn->query("insert into receta (descripcion,plato_id)
        values ('$descripcion','$id')");
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