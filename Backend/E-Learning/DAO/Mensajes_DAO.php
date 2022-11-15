<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Mensajes_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteMensajes($p_Opc, $parametrosMensajes) {
    	$con = null;
    	$sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_mensajes(:p_Opc, :p_IdMensaje, :p_UsuarioEnvia, :p_UsuarioRecibe, :p_DescripcionMensaje, 
            :p_FechaCreacionMensaje, :p_EstadoMensaje,:p_FiltroBandeja);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdMensaje"=>$parametrosMensajes->getIdMensaje(), 
                ":p_UsuarioEnvia"=>$parametrosMensajes->getUsuarioEnvia(), 
                ":p_UsuarioRecibe"=>$parametrosMensajes->getUsuarioRecibe(),
                ":p_DescripcionMensaje"=>$parametrosMensajes->getDescripcionMensaje(),
                ":p_FechaCreacionMensaje"=>$parametrosMensajes->getFechaCreacionMensaje(),
                ":p_EstadoMensaje"=>$parametrosMensajes->getEstadoMensaje(),
                ":p_FiltroBandeja"=>$parametrosMensajes->getFiltroBandeja()
                )
            );
        }   
        catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
        	//$statement->close();
            //$con->close();
        }

        return $rowsAffectted;
    }

    public static function getMensajes($p_Opc, $parametrosMensajes)
    {
        $con = null;
    	$sentencia = null;
        
        $listaMensajes = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_mensajes(:p_Opc, :p_IdMensaje, :p_UsuarioEnvia, :p_UsuarioRecibe, :p_DescripcionMensaje, 
                                    :p_FechaCreacionMensaje, :p_EstadoMensaje,:p_FiltroBandeja);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdMensaje"=>$parametrosMensajes->getIdMensaje(), 
                ":p_UsuarioEnvia"=>$parametrosMensajes->getUsuarioEnvia(), 
                ":p_UsuarioRecibe"=>$parametrosMensajes->getUsuarioRecibe(),
                ":p_DescripcionMensaje"=>$parametrosMensajes->getDescripcionMensaje(),
                ":p_FechaCreacionMensaje"=>$parametrosMensajes->getFechaCreacionMensaje(),
                ":p_EstadoMensaje"=>$parametrosMensajes->getEstadoMensaje(),
                ":p_FiltroBandeja"=>$parametrosMensajes->getFiltroBandeja()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $IdUsuario = $filas["IdMensaje"];
                $UsuarioEnvia = $filas["UsuarioEnvia"];
                $UsuarioRecibe = $filas["UsuarioRecibe"];
                $DescripcionMensaje = $filas["DescripcionMensaje"];
                $FechaCreacionMensaje = $filas["FechaCreacionMensaje"];
                $EstadoMensaje = $filas["EstadoMensaje"];

                
                $NombreUsuarioEnvia = null;
                $ImagenUsuarioEnvia = null;
                $NombreUsuarioRecibe = null;
                $ImagenUsuarioRecibe = null;
                

                if(isset($filas["NombreUsuarioEnvia"]))
                $NombreUsuarioEnvia = $filas["NombreUsuarioEnvia"];

                if(isset($filas["ImagenUsuarioEnvia"]))
                $ImagenUsuarioEnvia = $filas["ImagenUsuarioEnvia"];

                if(isset($filas["NombreUsuarioRecibe"]))
                $NombreUsuarioRecibe = $filas["NombreUsuarioRecibe"];

                if(isset($filas["ImagenUsuarioRecibe"]))
                $ImagenUsuarioRecibe = $filas["ImagenUsuarioRecibe"];

                $listaMensajes[] = Mensajes_Model::createMensajes($IdUsuario, $UsuarioEnvia, $UsuarioRecibe, $DescripcionMensaje, $FechaCreacionMensaje, $EstadoMensaje,
                                                                $NombreUsuarioEnvia, $ImagenUsuarioEnvia, $NombreUsuarioRecibe, $ImagenUsuarioRecibe);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
        	$sentencia->closeCursor();
        }


        return $listaMensajes;
    }
}

?>