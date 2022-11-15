<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/General.php';

// require_once '../Utils/Connection.php';
// require_once '../Utils/General.php';

class Cursos_DAO{

    public function __construct(){

    }
    public static function insertUpdateDeleteCursos($p_Opc, $parametrosCurso) {
    	$con = null;
    	$sentencia = null;

        $rowsAffectted = 0;

        try {
            $con = DBConnection::getConnection();
            
            $sql = 'CALL sp_cursos(:p_Opc, :p_IdCurso, :p_TituloCurso, :p_DescripcionCurso, :p_ImagenCurso, :p_CostoCurso,
                                    :p_FechaCreacionCurso, :p_EstadoCurso, :p_UsuarioCreador, :p_UsuarioComprador, :p_NombreCompletoUsuario, :p_NumeroCursoPaginacion, 
                                    :p_CategoriaFiltro, :p_FechaDesdeCreacionCurso, :p_FechaHastaCreacionCurso, :p_IdRolUsuario);';

            $sentencia = $con->prepare($sql);
    
            $sentencia->bindParam(':p_Opc', $p_Opc);
            $sentencia->bindParam(':p_IdCurso', $parametrosCurso->getIdCurso());
            $sentencia->bindParam(':p_TituloCurso', $parametrosCurso->getTituloCurso());
            $sentencia->bindParam(':p_DescripcionCurso', $parametrosCurso->getDescripcionCurso());
            $sentencia->bindParam(':p_ImagenCurso', $parametrosCurso->getImagenCurso());
            $sentencia->bindParam(':p_CostoCurso', $parametrosCurso->getCostoCurso());
            $sentencia->bindParam(':p_FechaCreacionCurso', $parametrosCurso->getFechaCreacionCurso());
            $sentencia->bindParam(':p_EstadoCurso', $parametrosCurso->getEstadoCurso());
            $sentencia->bindParam(':p_UsuarioCreador', $parametrosCurso->getUsuarioCreador());

            $param = null;
            if( $parametrosCurso->getCompraCurso() != null) 
                $param = $parametrosCurso->getCompraCurso()->getUsuarioComprador();
            else
                $param = null;

            $sentencia->bindParam(':p_UsuarioComprador', $param);
            
            $sentencia->bindParam(':p_NombreCompletoUsuario', $parametrosCurso->getNombreCompletoUsuario());

            $sentencia->bindParam(':p_NumeroCursoPaginacion', $parametrosCurso->getNumeroCursoPaginacion());
            $sentencia->bindParam(':p_CategoriaFiltro', $parametrosCurso->getCategoriaFiltro());
            $sentencia->bindParam(':p_FechaDesdeCreacionCurso', $parametrosCurso->getFechaDesdeCreacionCurso());
            $sentencia->bindParam(':p_FechaHastaCreacionCurso', $parametrosCurso->getFechaHastaCreacionCurso());

            $sentencia->bindParam(':p_IdRolUsuario', $parametrosCurso->getIdRolUsuario());

            
            $rowsAffectted = $sentencia->execute();
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



    public static function getCursos($p_Opc, $parametrosCurso)
     {
        $con = null;
    	$sentencia = null;
        
        $listaCursos = [];

        try {     
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_cursos(:p_Opc, :p_IdCurso, :p_TituloCurso, :p_DescripcionCurso, :p_ImagenCurso, :p_CostoCurso,
                                    :p_FechaCreacionCurso, :p_EstadoCurso, :p_UsuarioCreador, :p_UsuarioComprador, :p_NombreCompletoUsuario, :p_NumeroCursoPaginacion, 
                                    :p_CategoriaFiltro, :p_FechaDesdeCreacionCurso, :p_FechaHastaCreacionCurso, :p_IdRolUsuario);';

            
            $sentencia = $con->prepare($sql);
            
            $CursoCompraCurso = null;
            if( $parametrosCurso->getCompraCurso() != null) 
                $CursoCompraCurso = $parametrosCurso->getCompraCurso();
           

            $sentencia->execute(
                array(
                ":p_Opc"=>$p_Opc, 
                ":p_IdCurso"=>$parametrosCurso->getIdCurso(), 
                ":p_TituloCurso"=>$parametrosCurso->getTituloCurso(), 
                ":p_DescripcionCurso"=>$parametrosCurso->getDescripcionCurso(), 
                ":p_ImagenCurso"=>$parametrosCurso->getImagenCurso(),
                ":p_CostoCurso"=>$parametrosCurso->getCostoCurso(),
                ":p_FechaCreacionCurso"=>$parametrosCurso->getFechaCreacionCurso(), 
                ":p_EstadoCurso"=>$parametrosCurso->getEstadoCurso(), 
                ":p_UsuarioCreador"=>$parametrosCurso->getUsuarioCreador(),
                ":p_UsuarioComprador"=>$CursoCompraCurso==null ? null : $CursoCompraCurso->getUsuarioComprador() ,
                ":p_NombreCompletoUsuario"=>$parametrosCurso->getNombreCompletoUsuario(),
                ":p_NumeroCursoPaginacion"=>$parametrosCurso->getNumeroCursoPaginacion(),
                ":p_CategoriaFiltro"=>$parametrosCurso->getCategoriaFiltro(),
                ":p_FechaDesdeCreacionCurso"=>$parametrosCurso->getFechaDesdeCreacionCurso(),
                ":p_FechaHastaCreacionCurso"=>$parametrosCurso->getFechaHastaCreacionCurso(),
                ":p_IdRolUsuario"=>$parametrosCurso->getIdRolUsuario()
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                
                $IdCurso =  General::isExistingRow($filas,"IdCurso");
                $TituloCurso =  General::isExistingRow($filas,"TituloCurso");
                $DescripcionCurso =  General::isExistingRow($filas,"DescripcionCurso");
                $ImagenCurso =  General::isExistingRow($filas,"ImagenCurso");
                $CostoCurso =  General::isExistingRow($filas,"CostoCurso");
                $FechaCreacionCurso = General::isExistingRow($filas,"FechaCreacionCurso");
                $EstadoCurso = General::isExistingRow($filas,"EstadoCurso");
               
                $UsuarioCreador = General::isExistingRow($filas,"UsuarioCreador");
                $NombreCompletoUsuarioCreador = null;
                $ImagenPerfilUsuarioCreador = null;
                $PorcentajeCalificacion = null;
                



                $IngresosPayPal=General::isExistingRow($filas,"IngresosPayPal");
                $IngresosTarjeta=General::isExistingRow($filas,"IngresosTarjeta");


                $NivelPromedio= General::isExistingRow($filas,"NivelPromedio");
                $CantidadDeAlumnos=General::isExistingRow($filas,"CantidadDeAlumnos");
                $TotalDeIngresos=General::isExistingRow($filas,"TotalDeIngresos");

              
                $NombreCompletoUsuarioCreador = General::isExistingRow($filas,"NombreCompletoUsuarioCreador");

               
                $ImagenPerfilUsuarioCreador =General::isExistingRow($filas,"ImagenPerfilUsuarioCreador");

               
                $PorcentajeCalificacion = General::isExistingRow($filas,"PorcentajeCalificacion");


                

                $UsuarioComprador = null;
                $CursoComprado = null;
                $FechaCreacionCompra = null;
                $ProgresoCursoComprado = null;
                $FechaUltimaVisualizacion = null;
                $FechaCompletado = null;
                $NombreCompletoUsuarioComprador = null;
                $Pago=null;
              
              
                $UsuarioComprador = General::isExistingRow($filas,"UsuarioComprador");

              
                $CursoComprado =  General::isExistingRow($filas,"CursoComprado");

                $Pago =  General::isExistingRow($filas,"Pago");
                $FechaCreacionCompra =General::isExistingRow($filas,"FechaCreacionCompra");

               
                $ProgresoCursoComprado = General::isExistingRow($filas,"ProgresoCursoComprado");

              
                $FechaUltimaVisualizacion = General::isExistingRow($filas,"FechaUltimaVisualizacion");
              
                $FechaCompletado = General::isExistingRow($filas,"FechaCompletado");
                $FormaDePago=General::isExistingRow($filas,"FormaPago");
             
                $NombreCompletoUsuarioComprador = General::isExistingRow($filas,"NombreCompletoUsuarioComprador");

                $compraCurso = Compras_Model::createCompras($UsuarioComprador, $CursoComprado,$ProgresoCursoComprado,
                $FormaDePago, $Pago, $FechaCreacionCompra, $FechaUltimaVisualizacion,$FechaCompletado, $NombreCompletoUsuarioComprador);

                $listaCursos[] = Cursos_Model::createCurso($IdCurso, $TituloCurso, $DescripcionCurso, $ImagenCurso, $CostoCurso,
                                                            $FechaCreacionCurso, $EstadoCurso, $UsuarioCreador,
                                                            $NombreCompletoUsuarioCreador, $ImagenPerfilUsuarioCreador,
                                                            $PorcentajeCalificacion,
                                                            null,
                                                            null,
                                                            null,
                                                            null,
                                                            null,
                                                            $compraCurso,
                                                            null,
                                                            $NivelPromedio,
                                                            $CantidadDeAlumnos,
                                                            $TotalDeIngresos,
                                                            $IngresosPayPal,
                                                            $IngresosTarjeta
                                                        );
                                                        
                
            }
        } catch(Exception $e){
            die('Error: ' . $e->GetMessage());
        } 
        finally {
        	$sentencia->closeCursor();
        }


        return $listaCursos;
    }

}

?>