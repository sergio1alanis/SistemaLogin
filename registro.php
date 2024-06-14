<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include("conexion.php");
    $errores= array();
    $success=false;
   
    $nombres=(isset($_POST['nombres']))? $_POST['nombres']:null;
    $apellidos=(isset($_POST['apellidos']))? $_POST['apellidos']:null;
    $email=(isset($_POST['email']))? $_POST['email']:null;
    $password=(isset($_POST['password']))?  $_POST['password']:null;
    $genero=(isset($_POST['genero']))? $_POST['genero']:null;
    $curso=(isset($_POST['curso']))? $_POST['curso']:null;
    $confirmarPassword=(isset($_POST['confirmarPassword']))? $_POST['confirmarPassword']:null;


    if(empty($nombres)){
        $errores['nombres'] = "El campo nombres es obligatorio";
    }
    if(empty($apellidos)){
        $errores['apellidos'] = "El campo apellidos es obligatorio";
    }
    if(empty($genero)){
        $errores['genero'] = "El campo genero es obligatorio";
    }
    if(empty($curso)){
        $errores['curso'] = "El campo curso es obligatorio";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errores['email'] ='El campo email es obligatorio';
        
        
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email'] ="El formato de email es incorrecto";
    }

    if(empty($password)){
        $errores['password']="El campo password es obligatorio";
    }

    if(empty($confirmarPassword)){
        $errores['confirmarPassword']="Debes confirmar password es obligatorio";
    }elseif($password != $confirmarPassword){
        $errores['confirmarPassword']="Las contraseñas no coinciden";
    }

    foreach($errores as $error){
        echo "<p style='color:red'>".$error."</p>";
    }
    

    if(empty($errores)){
    try    
    {
        // DSN  data source name asi se llame esta sentencia
        $pdo=new PDO('mysql:host='.$direccionservidor.';dbname='.$baseDatos,$usuarioBD,$contraseniaBD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//para que PDO maneje errores de forma automatica

        $nuevoPassword=password_hash($password,PASSWORD_DEFAULT);
       
       
       $sql = "INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `password`, `genero`, `curso`) 
        VALUES (NULL,:nombres,:apellidos,:email,:password,:genero,:curso);";

        $resultado=$pdo->prepare($sql);
        $resultado->execute(array(
            ':nombres'=>$nombres,
            ':apellidos'=>$apellidos,
            ':email'=>$email,
            ':password'=>$nuevoPassword,
            ':genero'=>$genero,
            ':curso'=>$curso
        ));
        //header("Location:login.html");
        $success = true;
    }
    catch(PDOException $e)   {
    echo "Error en la conexion: " . $e->getMessage();
    }

    }
    else{
       echo "No se han registrado los datos";
     }
    
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8">

                <?php if(isset($success)){ ?>  

                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <strong>Registro exitoso!</strong> Puede loguearse ahora en el siguiente enlace:
                        <a href="login.html" class="btn btn-success">Login</a>
                    </div>
                <?php } ?>


                    <div class="card">
                        <div class="card-header">Formulario de registro</div>
                        <div class="card-body">

                            <form action="registro.php" id="formularioderegistro" method="post">

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="nombres" class="form-label">Nombres:</label>
                                            <input type="text" class="form-control" id="nombres" name="nombres" required />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="apellidos" class="form-label">Apellidos:</label>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos" required/>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" required/>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Contraseña:</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="" required/>
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="confirmarPassword" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" name="confirmarPassword" id="confirmarPassword" placeholder="" required/>
                                            <div class="invalid-feedback">
                                                Las contraseñas no coinciden
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="genero" class="form-label">Género:</label>
                                        <select class="form-select" name="genero" id="genero" required>
                                            <option value="">Seleccione Genero</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="curso" class="form-label">Curso de interes:</label>
                                        <select class="form-select" name="curso" id="curso" required>
                                            <option value="">Seleccione Curso</option>
                                            <option value="desarrolloweb">Desarrollo Web</option>
                                            <option value="diseñografico">Diseño Grafico</option>
                                            <option value="marketingdigital">Marketing Digital</option>
                                            <option value="php">PHP</option>
                                            <option value="javascript">Javascript</option>
                                            <option value="python">Python</option>
                                            <option value="java">Java</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Registrarme</button>
                                <a href="login.html" class="btn btn-secondary">Login</a>

                            </form>

                        </div>
                        <div class="card-footer text-muted"></div>
                    </div>

                </div>

            </div>
        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js " integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r " crossorigin="anonymous "></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js " integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+ " crossorigin="anonymous "></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('formularioderegistro').addEventListener('submit', function(event) {
                var password = document.getElementById("password").value;
                var confirmarPassword = document.getElementById("confirmarPassword").value;
                if (password !== confirmarPassword) {
                    document.getElementById('confirmarPassword').classList.add('is-invalid');
                    event.preventDefault();

                } else {
                    document.getElementById('confirmarPassword').classList.remove('is-invalid');
                }
            });

        });
    </script>

</body>

</html>
