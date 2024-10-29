<?php
//SELECT `id`, `username`, `pass`, `nombre`, `apellidos`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1
$username=$_POST["username"];
$pass=$_POST["pass"];

$sql="SELECT `id`, `username`, `pass`, `nombre`, `apellidos`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1 ";
$sql.=" and `username`='".$username."'";
$sql.=" and `pass`='".$pass."'";

include("db.php");
$query=$mysqli->query($sql);
if($query->num_rows>0){
    //usuario valido
        $fila=$query->fetch_assoc();
        session_start();
        $_SESSION["username"]=$fila["username"]; 
        $_SESSION["nombre"]=$fila["nombre"]; 
        $_SESSION["apellidos"]=$fila["apellidos"]; 
        $_SESSION["email"]=$fila["email"]; 
        $_SESSION["valido"]="1";
        //header("location:index.php");
    echo 1;
}else{
    //usuario o contraseña no son correctos
    //header("location:login.php");
    echo 0;
}
?>