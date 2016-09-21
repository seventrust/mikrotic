<?php

if(!@include("./conexion/conectar.php")) require_once "./conexion/conectar.php";

session_start();


function loadMenu(){

$connection=mysqli_connect (DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (!$connection) {
  die('Sin conexión : ' . mysqli_error());
}
//SE EFECTUA LA QUERY PARA CARGAR EL MENU DE ACUERDO AL PERFIL DEL USUARIO
mysqli_query($connection,"SET NAMES 'utf8'");

$SQL= "SELECT per_opc.idopcion,";
$SQL.="acor.code as code_acord,";
$SQL.="acor.tipo_acord,";
$SQL.="opc.idacordeon,";
$SQL.="opc.code as code_opc ";
$SQL.="FROM rl_perfil_opciones per_opc ";
$SQL.="INNER JOIN  ma_opciones opc on per_opc.idopcion=opc.idopcion ";
$SQL.="INNER JOIN ma_opciones_acordeon acor ON acor.idacordeon=opc.idacordeon ";
$SQL.="WHERE per_opc.idperfil=".$_SESSION["usrPerfil"]." AND ";
$SQL.="opc.opcionversion = 1 ";
$SQL.="ORDER BY opc.idacordeon ASC,";
$SQL.="per_opc.idopcion ASC";

$result = mysqli_query($connection,$SQL);

$data = "<ul class='sidebar-menu'>";

$itemsMenu=array();

while($row = mysqli_fetch_assoc($result)){$itemsMenu[] = $row;}
 
/***********************************************************************/


$ultAcord = -1;


for ($i = 0; $i < count($itemsMenu); ++$i) {
    if($ultAcord != $itemsMenu[$i]['idacordeon']){
        $data .=  $itemsMenu[$i]['code_acord'];
        $ultAcord = $itemsMenu[$i]['idacordeon'];
    }

    $data .= $itemsMenu[$i]['code_opc'];

    if ($itemsMenu[$i]['tipo_acord'] == 1 && $itemsMenu[$i+1]['idacordeon'] != $itemsMenu[$i]['idacordeon']) $data .= "</ul>";

    if($itemsMenu[$i+1]['idacordeon'] != $itemsMenu[$i]['idacordeon']) $data .= "</li>";

    }

   $data .= "</ul>";
   return $data;

 $result -> free();
 mysqli_close($connection);

}


/*
function loadUsr(){

 return $_SESSION["usrNombre"];

}

function loadActivity() {
    return $_SESSION['ultFecha'];
}

function loadHora(){
    return $_SESSION['ultHora'];
}

function loadPerfil(){
    return $_SESSION['perfilDesc'];
}*/
