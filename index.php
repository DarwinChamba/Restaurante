<?php

if(isset($_SESSION['nombre'])){
    unset($_SESSION['nombre']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAS DELICIAS DE RIO - Restaurante</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/styles.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand btn btn-danger im" href="#"><i class="fa-solid fa-mug-hot"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" aria-disabled="true">Iniciar sesion</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    
                    <button class="btn btn-outline-success" type="submit"><a class="registarte" href="registrarUsuario.php">Registrate</a></button>
                </form>
            </div>
        </div>
    </nav>
    <div class="fondo">
        <div class="contenido">
            <h2>Restaurante</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, repudiandae.</p>
            <div class="text-center">
                <a href="registrarUsuario.php" class="btn btn-danger">Registrate !!</a>
            </div>
        </div>
    </div>


    <div class="informacion">
        <h2>Bienvenidos a LAS DELICIAS DE RIO</h2>
        <p>Disfrute de la mejor comida en Riobamba. Nuestro menú ofrece una variedad de platos deliciosos preparados con los ingredientes más frescos.</p>

    </div>
    <div class="container">
        <div class="row justify-content-center border mb-4">
            <div class="col m">
                <img src="./imagenes/img1.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img2.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img3.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img4.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img5.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img6.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img7.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img8.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img9.jpg" alt="" width="211px" height="200px">
                <img src="./imagenes/img10.jpg" alt="" width="211px" height="200px">
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="./imagenes/res_footer.svg" alt="Logo" />
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Servicios</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <a href="#" class="social-icon"><i class="fa-brands fa-facebook" style="color: #B197FC;"></i></a>
                <a href="#" class="social-icon"><i class="fa-brands fa-twitter" style="color: #B197FC;"></i></a>
                <a href="#" class="social-icon"><i class="fa-brands fa-linkedin" style="color: #B197FC;"></i></a>
                <a href="#" class="social-icon"><i class="fa-brands fa-square-instagram" style="color: #B197FC;"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/25921e2f9d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>