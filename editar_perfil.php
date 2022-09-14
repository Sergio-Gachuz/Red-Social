<?php
	include('lynxspace.class.php');
	include('config.php');
	$sitio->validar_rol(array('Usuario','Administrador'));
	$id_usuario = $_SESSION['id_usuario'];
	$id_persona = $_SESSION['id_persona'];
	if (isset($_GET['accion'])) {
		$accion = $_GET['accion'];
		switch ($accion) {
			case 'eliminar':
				$sitio->eliminar_cuenta($_SESSION['id_usuario']);
				header('Location: log_in.php');
				break;
		}
	}
	if (isset($_POST['actualizar'])) {
		$data = $_POST;
		$data['id_usuario'] = $id_usuario;
		$sitio->editar_perfil($data);
		die();
	}
	$data = $sitio->persona($id_usuario);
	$foto=$data['foto']; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lynx-Space | Editar Perfil</title>
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
				  	<a href="index.php"><img src="image/Logo.png" width="70" height="50" style="margin-left: 30px;"></a>
					<div class="collapse navbar-collapse" id="navbarColor01" style="margin-right: 90px;">
				    	<ul class="navbar-nav ml-auto" style="font-size: 17px;">
				    		<li class="nav-item active">
				    			<a class="nav-link" href="index.php">
							  	<?php
								if (is_null($data['foto'])) {
									echo "<img src='uploads/default.png' height='30' width='30' class='rounded-circle'>";
								}else{
									echo "<img src='uploads/$foto' height='30' width='30' class='rounded-circle'>";
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
		<div class="row">
	      	<div class="col-sm-12">
	      		<h1>Actualiza tus datos.</h1>
	      		<form method="POST" action="editar_perfil.php" enctype="multipart/form-data">
	      			<div class="form-row">
						<div class="form-group col-md-6">
						    <label>Nombre/s</label>
						    <input type="text" class="form-control" placeholder="Nombre/s" name="nombre" value="<?php echo $data['nombre']; ?>">
						</div>
						<div class="form-group col-md-6">
						    <label for="inputPassword4">Apellidos</label>
				   	        <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" value="<?php echo $data['apellidos']; ?>">
					    </div>
					</div>
					<div class="form-group">
					    <label>Apodo</label>
					    <input type="text" class="form-control" placeholder="Apodo" name="apodo" value="<?php echo $data['apodo']; ?>">
					</div>
					<div class="form-group">
					    <label>Fecha de Nacimiento</label>
					    <br />
					    <div class="form-group col-md-4">
					    	<select name="dia" class="form-control">
							<?php
								for ($i = 1; $i < 32 ; $i++) { 
									echo "<option value = '$i'>$i</option>";
								}
							?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<select name="mes" class="form-control">
								<?php
									foreach ($meses as $value => $mes) {
										echo "<option value='$value'>$mes</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<select name="anio" class="form-control">
								<?php
									for ($i = (int)(date('Y'))-70; $i < (int)(date('Y'))-17; $i++) { 
										echo "<option value = '$i'>$i</option>";
									}
								?>
							</select>
					    </div>
					</div>
					<div class="form-group">
					    <label>Foto de Perfil</label>
					    <input type="file" class="form-control" name="foto" >
					</div>
					<div class="form-group">
					    <label>Email</label>
					    <input type="email" class="form-control" placeholder="E-mail" name="email" value="<?php echo $data['email']; ?>">
					</div>
					<div class="form-group">
					    <label>Contraseña</label>
					    <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
					</div>
					<input type="submit" name="actualizar" value="Actualizar" class="btn btn-primary btn-lg btn-block"/>
	    		</form>
	    		</br>
	    		<hr class="my-4">
	    		<a href="editar_perfil.php?accion=eliminar" class="btn btn-danger">Eliminar mi cuenta.</a>
	    		</br>
	    		</br>
	    	</div>
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
