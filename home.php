<?php
include_once('bd/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, titulo, contenido FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
    session_start();
    if (isset($_SESSION['Id']) && isset($_SESSION['NombreUsuario'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>Inicio Organizador de Tareas</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
     
    
     <!--para las alertas --><!-- Agrega esto en el encabezado de tu HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

    
     <!-- Metadatos de la barra -->
    <link rel="stylesheet" href="css/estilos.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Trocchi&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Trocchi&display=swap" rel="stylesheet">
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       
  </head>
    

<body>
    <header>
    <nav>
            <ul>
                <div id="nav-left">
                    <li><a href="configuraciones.html"><img src="img/settings.png">  </li></a>
                </div>
                <div id="nav-right">
                    <li><a href="home.php">Inicio</a></li>
                    <li><a href="perfil.php">Perfil</a></li>

                   <li> <a href="Login/CerrarSesion.php">Cerrar Sesion</a></li>
                </div>

            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" ">
                <button id='btnNuevo' class="btn btn-secondary" type="button" data-toggle="modal" style="margin-bottom: 30px; margin-top: 30px;">
                    Nuevo
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12"   style="margin-bottom: 250px;">
                <div class="table-responsive">
                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                        style="width:100% ">
                        <thead class="text-center">
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Contenido</th>
                            <th>Acciones</th>

                        </thead>
                        <tbody>
                        <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['titulo'] ?></td>
                                <td><?php echo $dat['contenido'] ?></td>
                                
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?> 
                        

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
<!--Modal para el crud--->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo:</label>
                <input type="text" autocomplete="off" class="form-control" id="titulo">
                </div>
                <div class="form-group">
                <label for="contenido" class="col-form-label">Contenido:</label>
                <input type="text" autocomplete="off" class="form-control" id="contenido">
                </div>                
                       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
 
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
 
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
    
  </body>

  <footer>
        <div class="contenedor-footer">
            <div class="content-foo">
                <h4>GitHub</h4>
                <p>https://github.com/davidmejiap21</p>
            </div>
            <div class="content-foo">
                <h4>Email</h4>
                <p>alejo.oct@gmail.com</p>
            </div>
            <div class="content-foo">
                <h4>Institucion</h4>
                <p>Servicio Nacional de Aprendizaje</p>
            </div>
        </div>
        <h2 class="titulo-final"> Analisis y Desarrollo de software | David Alejandro Mejia Posada</h2>
    </footer>

</html>


<?php  }else {
    
    header('location: ../Index.php');
} ?>