<?php
if(isset($_GET["BTNEC"])){
        include ('../autentificacion.php');
        $controlador= new ControladorDeUsuario();
        $controlador->validarUsuarioPorGoogle($email,$name);
}else if(isset($_GET["usuarioEleg"])){
    $controlador= new ControladorDeUsuario();
    $controlador-> eleminarUsuario($_GET["usuarioEleg"], $_GET["usuarioAc"]);
}else if(isset($_POST["btnregistrar"])){
    session_start();
    $controlador= new ControladorDeUsuario();
    $controlador->altaUsuario();
}else if(isset($_POST["btnModificarUsuario"])){
    session_start();
    $controlador= new ControladorDeUsuario();
    $controlador->modificarUsuario();
}

class ControladorDeUsuario{
    private $usuario;

    public function __construct(){

    }

    public function getUsuario(){
        return $this->usuario;
    }
    public function setUsuario($usuario){
        $this->usuario=$usuario;
    }


    public function validarUsuarioPorGoogle($email,$nombre){
        include("../modelo/usuario.php");
        $usuario= new Usuario();
        if($usuario-> verificarEmail($email)){
            if($usuario->getRol()=='administrador'){
                echo "<script> alert('Bienvenido $nombre'); window.location='../vistas/panelPrincipal.php' </script>";
            
                }
            else if($usuario->getRol()=='basico'){
                echo "<script> alert('Bienvenido $nombre'); window.location='../vistas/panelPrincipal.php' </script>";
                } 
        }else{
            //Usuario Inexistente o Contraseña Erronea
		    echo "<script> alert('SORRY! El Usuario no existe o La Contraseña es Erronea'); window.location='../index.php' </script>";
	
        }
    }

    public function eleminarUsuario($usernameAEliminar, $usuarioActual){
        include("../modelo/usuario.php");
        if ($usernameAEliminar==$usuarioActual){
            echo "<script> alert('SORRY! El Usuario elegido es USTED - No puede Auto Eliminarse'); window.location='../vistas/listadoUsuarios.php' </script>";
        }else{
            $usuario= new Usuario();
            $resultado= $usuario->bajaUsuario($usernameAEliminar);
            if($resultado==TRUE){
                echo "<script> alert('USUARIO: $usernameAEliminar eliminado EXITOSAMENTE' ); window.location='../vistas/listadoUsuarios.php' </script>";
            }else{
                echo "<script> alert('SORRY! El USUARIO: $usernameAEliminar No pudo Eliminarse'); window.location='../vistas/listadoUsuarios.php' </script>";
            }
        }
    }

    public function altaUsuario(){
        include("../modelo/usuario.php");
        include("../dao/usuarioDAO.php");
        $nombre= $_POST["usuario"];
        $rol=$_POST["rol"];
        $avatar=$_POST["avatar"];
        $domicilio= $_POST["domicilio"];
        $telefono= $_POST["telefono"];
        $email= $_POST["correo_electronico"];
        //Se analiza el Rol/ Persmisos que se le quieren asignar al Nuevo Usuario
        if($rol=='Admin'){
                $rol=1;
        }elseif($rol=='Usuario'){
                $rol=2;
        }
        //Avatar por defecto
        if($avatar==''){
            $avatar='7';
        }
        $usuarioACargar= new Usuario();
        $usuarioACargar->setNombre($nombre);
        $usuarioACargar->setRol($rol);
        $usuarioACargar->setAvatar($avatar);
        $usuarioACargar->setDomicilio($domicilio);
        $usuarioACargar->setTelefono($telefono);
        $usuarioACargar->setEmail($email);
        $usuarioDAO= new UsuarioDAO();
        if($usuarioDAO-> cargarUsuario($usuarioACargar)){
            echo "<script> alert('Usuario registrado con exito: $nombre'); window.location='../vistas/listadoUsuarios.php' </script>";
        }else{
            echo "<script> alert('Usuario NO registrado con exito: $nombre NO esta disponible'); window.location='../vistas/registrar_usuario.php' </script>";
        }
        
    }
    public function modificarUsuario(){
        include("../modelo/usuario.php");
        include("../dao/usuarioDAO.php");
        $nombre= $_POST["usuario"];
        $rol=$_POST["rol"];
        $avatar=$_POST["avatar"];
        $domicilio= $_POST["domicilio"];
        $telefono= $_POST["telefono"];
        $email= $_POST["correo_electronico"];
        //Se analiza el Rol/ Persmisos que se le quieren modificar
        if($rol=='Admin' || $rol=='Administrador'){
                $rol=1;
        }elseif($rol=='Usuario'|| $rol=='Usuario Estandar'){
                $rol=2;
        }
        //Avatar por defecto
        if($avatar==''){
            $avatar='7';
        }
        $usuarioACargar= new Usuario();
        $usuarioACargar->setNombre($nombre);
        $usuarioACargar->setRol($rol);
        $usuarioACargar->setAvatar($avatar);
        $usuarioACargar->setDomicilio($domicilio);
        $usuarioACargar->setTelefono($telefono);
        $usuarioACargar->setEmail($email);
        $idUsuario=$_POST["idusuario"];
        $rolRetorno=$_POST["rol"];
        $usuarioDAO= new UsuarioDAO();
        if($usuarioDAO-> modificarUsuario($usuarioACargar, $idUsuario, $rolRetorno)){
            echo "<script> alert('Usuario modificado con exito: $nombre'); window.location='../vistas/listadoUsuarios.php' </script>";
        }else{
            echo "<script> alert('Usuario NO modificado con exito: $nombre NO esta disponible'); window.location='../vistas/listadoUsuarios.php' </script>";
        }
        
    }
}


?>