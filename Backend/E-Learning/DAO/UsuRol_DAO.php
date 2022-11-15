<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class UsuRol_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteUsuRol($p_Opc, $parametrosUsuRol) {
        $con = null;
        $sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_usurol(:p_Opc, :p_IdUsuario, :p_IdRol);';

            $sentencia = $con->prepare($sql);
    
            $rowsAffectted = $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdUsuario"=>$parametrosUsuRol->getIdUsuario(), 
                ":p_IdRol"=>$parametrosUsuRol->getIdRol()
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

    public static function getUsuRol($p_Opc, $parametrosUsuRol)
    {
        $con = null;
        $sentencia = null;
        
        $listaUsuRol = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_usurol(:p_Opc, :p_IdUsuario, :p_IdRol);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdUsuario"=>$parametrosUsuRol->getIdUsuario(), 
                ":p_IdRol"=>$parametrosUsuRol->getIdRol()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $IdUsuario = $filas["IdUsuario"];
                $IdRol = $filas["IdRol"];

                $listaUsuRol[] = UsuRol_Model::createUsuRol($IdUsuario, $IdRol);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
            $sentencia->closeCursor();
        }


        return $listaUsuRol;
    }
}

?>