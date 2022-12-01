try {
    let serviceURL = "http://localhost:9091/servicio/registro.php";
    
    $(document).ready(function () {
        const miAjax = (url, datos, metodo, tipoDatos, hacer) => {
            $.ajax({
                url : url,
                data : datos,
                type : metodo,
                dataType : tipoDatos,
                success : function(data) {
                    hacer (data);
                },
                error : function(xhr, status) {
                    //alert('Disculpe, existió un problema');
                    alert (status);
                }
            });
        };
        
        $("#btnRegistrar").click(function() {
            document.getElementById("resultado").style.display = "none";
            document.getElementById("error").style.display = "none";
            //alert($("#fecha").val());
            let dni = $("#dni").val();
            let nombres = $("#nombres").val();
            let apellidos = $("#apellidos").val();
            let tipoSangre = $("#tipo_sangre").val();
            let cantidad = $("#cantidad").val();
            let fecha = $("#fecha").val();
            let metodo = 'POST';
            let tipoDatos = 'HTML';

            if (dni.length===0 || nombres.length===0 || apellidos.length===0 || tipoSangre.length===0 || cantidad.length===0) {
                document.getElementById("error").style.display = "block";
                $("#error").html("");
                $("#error").append("Ingrese todos los campos");
                return false;
            }
            let datos = {dni:dni, nombres:nombres, apellidos:apellidos, tipo_sangre:tipoSangre, cantidad_donacion_ml:cantidad, fecha_donacion:fecha};
            let hacer = (respuesta) => {
                document.getElementById("resultado").style.display = "block";
                $("#resultado").html("");
                $("#resultado").append(respuesta);
           };
           miAjax (serviceURL, datos, metodo, tipoDatos, hacer);
        });
        

        $("#btnListar1").click(function() {
            // Llamado al servicio por el métido GET sin parámetros, lo que devolverá toda la lista de personas registradas
            $.get(serviceURL, function(respuesta) {
                document.getElementById("formulario").style.display = "none";
                document.getElementById("panelLista").style.display = "inline";
                let data = JSON.parse(respuesta);

                // Construimos la tabla para visualizar
                let tbody = '';
                if (data.length === 0){
                    let tr = '<tr><td colspan="4" class="alert alert-danger text-center">No hay datos para mostrar</td></tr>';
                    tbody = tr;
                } else {
                    for (var item in data) {
                        let registro = data[item];
                        let tr = '<tr>';
                        let td = '<td id="id_persona">' + registro.id_persona + '</td>' +
                                '<td>' + registro.dni + '</td>' +
                                '<td>' + registro.apellidos + ' ' + registro.nombres + '</td>' +
                                '<td><button id="btnEditar" name="' + registro.id_persona + '" class="btn btn-outline-success btn-sm editar">Editar</button>' + 
                                '<button id="btnEliminar" name="' + registro.id_persona + 
                                '" class="btn btn-outline-danger btn-sm mx-xl-2 mx-lg-2 mx-md-2 mx-0 mt-xl-0 mt-lg-0 mt-md-0 mt-2 elimin">Eliminar' +
                                '</button></td></tr>';
                        tr += td;
                        tbody += tr; 
                    }
                }
                $("#contenido").html("");
                $("#contenido").html(tbody);
                eliminarRegistro();
                editarRegistro();
            });
        });
        

        function eliminarRegistro() {
            $("#contenido").on("click", "#btnEliminar", function() {
                let elemento = this;
                let id_persona = elemento.name;
                let metodo = 'DELETE';
                let tipoDatos = 'HTML';
                let datos = {'id_persona': id_persona};
                let hacer2 = (respuesta) => {
                    // Recibe una cadena de texto de confirmación, pero no hacemos nada con ella
               };
               miAjax (serviceURL, datos, metodo, tipoDatos, hacer2);
               // Eliminamos toda la fila de la tabla que está en pantalla
               $(elemento).parent().parent().remove();
            });
        };

        function editarRegistro() {
            $("#contenido").on("click", "#btnEditar", function() {
                document.getElementById("formulario").style.display = "block";
                document.getElementById("panelLista").style.display = "none";
                document.getElementById("resultado").style.display = "none";
                document.getElementById("error").style.display = "none";
                document.getElementById("panelRegistrar").style.display = "none";
                document.getElementById("panelModificar").style.display = "block";
                
                // BLOQUE PARA CONSULTAR EN LA BD LOS DATOS DE LA PERSONA A MODIFICAR 
                let elemento = this;
                let id_persona = elemento.name;
                let metodo = 'GET';
                let tipoDatos = 'HTML';
                let datos = {'id_persona':id_persona};
                let hacer3 = (respuesta) => {
                    let data = JSON.parse(respuesta);
                    $("#dni").val(data[0].dni);
                    $("#nombres").val(data[0].nombres);
                    $("#apellidos").val(data[0].apellidos);
                    $("#tipo_sangre").val(data[0].tipo_sangre);
                    $("#cantidad").val(data[0].cantidad_donacion_ml);
                    $("#fecha").val(data[0].fecha_donacion);
               };
               miAjax (serviceURL, datos, metodo, tipoDatos, hacer3);
               grabarRegistroEditado(id_persona);               
            });
        };
        

        function grabarRegistroEditado(id_persona) {
            $("#formulario").on("click", "#btnModificar", function() {
               // BLOQUE PARA GRABAR EN LA BD LOS DATOS MODIFICADOS POR EL USUARIO 
                let dni = $("#dni").val();
                let nombres = $("#nombres").val();
                let apellidos = $("#apellidos").val();
                let tipoSangre = $("#tipo_sangre").val();
                let cantidad = $("#cantidad").val();
                let fecha = $("#fecha").val();

                if (dni.length===0 || nombres.length===0 || apellidos.length===0 || tipoSangre.length===0 || cantidad.length===0) {
                    document.getElementById("error").style.display = "block";
                    $("#error").html("");
                    $("#error").append("Ingrese todos los campos");
                    return false;
                }
                let metodo = 'PUT';
                let tipoDatos = 'HTML';
                let datos = {id_persona:id_persona, dni:dni, nombres:encodeURIComponent(nombres), apellidos:encodeURIComponent(apellidos), tipo_sangre:tipoSangre, cantidad_donacion_ml:cantidad, fecha_donacion:fecha};
                let hacer4 = (respuesta) => {
                    document.getElementById("resultado").style.display = "block";
                    $("#resultado").html("");
                    $("#resultado").append(respuesta);
                };
                miAjax (serviceURL, datos, metodo, tipoDatos, hacer4);
                cancelarEdicion();
                document.getElementById("panelRegistrar").style.display = "block";
                document.getElementById("panelModificar").style.display = "none";
            });
        };

        
        
        $("#btnNuevo").click(function() {
            document.getElementById("formulario").style.display = "block";
            document.getElementById("panelLista").style.display = "none";
            document.getElementById("resultado").style.display = "none";
            document.getElementById("error").style.display = "none";
            document.getElementById("panelRegistrar").style.display = "block";
            document.getElementById("panelModificar").style.display = "none";
            $("#dni").val("");
            $("#nombres").val("");
            $("#apellidos").val("");
            $("#tipo_sangre").val("");
            $("#cantidad").val("");
            $("#fecha").val("");
        });

        
        function cancelarEdicion () {
            $("#formulario").on("click", "#btnCancelar", function() {
                document.getElementById("formulario").style.display = "block";
                document.getElementById("panelLista").style.display = "none";
                document.getElementById("resultado").style.display = "none";
                document.getElementById("error").style.display = "none";
                document.getElementById("panelRegistrar").style.display = "block";
                document.getElementById("panelModificar").style.display = "none";
                $("#dni").val("");
                $("#nombres").val("");
                $("#apellidos").val("");
                $("#tipo_sangre").val("");
                $("#cantidad").val("");
                $("#fecha").val("");
            });
        }
        
       
        
    });
} catch (e) {
    
}

