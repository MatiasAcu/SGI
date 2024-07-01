<?php

class Usuario{

    public function __construct(){

    }
    private $nombre;
    private $rol;
    private $avatar;
    private $domicilio;
    private $telefono;
    private $email;

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function getRol(){
        return $this->rol;
    }
    public function setRol($rol){
        $this->rol=$rol;
    }
    public function getAvatar(){
        return $this->avatar;
    }
    public function setAvatar($avatar){
        $this->avatar=$avatar;
    }
	public function setDomicilio( $domicilio): void {
        $this->domicilio = $domicilio;
    }
	public function setTelefono( $telefono): void {
        $this->telefono = $telefono;
    }
	public function setEmail( $email): void {
        $this->email = $email;
    }
	public function getDomicilio() {
        return $this->domicilio;
    }
	public function getTelefono() {
        return $this->telefono;
    }
	public function getEmail() {
        return $this->email;
    }


    public function verificarEmail($email){
        include("../dao/usuarioDAO.php");
        /* Buscar Usuario en la BD, por identificador de Usuario; 
        Observacion en el registro de usuarios se verifica que no se carguen dos usuarios con el mismo id */
        $usuarioDao= new UsuarioDAO();
        $usuario=$usuarioDao->obtenerUsuarioPorEmail($email);
        if(!$usuario){
            return FALSE;
        }
        $avatar=$usuario->getAvatar();
        $rol=$usuario->getRol();
        $nombre=$usuario->getNombre();
        $this->setRol($rol);
        $this->setNombre($nombre);
        $this->setAvatar($avatar);
        if($this->getRol()=='administrador'){
            $_SESSION['rol']='ADMINISTRADOR';
        }else if($this->getRol()=='basico'){
            $_SESSION['rol']='USUARIO ESTANDAR';
        }
        $_SESSION['nombredelusuario']=$nombre;
        $_SESSION['avatar']=$avatar;
        return TRUE;
    
        
    }


    public function bajaUsuario($usernameAEliminar){
        include("../dao/usuarioDAO.php");
        $usuarioDao= new UsuarioDAO();
        $resultado= $usuarioDao->eliminarUsuario($usernameAEliminar);
        return $resultado;
    }
    public function obtenerRol($usuarioID){
        include("../dao/usuarioDAO.php");
        $usuarioDao= new UsuarioDAO();
        $rol=$usuarioDao->obtenerROL($usuarioID);
        if($rol=='administrador'){
            return 1;
        }else if ($rol=='basico'){
            return 2;
        }

    }

    public function usuarioAsignadoEmpleado($nombre_completo, $contraseña){
        include("../modelo/complementos.php");
        $this->setNombre($nombre_completo);
        $this->setRol(3);
        $complemento= new Complemento();
        $pass_fuerte= $complemento->obtenerContraseñaSegura($contraseña);
        $this->setContraseña( $pass_fuerte);
        $this->setAvatar('7');
        return $this;
    }
    

}

?>