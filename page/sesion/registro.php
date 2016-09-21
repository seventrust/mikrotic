<?php

include_once '../conexion/conectar.php';

//SE DEFINEN LAS CONEXIONES PARA LA BASE DE DATOS

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

mysqli_query($connection, "SET NAMES ut8");

$nombre = $_POST['nombre'];
$apellidopat = $_POST['apellidopat'];
$apellidomat = $_POST['apellidomat'];
$correo = $_POST['correo'];
$usualogin = $_POST['usualogin'];
$pass = $_POST['pass'];
$pais = $_POST['pais'];
$rut = $_POST['dni'];

$nombre = mysqli_real_escape_string($connection,$nombre);
$usualogin = mysqli_real_escape_string($connection,$usualogin);
$apellidopat = mysqli_real_escape_string($connection,$apellidopat);
$apellidomat = mysqli_real_escape_string($connection,$apellidomat);
$correo = mysqli_real_escape_string($connection,$correo);

//TODO:
//VALIDAR LA EXISTENCIA DE UN USUARIO

$SQL = "INSERT INTO ma_usuario (usualogin, usuapass, usuanombre, usuaapellidopat,
      usuapellidomat, usuadni, usuapais, usuacorreo, fecha_crea, version)
      VALUES($usualogin, SHA1($pass), $nombre, $apellidopat, $apellidomat, $rut,
      $pais, $correo, NOW(), 1)";

$result = mysqli_query($connection, $SQL);

$num = mysqli_affected_rows($result);

if($num >= 1){
    echo 1;
}else{
    echo -2;
}






