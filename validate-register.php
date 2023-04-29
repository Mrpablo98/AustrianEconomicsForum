<?php 
extract($_POST);
$error=false;

if(!isset($username) || strlen($username) < 6){
    $error=true;
    
}
if(!isset($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    $error=true;
}  
if(!isset($password) || strlen($password) < 6){
    $error=true;
   
}
if(!isset($Rpassword) || $password != $Rpassword){
    $error=true;
    
}


$server="localhost";
$usernamebd="root";
$password="root";
$db="austrianeconomicsforum";



if(!$error){

    $mysqli=new mysqli($server,$usernamebd,$password,$db);
    if($mysqli->connect_error){
        die("Error de conexion".$mysqli->connect_error);
    }else{
        $password_hash=password_hash($password, PASSWORD_DEFAULT);
        $sql=$mysqli->prepare("INSERT INTO usuarios (nombre,email,password_hash,fecha_registro) VALUES (?,?,?,?)");
        if ($sql === false) {
            die("Error preparing statement: " . $mysqli->error);
        }
        $fecha_registro=date("Y-m-d H:i:s");
        $sql->bind_param("ssss",$username,$email,$password_hash,$fecha_registro);
        if($sql->execute()==false){
            echo "Error al ejecutar la consulta".$sql->error;
        }else{
            echo "Usuario registrado correctamente";
        }
    }
}

?>