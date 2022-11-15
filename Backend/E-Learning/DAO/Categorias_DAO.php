<?php


require_once Constants::PROJECT_PATH_INCLUDE . 'Utils/Connection.php';

class Categorias_DAO
{

    public function __construct()
    {
    }
    public static function insertUpdateDeleteCategorias($p_Opc, $parametrosCategoria)
    {
        $con = null;
        $sentencia = null;



        try {
            $con = DBConnection::getConnection();
            $id = 0;
            $sql = 'CALL sp_categorias(:p_Opc, :p_IdCategoria, :p_TituloCategoria, :p_DescripcionCategoria, 
            :p_FechaCreacionCategoria, :p_EstadoCategoria, :p_UsuarioCreador,
            :p_CursosRelacionados);';

            $sentencia = $con->prepare($sql);

            $result = $sentencia->execute(
                array(
                    ":p_Opc" => $p_Opc,
                    ":p_IdCategoria" => $parametrosCategoria->getIdCategoria(),
                    ":p_TituloCategoria" => $parametrosCategoria->getTituloCategoria(),
                    ":p_DescripcionCategoria" => $parametrosCategoria->getDescripcionCategoria(),
                    ":p_FechaCreacionCategoria" => $parametrosCategoria->getFechaCreacionCategoria(),
                    ":p_EstadoCategoria" => $parametrosCategoria->getEstadoCategoria(),
                    ":p_UsuarioCreador" => $parametrosCategoria->getUsuarioCreador(),
                    ":p_CursosRelacionados" => $parametrosCategoria->getCursosRelacionados(),
                    // ":p_returnid"=>"@p_IdInserted" por si se quiere traer un id recien insertado,
                )
            );

            $categoria = $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->GetMessage());
        } finally {
            $sentencia->closeCursor();
        }

        return $categoria;
    }

    public static function getCategorias($p_Opc, $parametrosCategoria)
    {
        $con = null;
        $sentencia = null;

        $listaCategorias = [];

        try {
            $con = DBConnection::getConnection();

            $sql = 'CALL sp_categorias(:p_Opc, :p_IdCategoria, :p_TituloCategoria, :p_DescripcionCategoria, 
            :p_FechaCreacionCategoria, :p_EstadoCategoria, :p_UsuarioCreador,
            :p_CursosRelacionados);';

            $sentencia = $con->prepare($sql);

            $result = $sentencia->execute(
                array(
                    ":p_Opc" => $p_Opc,
                    ":p_IdCategoria" => $parametrosCategoria->getIdCategoria(),
                    ":p_TituloCategoria" => $parametrosCategoria->getTituloCategoria(),
                    ":p_DescripcionCategoria" => $parametrosCategoria->getDescripcionCategoria(),
                    ":p_FechaCreacionCategoria" => $parametrosCategoria->getFechaCreacionCategoria(),
                    ":p_EstadoCategoria" => $parametrosCategoria->getEstadoCategoria(),
                    ":p_UsuarioCreador" => $parametrosCategoria->getUsuarioCreador(),
                    ":p_CursosRelacionados" => $parametrosCategoria->getCursosRelacionados(),
                    // ":p_returnid"=>"@p_IdInserted" por si se quiere traer un id recien insertado,
                )
            );


            while ($filas = $sentencia->fetch(PDO::FETCH_ASSOC)) {

                $IdCategoria = $filas["IdCategoria"];
                $TituloCategoria = $filas["TituloCategoria"];
                $DescripcionCategoria = $filas["DescripcionCategoria"];
                $FechaCreacionCategoria = $filas["FechaCreacionCategoria"];
                $EstadoCategoria = $filas["EstadoCategoria"];
                $UsuarioCreador = $filas["UsuarioCreador"];
                
                $listaCategorias[] = Categorias_Model::createCategorias($IdCategoria, $TituloCategoria, $DescripcionCategoria, $FechaCreacionCategoria, $EstadoCategoria, $UsuarioCreador);
            }
        } catch (Exception $e) {
            die('Error: ' . $e->GetMessage());
        } finally {
            $sentencia->closeCursor();
        }


        return $listaCategorias;
    }
}
