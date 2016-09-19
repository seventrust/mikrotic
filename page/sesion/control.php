<?php
/**
 * Date: 18-09-16
 * Time: 17:55
 */


include_once '../../conexion/conectar.php';

//SE DEFINEN LAS CONEXIONES PARA LA BASE DE DATOS

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$usuario = strtolower(htmlentities($_POST['usuario'], ENT_QUOTES));
$pass = $_POST['pass'];

if(!$connection){
    //die('Not connected : ' . mysqli_error());
    echo -3;

}

mysqli_query($connection, "SET NAMES ut8");

$usuario = mysqli_real_escape_string($connection,$usuario);
$pass = mysqli_real_escape_string($connection,$pass);

$SQL = "SELECT * FROM ma_usuarios WHERE usualogin = '$usuario' AND usuapass = '$pass' ";

$resultado = mysqli_query($connection, $SQL);
if(!$resultado){
    echo -2;
    //echo "EL ERROR -> ".mysqli_error($connection);
}else{
    echo 1;
}