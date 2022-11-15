<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Usuarios_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteUsuarios($p_Opc, $parametrosUsuario) {
    	$con = null;
    	$sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_usuarios(:p_Opc, :p_IdUsuario, :p_NombreUsuario, :p_ApellidoPaternoUsuario,:p_ApellidoMaternoUsuario, :p_GeneroUsuario, :p_FechaNacimientoUsuario, 
                                    :p_ImagenPerfilUsuario, :p_CorreoUsuario, :p_PasswordUsuario, :p_FechaCreacionUsuario, :p_EstadoUsuario, :p_IdRol);';

            $sentencia = $con->prepare($sql);

            if (General::LOAD_IMAGE) {
                $rowsAffectted = $sentencia->execute(
                    array(
                ":p_Opc"=>$p_Opc,
                ":p_IdUsuario"=>$parametrosUsuario->getIdUsuario(),
                ":p_NombreUsuario"=>$parametrosUsuario->getNombreUsuario(),
                ":p_ApellidoPaternoUsuario"=>$parametrosUsuario->getApellidoPaternoUsuario(),
                ":p_ApellidoMaternoUsuario"=>$parametrosUsuario->getApellidoMaternoUsuario(),
                ":p_GeneroUsuario"=>$parametrosUsuario->getGeneroUsuario(),
                ":p_FechaNacimientoUsuario"=>$parametrosUsuario->getFechaNacimientoUsuario(),
                ":p_ImagenPerfilUsuario"=>$parametrosUsuario->getImagenPerfilUsuario(),
                ":p_CorreoUsuario"=>$parametrosUsuario->getCorreoUsuario(),
                ":p_PasswordUsuario"=>$parametrosUsuario->getPasswordUsuario(),
                ":p_FechaCreacionUsuario"=>$parametrosUsuario->getFechaCreacionUsuario(),
                ":p_EstadoUsuario"=>$parametrosUsuario->getEstadoUsuario(),
                ":p_IdRol"=>$parametrosUsuario->getIdRol()
                )
                );
            }
            else{
                $sentencia->bindParam(':p_Opc', $p_Opc);
                $sentencia->bindParam(':p_IdUsuario', $parametrosUsuario->getIdUsuario());
                $sentencia->bindParam(':p_NombreUsuario', $parametrosUsuario->getNombreUsuario());
                $sentencia->bindParam(':p_ApellidoPaternoUsuario', $parametrosUsuario->getApellidoPaternoUsuario());
                $sentencia->bindParam(':p_ApellidoMaternoUsuario', $parametrosUsuario->getApellidoMaternoUsuario());
                $sentencia->bindParam(':p_GeneroUsuario', $parametrosUsuario->getGeneroUsuario());
                $sentencia->bindParam(':p_FechaNacimientoUsuario', $parametrosUsuario->getFechaNacimientoUsuario());
                $sentencia->bindParam(':p_ImagenPerfilUsuario', $parametrosUsuario->getImagenPerfilUsuario(), PDO::PARAM_LOB);
                $sentencia->bindParam(':p_CorreoUsuario', $parametrosUsuario->getCorreoUsuario());
                $sentencia->bindParam(':p_PasswordUsuario', $parametrosUsuario->getPasswordUsuario());
                $sentencia->bindParam(':p_FechaCreacionUsuario', $parametrosUsuario->getFechaCreacionUsuario());
                $sentencia->bindParam(':p_EstadoUsuario', $parametrosUsuario->getEstadoUsuario());
                $sentencia->bindParam(':p_IdRol', $parametrosUsuario->getIdRol());

                $rowsAffectted = $sentencia->execute();
            }

            
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
    
    public static function getUsuarios($p_Opc, $parametrosUsuario)
     {
        $con = null;
    	$sentencia = null;
        
        $listaUsuarios = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_usuarios(:p_Opc, :p_IdUsuario, :p_NombreUsuario, :p_ApellidoPaternoUsuario,:p_ApellidoMaternoUsuario, :p_GeneroUsuario, :p_FechaNacimientoUsuario, 
                                     :p_ImagenPerfilUsuario, :p_CorreoUsuario, :p_PasswordUsuario, :p_FechaCreacionUsuario, :p_EstadoUsuario, :p_IdRol);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdUsuario"=>$parametrosUsuario->getIdUsuario(), 
                ":p_NombreUsuario"=>$parametrosUsuario->getNombreUsuario(), 
                ":p_ApellidoPaternoUsuario"=>$parametrosUsuario->getApellidoPaternoUsuario(), 
                ":p_ApellidoMaternoUsuario"=>$parametrosUsuario->getApellidoMaternoUsuario(),
                ":p_GeneroUsuario"=>$parametrosUsuario->getGeneroUsuario(),
                ":p_FechaNacimientoUsuario"=>$parametrosUsuario->getFechaNacimientoUsuario(), 
                ":p_ImagenPerfilUsuario"=>$parametrosUsuario->getImagenPerfilUsuario(), 
                ":p_CorreoUsuario"=>$parametrosUsuario->getCorreoUsuario(), 
                ":p_PasswordUsuario"=>$parametrosUsuario->getPasswordUsuario(), 
                ":p_FechaCreacionUsuario"=>$parametrosUsuario->getFechaCreacionUsuario(), 
                ":p_EstadoUsuario"=>$parametrosUsuario->getEstadoUsuario(),
                ":p_IdRol"=>$parametrosUsuario->getIdRol()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
               
                $IdUsuario =General::isExistingRow($filas,"IdUsuario");
                $NombreUsuario =General::isExistingRow($filas,"NombreUsuario"); 
                $ApellidoPaternoUsuario =General::isExistingRow($filas,"ApellidoPaternoUsuario");  
                $ApellidoMaternoUsuario =General::isExistingRow($filas,"ApellidoMaternoUsuario");   
                $GeneroUsuario =General::isExistingRow($filas,"GeneroUsuario");  
                $FechaNacimientoUsuario =General::isExistingRow($filas,"FechaNacimientoUsuario"); 
                $ImagenPerfilUsuario =General::isExistingRow($filas,"ImagenPerfilUsuario");  
                $CorreoUsuario =General::isExistingRow($filas,"CorreoUsuario");
                $PasswordUsuario =General::isExistingRow($filas,"PasswordUsuario");
                $FechaCreacionUsuario =General::isExistingRow($filas,"FechaCreacionUsuario");
                $EstadoUsuario =General::isExistingRow($filas,"EstadoUsuario"); 

                
                $IdRol = null; 
                $TipoRol = null;

                if(isset($filas["IdRol"]))
                    $IdRol = $filas["IdRol"]; 
                
                if(isset($filas["TipoRol"]))
                    $TipoRol = $filas["TipoRol"];

                $listaUsuarios[] = Usuarios_Model::createUsuario($IdUsuario, $NombreUsuario, $ApellidoPaternoUsuario, $ApellidoMaternoUsuario, $GeneroUsuario, $FechaNacimientoUsuario, 
                                                                $ImagenPerfilUsuario, $CorreoUsuario, $PasswordUsuario, $FechaCreacionUsuario, $EstadoUsuario, $IdRol,$TipoRol);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
        	$sentencia->closeCursor();
        }


        return $listaUsuarios;
    }
}

?>