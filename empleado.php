<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // include("db_connectation.php");
    require_once 'db_connection.php';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

    $dificultad = (isset($_POST['dificultad'])) ? $_POST['dificultad'] : "";
    $file = $_FILES['imagen']['tmp_name'];
    $imagen = $_FILES['imagen']['name'];
    $tipoImagen = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
    $precio = (isset($_POST['precio'])) ? $_POST['precio'] : "";
    $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : "";
    $errores = array();

    if (empty($nombre)) {
        $errores['nombre'] = "El campo nombre es obligatorio";
    }
    if (empty($descripcion)) {
        $errores['descripcion'] = "El campo descripcion es obligatorio";
    }
    if (empty($dificultad)) {
        $errores['dificultad'] = "El campo dificultad es obligatorio";
    }
    if (empty($imagen)) {
        $errores['imagen'] = "El campo imagen es obligatorio";
    }
    if (empty($precio)) {
        $errores['precio'] = "El campo precio es obligatorio";
    }
    if (empty($categoria)) {
        $errores['categoria'] = "El campo categoria es obligatorio";
    }
    $directorio = "imagenes/";
    if ($tipoImagen == "jpg" or $tipoImagen == "png" or $tipoImagen == "jpeg") {
        if (empty($errores)) {

            $query = $conn->query("insert into platos (nombre,descripcion,nivel_dificultad,foto,precio,categoria_id)
            values ('$nombre','$descripcion','$dificultad','','$precio','$categoria')");
            if ($query == 1) {
                echo "<p class='alert alert-danger'>Registro creado con exito</p>";
                $idRegistro = $conn->insert_id;
                $ruta = $directorio . $idRegistro . "." . $tipoImagen;
                $actualizarImagen = $conn->query("update platos set foto='$ruta' where id =$idRegistro");
                if (move_uploaded_file($file, $ruta)) {
                    echo "<p class='alert alert-success'>Imagen subida con exito</p>";
                } else {
                    echo "<p class='alert alert-danger'>Error al subir imagen</p>";
                }
                header('Location: empleado.php');
                //echo "<script>window.location = 'main.php';</script>";
            } else {
                echo "<p class='alert alert-danger'>Error al crear el usuario</p>";
            }
        } else {
            foreach ($errores as $error) {
                echo "<p class='alert alert-danger'>" . $error . "</p>";
            }
        }
    } ?>
    <script>
        history.replaceState(null, null, location.pathname);
    </script>
<?php }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand btn btn-danger im" href="#"><i class="fa-solid fa-mug-hot"></i></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php" aria-disabled="true">Iniciar sesion</a>
                                </li>
                            </ul>
                            
                            <div class="d-flex gap-2">
                                <a href="./cerrarSesion/salir.php" class="btn btn-outline-danger" role="button">
                                    Salir
                                </a>
                                <a href="menu.php" class="btn btn-outline-success" role="button">
                                    Ver Menú
                                </a>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-12">
                <?php
                if (isset($_SESSION['nombre'])) {
                    echo "<h1>Bienvenido: " . htmlspecialchars($_SESSION['nombre']) . "</h1>";
                    //unset($_SESSION['nombre']);
                } else {
                    echo "<h1>Error: No hay sesión iniciada.</h1>";
                }
                ?>


            </div>
            <div class="col-12">
                <p>Registrar categoria</p>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <?php
                        include("category.php");

                        ?>
                        <p>Categoria</p>
                    </div>
                    <div class="card-body">
                        <form action="category.php" method="post">
                            <div>
                                <label class="form-label">Nombre</label>
                                <select name="nombre">
                                    <option value="sopas">Sopas</option>
                                    <option value="bebidas">Bebidas</option>
                                    <option value="desayuno">Desayunos</option>
                                    <option value="arroz">Arroz</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="descripcion">
                            </div>
                            <div>
                                <label class="form-label">Encargado</label>
                                <input type="text" class="form-control" name="encargado">
                            </div>

                            <div class="mt-4 text-center mb-4">
                                <button class="btn btn-primary" type="submit">Registrar Categoria</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <p>Registro de platos</p>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <p>Registro de platos</p>
                    </div>
                    <div class="body">
                        <form action="empleado.php" method="post" enctype="multipart/form-data">
                            <div>
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre">
                            </div>
                            <div>
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="descripcion">
                            </div>
                            <div>
                                <label class="form-label">Nivel de dificultad</label>
                                <select name="dificultad">
                                    <option value="bajo">Bajo</option>
                                    <option value="medio">Medio</option>
                                    <option value="alto">Alto</option>

                                </select>
                            </div>
                            <div>
                                <label class="form-label">Seleccionar Imagen</label>
                                <input class="form-control" type="file" name="imagen">
                            </div>
                            <div>
                                <label class="form-label">Precio</label>
                                <input type="decimal" class="form-control" name="precio">
                            </div>
                            <div>
                                <label class="form-label">Categoria</label>
                                <input type="number" class="form-control" name="categoria">
                            </div>
                            <div class="mt-4 text-center mb-4">
                                <button class="btn btn-primary" type="submit">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-12">
                <p>Registrar Receta</p>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header mt-4">
                        <?php
                        include("receta.php");
                        ?>
                        <p>Receta</p>
                    </div>
                    <div class="body">
                        <form action="receta.php" method="post">
                            <div class="form-group">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" id="descripcion" class="form-control" name="descripcion">
                            </div>
                            <div class="form-group">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" id="id" class="form-control" name="id">
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Registrar Receta</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/25921e2f9d.js" crossorigin="anonymous"></script>
</body>

</html>