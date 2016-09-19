<?php
/**
 * Created by PhpStorm.
 * Date: 18-09-16
 * Time: 22:35
 */


include_once '../conexion/conectar.php';

//SE DEFINEN LAS CONEXIONES PARA LA BASE DE DATOS

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if(!$connection){
    //die('Not connected : ' . mysqli_error());
    echo -3;

}

mysqli_query($connection, "SET NAMES ut8");

$SQL = "SELECT * FROM ma_paises ";

$res = mysqli_query($connection, $SQL);
if(!$res){
    echo mysqli_error($connection);
}

$data = Array();

while ($row = mysqli_fetch_array($res)){
    $data[] = array(
        'id' => $row['id'],
        'pais' => $row['nombre'],
    );
}

echo var_dump($data);

echo json_encode($data, JSON_PRETTY_PRINT);

