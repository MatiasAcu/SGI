<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SGI</title>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--css Externo-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Estilos personalizados -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

  </head>

  <body>

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="controlador/controladorDeUsuario.php" method="POST" >
		        <h2 class="form-login-heading">INGRESO AL SISTEMA</h2>
    
		        <div class="login-wrap">
              <label class="checkbox">Ingresa tus credenciales
              </label>
		            <?php require ('autentificacion.php')?>
                <a style='font-size:20px;' href="<?php echo $client->createAuthUrl() ?>">Iniciar sesión con Google</a> 
                <img class="img-responsive" src="assets/img/google.png" width='50%' style='margin:auto;'>
                <hr>
                <div class="photo">
                  <img class="img-responsive" src="assets/img/logoSGISinFondo.png">
                </div>
		
		        </div>
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!--js colocado al final del documento para que las páginas carguen más rápido -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


    <!--<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/logoSGISinFondo.png", {speed: 200});
    </script>
    -->


  </body>
</html>
