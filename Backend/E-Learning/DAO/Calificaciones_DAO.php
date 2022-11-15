<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Calificaciones_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteCalificaciones($p_Opc, $parametrosCalificaciones) {
        $con = null;
        $sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_calificaciones(:p_Opc, :p_UsuarioCalifico, :p_CursoCalificado, :p_UtilidadCalificacion, 
                                    :p_FechaCreacionCalificacion, :p_EstadoCalificacion);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_UsuarioCalifico"=>$parametrosCalificaciones->getUsuarioCalifico(), 
                ":p_CursoCalificado"=>$parametrosCalificaciones->getCursoCalificado(),
                ":p_UtilidadCalificacion"=>$parametrosCalificaciones->getUtilidadCalificacion(),
                ":p_FechaCreacionCalificacion"=>$parametrosCalificaciones->getFechaCreacionCalificacion(),
                ":p_EstadoCalificacion"=>$parametrosCalificaciones->getEstadoCalificacion()
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

    public static function getCalificaciones($p_Opc, $parametrosCalificaciones)
    {
        $con = null;
        $sentencia = null;
        
        $listaCalificaciones = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_calificaciones(:p_Opc, :p_UsuarioCalifico, :p_CursoCalificado, :p_UtilidadCalificacion, 
                                    :p_FechaCreacionCalificacion, :p_EstadoCalificacion);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_UsuarioCalifico"=>$parametrosCalificaciones->getUsuarioCalifico(), 
                ":p_CursoCalificado"=>$parametrosCalificaciones->getCursoCalificado(),
                ":p_UtilidadCalificacion"=>$parametrosCalificaciones->getUtilidadCalificacion(),
                ":p_FechaCreacionCalificacion"=>$parametrosCalificaciones->getFechaCreacionCalificacion(),
                ":p_EstadoCalificacion"=>$parametrosCalificaciones->getEstadoCalificacion()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $UsuarioCalifico = $filas["UsuarioCalifico"];
                $CursoCalificado = $filas["CursoCalificado"];
                $UtilidadCalificacion = $filas["UtilidadCalificacion"];
                $FechaCreacionCalificacion = $filas["FechaCreacionCalificacion"];
                $EstadoCalificacion = $filas["EstadoCalificacion"];

                $listaCalificaciones[] = Calificaciones_Model::createCalificaciones($UsuarioCalifico, $CursoCalificado, $UtilidadCalificacion, 
                                                                $FechaCreacionCalificacion, $EstadoCalificacion);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
            $sentencia->closeCursor();
        }


        return $listaCalificaciones;
    }
}

?>