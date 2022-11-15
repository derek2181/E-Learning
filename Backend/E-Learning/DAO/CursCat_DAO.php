<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class CursCat_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteCursCat($p_Opc, $parametrosCursCat) {
        $con = null;
        $sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_curscat(:p_Opc, :p_IdCategoria, :p_IdCurso);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdCategoria"=>$parametrosCursCat->getIdCategoria(), 
                ":p_IdCurso"=>$parametrosCursCat->getIdCurso()
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

    public static function getCursCat($p_Opc, $parametrosCursCat)
    {
        $con = null;
        $sentencia = null;
        
        $listaCursCat = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_curscat(:p_Opc, :p_IdCategoria, :p_IdCurso);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdCategoria"=>$parametrosCursCat->getIdCategoria(), 
                ":p_IdCurso"=>$parametrosCursCat->getIdCurso()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $IdCategoria = $filas["IdCategoria"];
                $IdCurso = $filas["IdCurso"];

                $listaCursCat[] = CursCat_Model::createCursCat($IdCategoria, $IdCurso);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
            $sentencia->closeCursor();
        }


        return $listaCursCat;
    }
}

?>