<?php
	include("lynxspace.class.php");
	$sitio->validar_rol(array('Usuario','Administrador'));
	$id_usuario = $_SESSION['id_usuario'];
	$data = $sitio->persona($id_usuario);
	$foto = $data['foto']; 
	$nombre = $data['nombre'];

	if (isset($_POST['enviar'])) {
		$data = $_POST;
		$sitio->publicar($data);
	}
	
	if(isset($_GET['respuesta'])){
		$id_mensaje = $_GET['id_mensaje'];
		$mensaje = $_GET['mensaje'];
		$sitio->responder($mensaje, $id_mensaje);
	}
   	
	
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lynx-Space</title>
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link rel="stylesheet" href="css/bootstrap2.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://www.clubdesign.at/floatlabels.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav class="navbar navbar-expand-lg navbar-light" id="barra" style="background-color: #145A32;">
				  	<a href="index.php"><img src="image/Logo.png" width="70" height="50" style="margin-left: 30px;" alt="logo"></a>
					<div class="collapse navbar-collapse" id="navbarColor01" style="margin-right: 90px;">
				    	<ul class="navbar-nav ml-auto" style="font-size: 17px;">
				    		<li class="nav-item active">
				    			<a class="nav-link" href="index.php">
							  	<?php
								if (is_null($data['foto'])) {
									echo "<img src='uploads/default.png' height='30' width='30' class='rounded-circle' alt='imagen_perfil'>";
								}else{
									echo "<img src='uploads/$foto' height='30' width='30' class='rounded-circle' alt='imagen_perfil'>";
								}
								?>
								<?php echo $data['nombre']." ".$data['apellidos']." (".$data['apodo'].")"; ?>
								</a>
				    		</li>
					      	<li class="nav-item active">
					        	<a class="nav-link" href="index.php">Inicio</a>
					      	</li>
					      	<li class="nav-item">
			    				<a class="nav-link" href="amigos.php">Amigos</a>
			  				</li>
					      	<li class="nav-item">
			    				<a class="nav-link" href="sugerencias.php">Sugerencias</a>
			  				</li>
					      	<li class="nav-item dropdown">
			      				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+ Opciones
			      				</a>
			      				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			      					<a class="dropdown-item" href="editar_perfil.php">Editar Perfil</a>
			        				<a class="dropdown-item" href="seguridad.php">Roles y Privilegios</a>
			        				<a class="dropdown-item" href="admi_seguridad.php">Administrador</a>
			        				<a class="dropdown-item" href="log_out.php">Salir</a>
			      				</div>
			    			</li>
				   	 	</ul> 
				  	</div>
				</nav>
			</div>
		</div>
		</br>
		<div class="row">
			<div class="col-sm-12">
				<form method="POST" action="index.php">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" placeholder="¿Que piensas?" name="mensaje">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="submit" name="enviar" value="Publicar" class="btn btn-dark btn-block">
                        </div>
                    </div>
                </form>
			</div>			
		</div>
		<hr class="my-4">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<?php 
    				$var_mensaje=$sitio->indice();
 					if(isset($_GET['accion'])){
       					$accion=$_GET['accion'];
      			        switch ($accion){
				        	case 'reaccion':
				           		if(isset($_GET['id_mensaje']) AND isset($_GET['reaccion'])){
					                $reaccion=$_GET['reaccion'];
					                $id_mensaje=$_GET['id_mensaje'];
					                $sitio->reaccion($id_mensaje,$reaccion);
					                header('Location: index.php');
				           		}
				       			break;
					       case 2:
					       break;
				   		}
   					}
					foreach($var_mensaje as $key =>$n){
         				$sitio->mensaje($n);
  					}
   				?>
			</div>
			<div class="col-sm-2"></div>
		</div>
		<hr class="my-4">
		<div class="row" id="pie">
	        <div class="col-sm-12" align="center">
	        	<h4>Sobre LYNX-SPACE</h4>
	          	<ul class="list-unstyled">
	            	<li>Gachuz Chavez Sergio Eduardo</li>
	            	<li>Programacion Web</li>
	          	</ul>
	        </div>
	    </div>
	</div>
</body>
</html>
