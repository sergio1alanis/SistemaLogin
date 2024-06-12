<?php
include("conexion.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $errores= array();

   
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

        $sql = "INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `password`, `genero`, `curso`) 
        VALUES (NULL,:nombres,:apellidos,:email,:password,:genero,:curso);";

        $resultado=$pdo->prepare($sql);
        $resultado->execute(array(
            ':nombres'=>$nombres,
            ':apellidos'=>$apellidos,
            ':email'=>$email,
            ':password'=>$password,
            ':genero'=>$genero,
            ':curso'=>$curso
        ));
        header("Location:login.html");
    }
    catch(PDOException $e)   {
    echo "Error en la conexion: " . $e->getMessage();
    }

    }
    else{
        echo "<a href='registro.html'>Regresar al registro</a>";
    }
    
}
