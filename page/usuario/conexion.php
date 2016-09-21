<?php
error_reporting(E_ALL);
ini_set('display_errors', E_ALL);
require_once '../includes/routeros_api.class1.6.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$login = $_POST['usuario'];
$password = $_POST['pass'];
$ip = $_POST['ip'];
$port = '8728';


$API = new routeros_api();

$API->debug = false;
if($API->connect($ip, $login, $password)){
    $ARRAY = $API->comm("/system/resource/print");
    $preArray = $ARRAY[0];
    
    $data = Array();
    $data[] = array(
      'cpu' =>  $preArray['cpu'],
      'cpuCount' => $preArray['cpu-count'],
      'totalMemory' => $preArray['total-memory'],
      'freeMemory'  => $preArray['free-memory']
    );
    
    $json = json_encode($data);
    
    
}else{
    
    echo "NO ME ESTOY CONECTANDO";
}
    ?>

<script type="text/javascript">
var espanol = {
        "sProcessing":     "&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/ajax-loader-mini.gif' border='0' />",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Del _START_ al _END_ | Total _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ".",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };
    
    var tablas = $('#informacion').DataTable(
    {
        dom: 'Bfrtip',
        oLanguage: espanol,
        bDestroy : true,
        bRetrieve: true,
        bFilter : true,
        iDisplayLength: 5,
        //bSort : true,
        order: [],
        bLengthChange : true,
        bPaginate : true,
        bAutoWidth: false,
        sDom: '<"H"flr<"contenedor">>t<"F"ip>',
        bDeferRender : true,

    });
</script>

<section>
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3><i class="fa fa-home"></i>&nbsp;Información Importante</h3>
            </div>
            <div class="box-body table-responsive">
                <table id="informacion" class="table table-bordered striped">
                    <thead>
                        <tr>
                            <th>Modelo del CPU</th>
                            <th>Numero de Procesadores</th>
                            <th>Total RAM</th>
                            <th>RAM Libre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($data as $value) {
                            ?>
                            <td><?=$value->cpu?></td>
                            <td><?=$value->cpuCount?></td>
                            <td><?=$value->totalMemory?></td>
                            <td><?=$value->freeMemory?></td>
                            <?php
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



