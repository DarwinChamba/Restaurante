<?php
session_start();
require_once 'db_connection.php';

if (isset($_SESSION['nombreLogin'])) {
    // Redirigir al usuario a la página correspondiente según su rol
    if ($_SESSION['rol'] == 'admin') {
        header("Location: admin.php");
        exit();
    } elseif ($_SESSION['rol'] == 'cliente') {
        header("Location: cliente.php");
        exit();
    } elseif ($_SESSION['rol'] == 'empleado') {
        header("Location: empleado.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = (isset($_POST['email'])) ? $_POST['email'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";
    $errores = array();

    if (empty($email)) {
        $errores['email'] = "Debes ingresar un correo electrónico";
    }
    if (empty($password)) {
        $errores['password'] = "Debes ingresar una contraseña";
    }

    if (empty($errores)) {
        $sql = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $resultado = $sql->get_result();
        $usuario = $resultado->fetch_object();

        if ($usuario && $password == $usuario->password) {
            $_SESSION['nombreLogin'] = $usuario->nombre; // Asumiendo que hay una columna 'nombre' en la tabla usuarios
            $_SESSION['rol'] = $usuario->rol;

            switch ($usuario->rol) {
                case 'admin':
                    header("Location: admin.php");
                    break;
                case 'cliente':
                    header("Location: cliente.php");
                    break;
                case 'empleado':
                    header("Location: empleado.php");
                    break;
            }
            exit();
        } else {
            echo "El usuario no existe o la contraseña es incorrecta";
        }
    } else {
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - LAS DELICIAS DE RIO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/login.css">

</head>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header>
                    <h1 class="text-center">Iniciar Sesión - LAS DELICIAS DE RIO</h1>
                </header>
            </div>
            <div class="col-12">

                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand btn btn-danger" href="#"><i class="fa-solid fa-utensils"></i></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="menu.php">Menu</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php" aria-disabled="true">Iniciar sesion</a>
                                </li>
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>

        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Iniciar Sesión</h2>
                    </div>
                    <div class="card-body">
                        
                        <form action="login.php" method="post">
                            <div>
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Correo electrónico" required>
                            </div>
                            <div>
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="mt-4 text-center">
                                <input class="btn btn-secondary" type="submit" value="Iniciar Sesión">
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