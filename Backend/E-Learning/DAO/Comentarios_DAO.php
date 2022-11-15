<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Comentarios_DAO {

    public function __construct(){

    }
    public static function insertUpdateDeleteComentarios($p_Opc, $parametrosComentarios) {
        $con = null;
        $sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_comentarios(:p_Opc, :p_IdComentario, :p_UsuarioComento,:p_CursoComentado, :p_DescripcionComentario, 
                                    :p_FechaCreacionComentario, :p_EstadoComentario, :p_NumeroComentarioPaginacion);';

            $sentencia = $con->prepare($sql);
    
            $rowsAffectted = $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdComentario"=>$parametrosComentarios->getIdComentario(), 
                ":p_UsuarioComento"=>$parametrosComentarios->getUsuarioComento(), 
                ":p_CursoComentado"=>$parametrosComentarios->getCursoComentado(),
                ":p_DescripcionComentario"=>$parametrosComentarios->getDescripcionComentario(),
                ":p_FechaCreacionComentario"=>$parametrosComentarios->getFechaCreacionComentario(),
                ":p_EstadoComentario"=>$parametrosComentarios->getEstadoComentario(),
                ":p_NumeroComentarioPaginacion"=>$parametrosComentarios->getNumeroComentarioPaginacion()
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

    public static function getComentarios($p_Opc, $parametrosComentarios)
    {
        $con = null;
        $sentencia = null;
        
        $listaComentarios = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_comentarios(:p_Opc, :p_IdComentario, :p_UsuarioComento,:p_CursoComentado, :p_DescripcionComentario, 
                                    :p_FechaCreacionComentario, :p_EstadoComentario, :p_NumeroComentarioPaginacion);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdComentario"=>$parametrosComentarios->getIdComentario(), 
                ":p_UsuarioComento"=>$parametrosComentarios->getUsuarioComento(), 
                ":p_CursoComentado"=>$parametrosComentarios->getCursoComentado(),
                ":p_DescripcionComentario"=>$parametrosComentarios->getDescripcionComentario(),
                ":p_FechaCreacionComentario"=>$parametrosComentarios->getFechaCreacionComentario(),
                ":p_EstadoComentario"=>$parametrosComentarios->getEstadoComentario(),
                ":p_NumeroComentarioPaginacion"=>$parametrosComentarios->getNumeroComentarioPaginacion()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $IdUsuario = $filas["IdComentario"];
                $UsuarioComento = $filas["UsuarioComento"];
                $CursoComentado = $filas["CursoComentado"];
                $DescripcionComentario = $filas["DescripcionComentario"];
                $FechaCreacionComentario = $filas["FechaCreacionComentario"];
                $EstadoComentario = $filas["EstadoComentario"];

                $NombreCompletoUsuarioComento = null;
                $ImagenPerfilUsuarioComento = null;

                if(isset($filas["NombreCompletoUsuarioComento"]))
                $NombreCompletoUsuarioComento = $filas["NombreCompletoUsuarioComento"];

                if(isset($filas["ImagenPerfilUsuarioComento"]))
                $ImagenPerfilUsuarioComento = $filas["ImagenPerfilUsuarioComento"];

                $listaComentarios[] = Comentarios_Model::createComentarios($IdUsuario, $UsuarioComento, $CursoComentado, $DescripcionComentario, 
                                                                $FechaCreacionComentario, $EstadoComentario,
                                                                $NombreCompletoUsuarioComento, $ImagenPerfilUsuarioComento);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
            $sentencia->closeCursor();
        }


        return $listaComentarios;
    }
}

?>