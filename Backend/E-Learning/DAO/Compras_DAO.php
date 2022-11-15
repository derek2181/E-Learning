<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Compras_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteCompras($p_Opc, $parametrosCompras) {
        $con = null;
        $sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_compras(:p_Opc, :p_UsuarioComprador, :p_CursoComprado, :p_FechaCreacionCompra,
                                    :p_ProgresoCursoComprado,:p_FormaPago,:p_Pago,
                                    :p_FechaUltimaVisualizacion, :p_FechaCompletado, :p_NivelCursoComprado);';

            $sentencia = $con->prepare($sql);
    
            $rowsAffectted = $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_UsuarioComprador"=>$parametrosCompras->getUsuarioComprador(), 
                ":p_CursoComprado"=>$parametrosCompras->getCursoComprado(),
                ":p_FechaCreacionCompra"=>$parametrosCompras->getFechaCreacionCompra(),
                ":p_ProgresoCursoComprado"=>$parametrosCompras->getProgresoCursoComprado(),
                ":p_FormaPago"=>$parametrosCompras->getFormaDePago(),
                ":p_Pago"=>$parametrosCompras->getPago(),
                ":p_FechaUltimaVisualizacion"=>$parametrosCompras->getFechaUltimaVisualizacion(),
                ":p_FechaCompletado"=>$parametrosCompras->getFechaCompletado(),
                ":p_NivelCursoComprado"=>$parametrosCompras->getNivelCursoComprado(),
                )
            );
        }   
        catch(PDOException $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
        	//$statement->close();
            //$con->close();
        }

        return $rowsAffectted;
    }

    public static function getCompras($p_Opc, $parametrosCompras)
    {
        $con = null;
        $sentencia = null;
        
        $listaCompras = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_compras(:p_Opc, :p_UsuarioComprador, :p_CursoComprado, :p_FechaCreacionCompra,
                                    :p_ProgresoCursoComprado,:p_FormaPago,:p_Pago,
                                    :p_FechaUltimaVisualizacion, :p_FechaCompletado, :p_NivelCursoComprado);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_UsuarioComprador"=>$parametrosCompras->getUsuarioComprador(), 
                ":p_CursoComprado"=>$parametrosCompras->getCursoComprado(),
                ":p_FechaCreacionCompra"=>$parametrosCompras->getFechaCreacionCompra(),
                ":p_ProgresoCursoComprado"=>$parametrosCompras->getProgresoCursoComprado(),
                ":p_FormaPago"=>$parametrosCompras->getFormaDePago(),
                ":p_Pago"=>$parametrosCompras->getPago(),
                ":p_FechaUltimaVisualizacion"=>$parametrosCompras->getFechaUltimaVisualizacion(),
                ":p_FechaCompletado"=>$parametrosCompras->getFechaCompletado(),
                ":p_NivelCursoComprado"=>$parametrosCompras->getProgresoNivel(),
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $UsuarioComprador = $filas["UsuarioComprador"];
                $CursoComprado = $filas["CursoComprado"];
                $ProgresoCursoComprado = $filas["ProgresoCursoComprado"];
                $FormaPago = $filas["FormaPago"];
                $Pago = $filas["Pago"];
                $FechaCreacionCompra = $filas["FechaCreacionCompra"];
                $FechaUltimaVisualizacion = $filas["FechaUltimaVisualizacion"];
                $FechaCompletado = $filas["FechaCompletado"];

                $listaCompras[] = Compras_Model::createCompras($UsuarioComprador, $CursoComprado, $ProgresoCursoComprado,
                $FormaPago, $Pago, $FechaCreacionCompra, $FechaUltimaVisualizacion, $FechaCompletado);
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
            $sentencia->closeCursor();
        }


        return $listaCompras;
    }
}

?>