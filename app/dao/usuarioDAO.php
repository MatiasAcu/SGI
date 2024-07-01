<?php

class UsuarioDAO{

    public function __construct(){

    }

    public function eliminarUsuario($usernameAEliminar){
        include ("../modelo/conexionPDO.php");
        $usuario= $this->obtenerUsuario($usernameAEliminar);
        $mbd->beginTransaction();
        $sentencia = $mbd->prepare("DELETE FROM usuarios where nombre_de_usuario= :nombreU");
        $sentencia->bindParam(':nombreU', $usernameAEliminar);
        $idParam= $_SESSION['usuario_id']; 
        if(!$sentencia->execute() ){
            $mbd->rollBack(); //Si por algun motivo sugiera un problema en la baja realizamos un ROLLBACK, al estado previo de la BD
           return FALSE;
         } 
     $mbd->commit();
     return TRUE;
    }

    public function obtenerUsuarioPorEmail($email){
        include("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT * FROM usuarios where email=:emailU");
        $sentencia->bindParam(':emailU', $email);
        $sentencia->execute();
        if(($sentencia->rowCount())<= 0){
            return FALSE;
        }
        $row = $sentencia->fetch(PDO::FETCH_OBJ);
        $avatar= $row->avatar;
        $usuario_id= $row->idusuario;
        $nombre=$row->nombre_de_usuario;
        $_SESSION['usuario_id']=$usuario_id;
        //Se determina el Rol del usuario, consultando en la BD, en base al Id del usuario y su contraseña
        $sentencia2 = $mbd->prepare("SELECT * FROM tipo_usuario WHERE idtipo_usuario=(SELECT rol FROM usuarios WHERE email = :emailU )");
        $sentencia2->bindParam(':emailU', $email);
        $sentencia2->execute();
        $datos = $sentencia2->fetch(PDO::FETCH_OBJ);
        $rol=$datos->tipo;
        $usuario= new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setAvatar($avatar);
        $usuario->setRol($rol);
        return $usuario;
    }

    public function obtenerUsuario($nombre){
        include("../modelo/conexionPDO.php");
        $sentencia = $mbd->prepare("SELECT * FROM usuarios where nombre_de_usuario= :nombreU");
        $sentencia->bindParam(':nombreU', $nombre);
        $sentencia->execute();
        $row = $sentencia->fetch(PDO::FETCH_OBJ);
        $avatar= $row->avatar;
        $usuario_id= $row->idusuario;
        $email=$row->email;
        $_SESSION['usuario_id']=$usuario_id;
        //Se determina el Rol del usuario, consultando en la BD, en base al Id del usuario y su contraseña
        $sentencia2 = $mbd->prepare("SELECT * FROM tipo_usuario WHERE idtipo_usuario=(SELECT rol FROM usuarios WHERE nombre_de_usuario = :nombre AND email= :email)");
        $sentencia2->bindParam(':nombre', $nombreParam);
        $sentencia2->bindParam(':email', $email);
        $nombreParam=$nombre;
        $sentencia2->execute();
        $datos = $sentencia2->fetch(PDO::FETCH_OBJ);
        $rol=$datos->tipo;
        $usuario= new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setAvatar($avatar);
        $usuario->setRol($rol);
        return $usuario;
    }
    public function obtenerROL($usuarioID){
        include("../modelo/conexionPDO.php");
        //Se determina el Rol del usuario, consultando en la BD, en base al Id del usuario y su contraseña
        $sentencia = $mbd->prepare("SELECT * FROM tipo_usuario WHERE idtipo_usuario=(SELECT rol FROM usuarios WHERE nombre_de_usuario = TRIM(:nombre))");
        $sentencia->bindParam(':nombre', $usuarioID);
        $sentencia->execute();
        $datos = $sentencia->fetch(PDO::FETCH_OBJ);
        $rol=$datos->tipo;
        return $rol;
    }

    public function  cargarUsuario($usuarioACargar){
        include("../modelo/conexionPDO.php");
        /*  
        Observacion en el registro de usuarios se verifica que no se carguen dos usuarios con el mismo id 
        para eso se realiza la siguiente sentencia
        */
        $sentencia = $mbd->prepare("SELECT COUNT(*) FROM usuarios where nombre_de_usuario= :nombreU");
        $sentencia->bindParam(':nombreU', $nombreParam);
        $nombreParam=$usuarioACargar->getNombre();    
        $sentencia->execute();
        $numeroFilas =$sentencia->fetchColumn();
        if($numeroFilas > 0){//el Nombre de Usuario ya esta en uso
            echo "<script> alert('Usuario NO registrado con exito: $nombreParam NO esta disponible'); window.location='../vistas/cargarUsuario.php' </script>";
        }
        $sentencia = $mbd->prepare("SELECT COUNT(*) FROM usuarios where email= :emailU");
        $sentencia->bindParam(':emailU', $emailParam);
        $emailParam=$usuarioACargar->getEmail();    
        $sentencia->execute();
        $numeroFilas =$sentencia->fetchColumn();
        if($numeroFilas > 0){//el email de Usuario ya esta en uso
            echo "<script> alert('Usuario NO registrado con exito: $emailParam NO esta disponible'); window.location='../vistas/cargarUsuario.php' </script>";
        }
        else if ($numeroFilas == 0)
        {
	    $sqlgrabar = $mbd->prepare("INSERT INTO usuarios(nombre_de_usuario, rol, avatar, domicilio, telefono, email) values (:nombre,:rol,:avatar, :domicilio, :telefono, :email)");
	    $sqlgrabar->bindParam(':nombre', $nombreParam);
	    $sqlgrabar->bindParam(':rol', $rolParam);
	    $sqlgrabar->bindParam(':avatar', $avatarParam);
        $sqlgrabar->bindParam(':domicilio', $domicilioParam);
        $sqlgrabar->bindParam(':telefono', $telefonoParam);
        $sqlgrabar->bindParam(':email', $emailParam);
        
	    $nombreParam=$usuarioACargar->getNombre();
	    $rolParam=$usuarioACargar->getRol();
	    $avatarParam=$usuarioACargar->getAvatar();
        $domicilioParam=$usuarioACargar->getDomicilio();
        $telefonoParam=$usuarioACargar->getTelefono();
        $emailParam=$usuarioACargar->getEmail();
        //Se verifica que se haya realizado con exito la Carga, y se retorna al espacio del Administrador
        if(	$sqlgrabar->execute()){
            return TRUE;
	    }else{
            return FALSE; }
           
    }
}

public function  modificarUsuario($usuarioACargar, $idUsuario, $rolRetorno){
    include("../modelo/conexionPDO.php");
   /*  
        Observacion en la modificacion de usuarios se verifica que no se modifiquen dos usuarios con el mismo email 
        para eso se realiza la siguiente sentencia
        */
        $sentencia = $mbd->prepare("SELECT COUNT(*) FROM usuarios where email= :emailU");
        $sentencia->bindParam(':emailU', $emailParam);
        $emailParam=$usuarioACargar->getEmail();    
        $sentencia->execute();
        $numeroFilas =$sentencia->fetchColumn();
        if($numeroFilas > 0){//el email de Usuario ya esta en uso
            echo "<script> alert('Usuario NO modificado con exito: $emailParam NO esta disponible'); window.location='../vistas/modificarUsuario.php?idUsuario=".strval($idUsuario)."&nombre=".strval($usuarioACargar->getNombre())."&direccion=".strval($usuarioACargar->getDomicilio())."&rol=".strval($rolRetorno)."&email=".strval($usuarioACargar->getEmail())."&telefono=".strval($usuarioACargar->getTelefono())."'</script>";
        }
        else if ($numeroFilas == 0)
        {

    $sqlgrabar = $mbd->prepare("UPDATE usuarios SET nombre_de_usuario= :nombre, rol=:rol, avatar=:avatar, domicilio=:domicilio, telefono=:telefono, email=:email WHERE idusuario=:idusuario;");
    $sqlgrabar->bindParam(':nombre', $nombreParam);
    $sqlgrabar->bindParam(':rol', $rolParam);
    $sqlgrabar->bindParam(':avatar', $avatarParam);
    $sqlgrabar->bindParam(':domicilio', $domicilioParam);
    $sqlgrabar->bindParam(':telefono', $telefonoParam);
    $sqlgrabar->bindParam(':email', $emailParam);
    $sqlgrabar->bindParam(':idusuario', $idUsuario);
    
    $nombreParam=$usuarioACargar->getNombre();
    $rolParam=$usuarioACargar->getRol();
    $avatarParam=$usuarioACargar->getAvatar();
    $domicilioParam=$usuarioACargar->getDomicilio();
    $telefonoParam=$usuarioACargar->getTelefono();
    $emailParam=$usuarioACargar->getEmail();
    //Se verifica que se haya realizado con exito la modificacion, y se retorna al espacio del Administrador
    if(	$sqlgrabar->execute()){
        return TRUE;
    }else{
        return FALSE; }
    }
}

public function bajaDeUsuario($id_usuario){
    include ("../modelo/conexionPDO.php");
    $sentencia = $mbd->prepare("DELETE FROM usuarios WHERE idusuario= :numeroC;");
    $sentencia->bindParam(':numeroC',$id_usuario);
    
    if($sentencia->execute()){
        return True;
    }
    else{
        return False;
    }
}

}
?>