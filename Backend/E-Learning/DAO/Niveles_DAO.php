<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Niveles_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteNiveles($p_Opc, $parametrosNivel) {
    	$con = null;
    	$sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_niveles(:p_Opc, :p_IdNivel, :p_TituloNivel, :p_PathVideoNivel, :p_ContenidoNivel, :p_PathPDFNivel, 
                                    :p_NivelGratis, :p_FechaCreacionNivel, :p_EstadoNivel, :p_CursoImpartido);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdNivel"=>$parametrosNivel->getIdNivel(), 
                ":p_TituloNivel"=>$parametrosNivel->getTituloNivel(), 
                ":p_PathVideoNivel"=>$parametrosNivel->getPathVideoNivel(),
                ":p_ContenidoNivel"=>$parametrosNivel->getContenidoNivel(), 
                ":p_PathPDFNivel"=>$parametrosNivel->getPathPDFNivel(), 
                ":p_NivelGratis"=>$parametrosNivel->getNivelGratis(), 
                ":p_FechaCreacionNivel"=>$parametrosNivel->getFechaCreacionNivel(), 
                ":p_EstadoNivel"=>$parametrosNivel->getEstadoNivel(), 
                ":p_CursoImpartido"=>$parametrosNivel->getCursoImpartido()
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

    public static function getNiveles($p_Opc, $parametrosNivel)
     {
        $con = null;
    	$sentencia = null;
        
        $listaNivel = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_niveles(:p_Opc, :p_IdNivel, :p_TituloNivel, :p_PathVideoNivel, :p_ContenidoNivel, :p_PathPDFNivel, 
                                    :p_NivelGratis, :p_FechaCreacionNivel, :p_EstadoNivel, :p_CursoImpartido);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdNivel"=>$parametrosNivel->getIdNivel(), 
                ":p_TituloNivel"=>$parametrosNivel->getTituloNivel(), 
                ":p_PathVideoNivel"=>$parametrosNivel->getPathVideoNivel(),
                ":p_ContenidoNivel"=>$parametrosNivel->getContenidoNivel(), 
                ":p_PathPDFNivel"=>$parametrosNivel->getPathPDFNivel(), 
                ":p_NivelGratis"=>$parametrosNivel->getNivelGratis(), 
                ":p_FechaCreacionNivel"=>$parametrosNivel->getFechaCreacionNivel(), 
                ":p_EstadoNivel"=>$parametrosNivel->getEstadoNivel(), 
                ":p_CursoImpartido"=>$parametrosNivel->getCursoImpartido()
                )
            );

            
            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $IdNivel = $filas["IdNivel"];
                $TituloNivel = $filas["TituloNivel"];
                $PathVideoNivel = $filas["PathVideoNivel"];
                $ContenidoNivel = $filas["ContenidoNivel"];
                $PathPDFNivel = $filas["PathPDFNivel"];
                $NivelGratis = $filas["NivelGratis"];
                $FechaCreacionNivel = $filas["FechaCreacionNivel"];
                $EstadoNivel = $filas["EstadoNivel"];
                $CursoImpartido = $filas["CursoImpartido"];

                $ProgresoNivel = null;
                if(isset($filas["ProgresoNivel"]))
                $ProgresoNivel =  $filas["ProgresoNivel"];
                

                $listaNivel[] = Niveles_Model::createNiveles(   $IdNivel, $TituloNivel, $PathVideoNivel, $ContenidoNivel, $PathPDFNivel, 
                                                                $NivelGratis, $FechaCreacionNivel, $EstadoNivel, $CursoImpartido, $ProgresoNivel);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
        	$sentencia->closeCursor();
        }


        return $listaNivel;
    }
}

?>