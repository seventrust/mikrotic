/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){


    $('#password').click(function (event) {
        event.preventDefault;
    });
    
    $('.message a').click(function(){
        $('form').animate(
                {
                    height: "toggle", 
                    opacity: "toggle"
                }, 
                "slow");
    });

    $('#paises').load('./scripts/getPaises.php', {}, function (msg) {

    })
    
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
                    case '-3':
                        new PNotify({
                            title: 'Error',
                            text: 'Ya Existe una sesión del usuario ingresado',
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

$(document).on('click', '#crearUsuario', function () {
    var nombre = $('#nombre').val();
    var apellidomat = $('#apellidomat').val();
    var apellidopat = $('#apellidopat').val();
    var pais = $('#paises').val();
    var usualogin = $('#usualogin').val();
    var pass = $('#password').val();
    var correo = $('#correo').val();
    var dni = $('#dni').val();

    if(nombre == "" || apellidomat == "" || apellidopat == "" || pais == "" || pass=="" || correo == "" || usualogin == "" || dni == ""){
        alert("Por favor ingrese todos los datos solicitados");
    }else{
        if(pais == null){
            alert("No ha seleccionado un país de la lista");
        }else{
            $.ajax({
                url: './page/sesion/registro.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    nombre : nombre,
                    apellidomat : apellidomat,
                    apellidopat : apellidopat,
                    pais : pais,
                    dni : dni,
                    usualogin : usualogin,
                    pass : pass,
                    correo : correo
                },
                beforeSend: function () {
                    $('#container').html("<img src='./img/init_sesion.gif' >");
                },
                success: function (data) {
                    switch (data){
                        case '1':
                            new PNotify({
                                title: 'Éxito',
                                text: 'El usuario ha sido creado satisfactoriamente',
                                type: 'success'
                            });
                            break;
                        case '-2':
                            new PNotify({
                                title: 'Alerta',
                                text: 'Usuario creado anteriormente, vuelva a intentar',
                                type: 'alert'
                            });
                            break;

                        default:
                            break;
                    }
                }
            });
        }
    }

});




