<?php
if(!empty($_GET['id'])){
    require_once 'db_connection.php';
    $id=$_GET['id'];
    $sql=$conn->query("delete from usuarios where id= $id");
    if($sql){
        echo "<p class='alert alert-primary'>Registro eliminado con exito</p>";
        
    }else{
        echo "<p class='alert alert-primary'>Error al eliminar</p>";
    }

}
?>