<?php
  require 'vendor/autoload.php';

 
  $clientID = '';
  $clientSecret = '';
  $redirectUri = 'http://localhost:/PROYECTOS-PHP/SistemaGestionInventario/controlador/controladorDeUsuario.php?&BTNEC=1';

  // crear solicitud de Cliente para acceso a Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

 
?>
