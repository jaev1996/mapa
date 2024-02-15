<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootstrap.min.css">
    <title>Nuevo</title>
	<style type="text/css">
        .bg{
            background-image: url("<?php echo constant('URL'); ?>public/images/1.jpg");
      		background-repeat: no-repeat;
      		background-size: 100%;
      		opacity: ;
        }
    </style>
</head>
<body class="bg">
    
    <h1 class="text-center display-4 fixed-top bg-dark text-white">"SICIEAF"</h1>
    <center>
	<div class="container"><br><br><br><br><br><br>

		<div class="card col-md-6" id="form-ingreso">
			<h4 class="card-header m-2">
				Inicio de Sesi&oacute;n
			</h4>
			<div class="card-body">
				<form action="<?php echo constant('URL'); ?>login/iniciarSession" method="POST" id="datos-login">
					<h5>Usuario:</h5>
					<input class="form-control col-md-6" autocomplete="off" type="text" name="user" required="true"><br>
					<h5>Constraseña:</h5>
					<input class="form-control col-md-6" type="password" name="pass" required="true"><br>
			
			</div>
			<div class="card-footer">
					<input type="submit" value="Ingresar" class="btn btn-sm btn-success">
				</form>
					
			</div>
		</div>
	</div>
	</center>

    <?php require_once 'Views/footer.php'; ?>

</body>
</html>