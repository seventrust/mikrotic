<?php
/**
 * Date: 18-09-16
 * Time: 17:55
 */


include_once '../../conexion/conectar.php';

//SE DEFINEN LAS CONEXIONES PARA LA BASE DE DATOS

session_start();

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$usuario = strtolower(htmlentities($_POST['usuario'], ENT_QUOTES));
$pass = $_POST['pass'];

$pass = sha1($pass);

if(!$connection){
    //die('Not connected : ' . mysqli_error());
    echo -3;

}

mysqli_query($connection, "SET NAMES ut8");

$usuario = mysqli_real_escape_string($connection,$usuario);
$pass = mysqli_real_escape_string($connection,$pass);

$SQL = "SELECT a.id, a.usuanombre, a.usuapellidopat, a.usuaperfil, b.nombre
FROM ma_usuarios a
INNER JOIN ma_paises b ON a.usuapais = b.id
 WHERE usualogin = '$usuario' AND usuapass = '$pass' ";



$resultado = mysqli_query($connection, $SQL);
if(!$resultado){
    echo -2;
    //echo "EL ERROR -> ".mysqli_error($connection);
}else{
    while($row = mysqli_fetch_array($resultado)){
        $usuario = $row['usuanombre'];
        $apellido = $row['usuapellidopat'];
        $usuaPerfil = $row['usuaperfil'];
        $pais = $row['nombre'];
        $id_user = $row['id'];
        $sesion = (string)session_id();
    }

    llenar_sesion($connection, $usuario, $id_user, $usuaPerfil, $apellido, $pais, $sesion);

    echo 1;
}

function llenar_sesion($con, $u, $i, $up, $a, $p, $s){
    $_SESSION['usuario'] = $u;
    $_SESSION['apellido'] = $a;
    $_SESSION['pais'] = $p;
    $_SESSION['sesion_id'] = $s;
    $_SESSION['usrPerfil'] = $up;

    $sql = "SELECT id_sesion FROM ma_usuarios WHERE usuanombre = $u";

    $result = mysqli_query($con, $sql);

    $count = mysqli_num_rows($result);
    if($count > 1){
        destroySesion();
    }else {
        mysqli_query($con, "UPDATE ma_usuarios SET id_sesion = '$s' WHERE id = '$i' ");
    }
}

function destroySesion(){
    echo -3;
}