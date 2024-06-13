<?php


if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("conexion.php");
    $errores= array();
   // print_r($_POST);

    $email=(isset($_POST['email']))?htmlspecialchars($_POST['email']):null;
    $password=(isset($_POST['password']))?htmlspecialchars($_POST['password']):null;

    if(empty($email)){
        $errores['email']="El email es obligatorio";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email']="El formato es incorrecto";
    }
    if(empty($password)){
        $errores['password']="La contraseña es obligatoria";
    }

    if(empty($errores)){ 

        try{
            $pdo=new PDO('mysql:host='.$direccionservidor.';dbname='.$baseDatos,$usuarioBD,$contraseniaBD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql="SELECT * FROM usuarios WHERE email=:email";
            $stmt=$pdo->prepare($sql);
            $stmt->execute(['email'=>$email]);

            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($usuarios);

            $login = false;

            foreach($usuarios as $user){
                if(password_verify($password, $user['password'])){
                    //$_SESSION['loggedUser']=$user;
                    $login = true;
                }
            }
        if($login){
            echo "Existe el usuario en la BD";
            header("Location:index.php");
        } else{
            echo "No existe el ususari en la BD";
        }
        
        }catch(PDOException $e){
            echo $e;
        }
    }else{
        foreach($errores as $error){
            echo $error."</br>";
        }
        echo "<br/><a href='login.html'>Regresar al login</a>";
    }

}