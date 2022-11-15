<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/estilo.css">
    <link href="style/estiloLista.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Registro de Personas</title>
    <script src="js/jquery-3.6.0.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</head>

<body>
    <div class="container mt-4" id="formulario" style="display: block">
    <div class="row justify-content-center">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12">
    <div class="card">

    <div class="card-header bg-danger text-white">
        <span><strong>Registro</strong></span>      
    </div>  
   
    <!-- Formulario para ingresar los datos de un usuario -->
    <form id="formRegistrar" enctype="multipart/form-data">
        <!-- Panel de datos -->
        <div class="card-body">
        <div class="row">
            <div class="form-group">
                <label>NÚMERO IDENTIFICACIÓN</label>
                <input type="text" id="dni" name="dni" class="form-control" placeholder="Ingrese su número de identificación" required/>
            </div>  
            <div class="form-group">
                <label>APELLIDOS</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese sus apellidos.." required/>
            </div>  
            <div class="form-group">
                <label>NOMBRES</label>
                <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ingrese sus nombres..." required/>
            </div>
            <div class="form-group">
                <label>Tipo de Sangre</label>
                <input type="text" id="tipo_sangre" name="tipo_sangre" class="form-control" placeholder="Ingrese su tipo de sangre..." required/>
            </div> 
            <div class="form-group">
                <label>Cantidad Donada</label>
                <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese la cantidad donada..." required/>
            </div> 
            <div class="form-group">
                <label>Fecha de Donación</label><br>
                <input type="date" id="fecha" name="fecha" style="font-family: Maiandra GD" Required/>
            </div>  
        </div>
        </div>
        
        <!-- Panel de botones para grabar -->
        <div class="card-footer">
        <div class="row justify-content-center" id="panelRegistrar" >
            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-4 col-4">
                <input type="button" id="btnRegistrar" name="btnRegistrar" class="btn btn-outline-success" value="Registrar"/>
            </div>
            <div class="col-xl-5 col-lg-7 col-md-6 col-sm-5 col-6 ">
                <input type="button" id="btnListar1" name="btnListar1" class="btn btn-outline-success" value="Ver registros"/>
            </div>
        </div>
             
        <!-- Panel de botones para modificar -->
        <div class="row justify-content-center" id="panelModificar" style="display:none">
            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-4 col-4">
                <input type="button" id="btnModificar" name="btnModifcar" class="btn btn-outline-success" value="Modificar">
            </div>
            <div class="col-xl-5 col-lg-7 col-md-6 col-sm-5 col-6 ">
                <input type="button" id="btnCancelar" name="btnCancelar" class="btn btn-outline-success" value="Cancelar">
            </div>
        </div>

        <!-- Panel para mostrar respuestas del servidor -->
        <div class="mt-2 text-center">
            <h2 class="alert alert-success" id="resultado" style="display: none"></h2>  
            <h2 class="alert alert-danger" id="error"  style="display: none"></h2>  
        </div>  
        </div>
    </form>
    </div>  
    </div>  
    </div>
    </div>
    
    <!-- Panel para mostrar lista de usarios registrados -->
    <div class="container" id="panelLista" style="display: none">
    <div class="text-center">
        <h1><u>lista de Personas</u></h1>
    </div>
    <div class="mt-2">
    <div class="card">
    <div class="card-body">
    
    <!-- Encabezado de la tabla -->
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead class="text-center bg-danger text-white">
            <tr><th scope="col"><strong>ITEM</strong></th>
                <th scope="col"><strong>IDENTIFICACIÓN</strong></th>
                <th scope="col"><strong>PERSONA</strong></th>
                <th scope="col"><strong>ACCIÓN</strong></th>
            </tr></thead>
        <!-- Contenido de la tabla, se muestra de forma dinámica con Javascript -->
        <tbody id="contenido">
        </tbody>
        </table>

    </div>  
    </div>  
    <div class="card-body">
        <input type="button" id="btnNuevo" name="btnNuevo" class="btn btn-primary" value="Nuevo">
    </div>
    </div>  
    </div>  
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>
</html>