<?php 
include "conexion.php";

/* Detectamos que método usa la petición del cliente */
$method = $_SERVER['REQUEST_METHOD']; 

switch ($method) { 
    
    /* El método POST se usa para INSERTAR un registro en la Base de Datos */
    case 'POST': 
        $base =  new conexion();
        $dni=$_POST['dni'];
        $nombres=$_POST['nombres'];
        $apellidos=$_POST['apellidos'];
        $tipo_sangre=$_POST['tipo_sangre'];
        $cantidad_donacion_ml=$_POST['cantidad_donacion_ml'];
        $fecha_donacion=$_POST['fecha_donacion'];
        $mensaje = "";
        if ($dni!=null && $apellidos!=null && $nombres!=null) {
            $base->sql="INSERT INTO personas (dni,nombres,apellidos,tipo_sangre,cantidad_donacion_ml,fecha_donacion)
                VALUES ('$dni','$nombres','$apellidos','$tipo_sangre','$cantidad_donacion_ml','$fecha_donacion')";
            $base->res = mysqli_query ($base->conector,$base->sql);
            $filas = mysqli_affected_rows($base->conector);
            if ($filas > 0) { 
                $mensaje = "Usuario registrado";
            } else {
                $mensaje = "Usuario No se pudo registrar";
            }
        } else {
            $mensaje = "Ingrese los datos completos";
        } 
        $base->cerrar();
        echo (json_encode($mensaje));
        break; 
        
        
    /* el método GET se usa para LISTAR los registros guardados en la Base de Datos, retorna una lista en formato JSON*/
    case 'GET': 
        $base =  new conexion();
        //$mensaje = "";
        if (isset($_GET['id_persona'])) {
            $id_persona = $_GET['id_persona'];
            $base->sql = "SELECT * FROM personas WHERE id_persona='$id_persona'";
            //$mensaje = $base->sql;
            $base->res = mysqli_query($base->conector,$base->sql);
        } else {
            $base->sql = "SELECT * FROM personas";
            $base->res = mysqli_query ($base->conector, $base->sql);
        }
        $filas = mysqli_affected_rows($base->conector);
        $lista = [];

        if ($filas > 0) {
            while ($registro = mysqli_fetch_row ($base->res)) {
                $persona = [];
                $persona['id_persona'] = $registro[0];
                $persona['dni']        = $registro[1];
                $persona['nombres']    = $registro[2];
                $persona['apellidos']  = $registro[3];
                $persona['tipo_sangre']  = $registro[4];
                $persona['cantidad_donacion_ml']  = $registro[5];
                $persona['fecha_donacion']  = $registro[6];
                $lista[] = $persona;
            }
        } else {
        }
        echo (json_encode($lista));
        $base->cerrar();
        break; 

        
    /* el método PUT se usa para MODIFICAR un registro de la Base de Datos */
    case 'PUT': 
        $base =  new conexion();
        $data = file_get_contents('php://input');
        $datos = explode("&", $data);
        $id = $datos[0];
        $dni = $datos[1];
        $nombres = cadena(urldecode($datos[2]));
        $apellidos = cadena(urldecode($datos[3]));
        $tipo_sangre = cadena(urldecode($datos[4]));
        $cantidad_donacion_ml = cadena(urldecode($datos[5]));
        $fecha_donacion = cadena(urldecode($datos[6]));
        $mensaje = "";

        if($datos[1]!=null && $datos[2]!=null && $datos[3]!=null&& $datos[4]!=null&& $datos[5]!=null) {
            $base->sql = 'UPDATE personas SET '.$dni.', '.$nombres.', '.$apellidos.', '.$tipo_sangre.', '.$cantidad_donacion_ml.', '.$fecha_donacion.' WHERE '.$id;
            $base->res=mysqli_query($base->conector,$base->sql);
            $filas = mysqli_affected_rows($base->conector);
            if ($filas > 0) {  
                $mensaje = "Usuario Modificado";
            } else {
                $mensaje = "Usuario No se pudo modificar";
            }
        } else {
            $mensaje = "Ingrese los datos correctos";
        } 
        echo (json_encode($mensaje));
        $base->cerrar();
        break; 

        
    /* el método DELETE se usa para ELIMINAR un registro de la Base de Datos */
    case 'DELETE': 
        $base = new conexion();
        $mensaje = "";
        // Obtenemos el id de la persona de los parámetros de entrada de la petición
        $id_persona = file_get_contents('php://input');
        if(isset($id_persona)) {
            $base->sql = "DELETE FROM personas WHERE ".$id_persona;
            $base->res = mysqli_query ($base->conector, $base->sql);
            $filas = mysqli_affected_rows($base->conector);
            if ($filas > 0) {
                $mensaje= "Registro eliminado";
            } else {
                $mensaje= "No se eliminó el registro" + $id_persona;
            }
        } else {
            $mensaje = "No se eliminó el registro" + $id_persona;
        }
        $base->cerrar();
        echo (json_encode($mensaje));
        break; 
}

function cadena ($cadena) {
    $cad = str_replace("=", "='", $cadena);
    $cad = str_replace("%20", " ", $cad);
    $cad = $cad."'";
    return $cad;
}

?>