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

    $.ajax({
       url: './scripts/getPaises.php',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
           alert(data);
           var html = '';
            $.each(data, function (i, item) {
               html+='<option value='+item.id+' value='+item.pais+'></option>';
            });
            $('#paises').append(html);

        }
    });
    
});
//INICIO DE SESION
$(document).on('click', '#login', function () {

    var usuario = $('#usuario').val();
    var pass = $('#password').val();

    if(usuario == "" && pass == ""){
        alert("Los campos no pueden estar vacíos");
    }else {

        $.ajax({
            url: './page/sesion/control.php',
            type: 'POST',
            dataType: 'text',
            data: {
                usuario: usuario,
                pass: pass
            },
            beforeSend: function () {
                $('#container').html('<img src="./img/init_sesion.gif" />');
            },

            success: function (data) {
                $('#container').html('<img src="./img/init_sesion.gif" />');
                switch (data) {
                    case '1':
                        window.location = 'http://localhost/admin/panel.php';


                        new PNotify({
                            title: 'Error',
                            text: 'Lo que si es verga',
                            type: 'success'
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
    }

});

//REGISTRAR UN NUEVO USUARIO




