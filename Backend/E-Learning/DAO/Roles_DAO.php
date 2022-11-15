<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Roles_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteRoles($p_Opc, $parametrosRol) {
        $con = null;
        $sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            

            $sql = 'CALL sp_roles(:p_Opc, :p_IdRol, :p_TipoRol);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdRol"=>$parametrosRol->getIdRol(), 
                ":p_TipoRol"=>$parametrosRol->getTipoRol()
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

    public static function getRoles($p_Opc, $parametrosRol)
    {
        $con = null;
        $sentencia = null;
        
        $listaRol = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_roles(:p_Opc, :p_IdRol, :p_TipoRol);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdRol"=>$parametrosRol->getIdRol(), 
                ":p_TipoRol"=>$parametrosRol->getTipoRol()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $IdRol = $filas["IdRol"];
                $TipoRol = $filas["TipoRol"];

                $listaRol[] = Roles_Model::createRoles($IdRol, $TipoRol);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
            $sentencia->closeCursor();
        }


        return $listaRol;
    }
}

?>