<?php
class BaseDatos
{        
    private $_connection;
    private static $_instance; 
    private $_server = "localhost";
    private $_username = "electiva";
    private $_password = "electiva";
    private $_database = "prueba";
    public static function getInstance()
    {
        if(!self::$_instance) 
        { 
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $this->_connection = new mysqli($this->_server, $this->_username,$this->_password, $this->_database);
        if(mysqli_connect_error())
        {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),E_USER_ERROR);
        }
    }
	
    public function getConnection()
    {
        return $this->_connection;
    }
     
    public function get_data($sql)
    {
        $ret = array('STATUS'=>'ERROR','ERROR'=>'','DATA'=>array());
         
        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);
         
        if($res)
            $ret['STATUS'] = "OK";
        else
            $ret['ERROR'] = mysqli_error();            
         
        while($row = $res->fetch_array(MYSQLI_ASSOC))
        {
            $ret['DATA'][] = $row;
        }
        return $ret;
    }
    
    public function obtenerRutas()
    {
        
        
    }
	
	public function agregarRuta($latitud, $longitud, $idEmpresa)
    {
         
        $mysqli = $this->getConnection();
        $res = $mysqli->query("Select * From prueba.usuarios where user=\"".$user."\" and password = \"".$pass."\"");      
        $row = $res->fetch_assoc();
        return $row;
    }
    
	public function recuperar($user, $pass){
		$mysqli = $this->getConnection();
        $res = $mysqli->query("Select * From prueba.usuarios where user=\"".$user."\" and password = \"".$pass."\"");       
        $row = $res->fetch_assoc();
        return $row;
	}
	
	public function recuperar2($id){
		$mysqli = $this->getConnection();
        $res = $mysqli->query("Select * From prueba.usuarios where idUsuario=\"".$id."\"");       
        $row = $res->fetch_assoc();
        return $row;
	}
	
	public function autentico($user, $pass){
		$mysqli = $this->getConnection();
        $res = $mysqli->query("Select count(*) From prueba.usuarios where user=\"".$user."\" and password = \"".$pass."\"");       
        $row = $res->fetch_assoc();
        if($row["count(*)"]==1){
			return true;
		}else{
			return false;
		}
	}
	//cabe acalarar que el tipo usuario 1 es lo mismo que el usuario estandar, el 2 es el Administrador
	public function ingresar( $c_user,$c_pass, $c_nombre, $c_apellido1, $c_apellido2, $c_correo, $c_celular){
		$mysqli = $this->getInstance();
		if(!$mysqli->autentico($c_user, $c_pass)){
			$mysqli = $this->getConnection();
			$res = $mysqli->query("INSERT INTO `prueba`.`usuarios` ( `user`, `password`, `nombre`, `apellido1`, `apellido2`, `correo`, `celular`, `tipoUsuario`) VALUES ( \"".$c_user."\", \"".$c_pass."\", \"".$c_nombre."\", \"".$c_apellido1."\", \"".$c_apellido2."\", \"".$c_correo."\", \"".$c_celular."\", \"1\")");
			if($res){
				return true;//registrado
			}else{
				return false;
			}
		}else{
			return false;//no registrar
		}
	}
	
	public function desconectarse(){
		$this->_connection-> close();
	}
	
	public function modificar($c_id, $c_pass){
		//validar contrasena correcta FALTA
		$mysqli = $this->getConnection();
        $res = $mysqli->query("UPDATE prueba.usuarios SET password = \"".$c_pass."\" WHERE (idUsuario = \"".$c_id."\")");
		if($res){
            return true;
        }else{
            return false;
		}
		
	}
	
    public function exec($sql)
    {
        $ret = array('STATUS'=>'ERROR','ERROR'=>'');
 
        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);
         
        if($res)
            $ret['STATUS'] = "OK";
        else
            $ret['ERROR'] = mysqli_error();
         
        return $ret;
    }
	
	
 
}
?>