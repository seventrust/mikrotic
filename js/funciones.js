/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    $('.select2').select2();
    
    $('.message a').click(function(){
        $('form').animate(
                {
                    height: "toggle", 
                    opacity: "toggle"
                }, 
                "slow");
    });
    
    $('#1').click(function(){
       $('#contenido').load('./page/conex.php', {}, function(msg){});
    });
    
    
    $('#contenido').on('click', '.sesion', function(){
        
        var usuario = $('#usuario').val();
        var pass = $('#pass').val();
        var ip = $('#ip').val();
        $.ajax({
           url: './page/conexion.php',
           type: 'POST',
           dataType: 'html',
           data:{
               usuario: usuario,
               pass: pass,
               ip: ip
               
           },
           beforeSend: function(){
                $('#contenido').html('');
                $('#contenido').html('ESPERE POR FAVOR....');
           },
           success: function(data){
               
               $('#contenido').html(data);
           }
           
        });
    });
    
});
//INICIO DE SESION
$('#login').click(function () {

    var usuario = $('#usuario').val();
    var pass = $('#password').val();
    
    $.ajax({
        url: './page/sesion/control.php',
        type: 'POST',
        dataType: 'text',
        data:{
            usuario: usuario,
            pass: pass
        },
        beforeSend: function () {
            $('#container').html('<img src="./img/init_sesion.gif" />');
        },

        success: function (data) {

            switch (data){
                case '1':
                    window.location = './panel.php';

                    alert("ESTA FUE LA OPCION");
                    confirm("ESTAS SEGURO?");

                    new PNotify({
                        title: 'Error',
                        text: 'LO que si es verga',
                        type: 'error'
                    });

                    break;
                case '-2':

                    new PNotify({
                        title: 'Error',
                        text: 'El usuario o la contraseña no son correctos',
                        type: 'error'
                    });
                    break;
                default:
                    break;
            }
        },


    });

});




