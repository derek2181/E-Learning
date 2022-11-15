USE e_learning_db;

DELIMITER $$
DROP function IF EXISTS f_get_full_user_name$$
CREATE FUNCTION f_get_full_user_name (p_IdUsuario INT)
RETURNS VARCHAR(200)
BEGIN
RETURN (SELECT CONCAT(NombreUsuario,' ', ApellidoPaternoUsuario,' ' , ApellidoMaternoUsuario)
    FROM usuarios
    WHERE IdUsuario = p_IdUsuario);
END$$

DELIMITER ;


DELIMITER $$
DROP function IF EXISTS f_get_porcentaje_calificacion$$
CREATE FUNCTION f_get_porcentaje_calificacion(p_CantidadCalificacionesUtiles INT, p_TodasLasCalificaciones INT) 
RETURNS float
BEGIN
RETURN (SELECT ifnull(p_CantidadCalificacionesUtiles / p_TodasLasCalificaciones * 100, -1));
END$$
DELIMITER ;


DELIMITER $$
DROP function IF EXISTS f_get_progreso_nivel$$
CREATE FUNCTION f_get_progreso_nivel(p_CursoImpartido BIGINT, p_IdNivel BIGINT) 
RETURNS FLOAT
BEGIN

SET @nivelGratis = (	SELECT NivelGratis
								FROM niveles 
							WHERE IdNivel = p_IdNivel);

IF @nivelGratis = 1
	THEN
    RETURN -1;
    
ELSE
	SET @indiceNivelElegido = (	SELECT COUNT(*) 
									FROM niveles 
								WHERE IdNivel <= p_IdNivel 
								AND CursoImpartido = p_CursoImpartido 
								AND NivelGratis = 0);

	SET @totalNivelesPaga = (	SELECT COUNT(*) 
									FROM niveles as NIV
									INNER JOIN cursos as CUR
									ON CUR.IdCurso = NIV.CursoImpartido
									AND CUR.IdCurso = p_CursoImpartido
									AND NIV.NivelGratis = 0);

	RETURN (SELECT @indiceNivelElegido / @totalNivelesPaga * 100);
END IF;

RETURN 0;
END$$
DELIMITER ;




DELIMITER $$
DROP function IF EXISTS f_get_progreso_siguiente$$
CREATE FUNCTION f_get_progreso_siguiente (p_UsuarioComprador BIGINT, p_CursoComprado BIGINT)
RETURNS FLOAT
BEGIN

SET @CantidadNivelesPaga = (	SELECT COUNT(*)
										FROM niveles 
									WHERE CursoImpartido = p_CursoComprado 
									AND NivelGratis = 0);

SET @ProgresoPorNivel = (100 / @CantidadNivelesPaga);

SET @ProgresoActualCompra = (		SELECT COM.ProgresoCursoComprado
									FROM compras as COM
								WHERE COM.CursoComprado = p_CursoComprado
								AND COM.UsuarioComprador = p_UsuarioComprador);

SET @progresoSiguiente = 
	ROUND( @ProgresoPorNivel + @ProgresoActualCompra , 4);
RETURN @progresoSiguiente;
END$$

DELIMITER ;




