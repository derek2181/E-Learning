DROP TRIGGER IF EXISTS editar_curso;

DELIMITER //
CREATE TRIGGER editar_curso
AFTER UPDATE
ON cursos FOR EACH ROW
BEGIN
if(NEW.EstadoCurso=1) THEN
DELETE FROM curscat WHERE curscat.IdCurso=NEW.IdCurso;
END IF;
END;//

DROP TRIGGER IF EXISTS suspender_curso;

DELIMITER //
CREATE TRIGGER suspender_curso
AFTER UPDATE
ON cursos FOR EACH ROW
BEGIN
if(NEW.EstadoCurso=0) THEN

	UPDATE niveles 
		SET EstadoNivel = 0
	WHERE CursoImpartido = NEW.IdCurso;
    
    UPDATE comentarios 
		SET EstadoComentario = 0
	WHERE CursoComentado = NEW.IdCurso;
    
	UPDATE calificaciones 
		SET EstadoCalificacion = 0
	WHERE CursoCalificado = NEW.IdCurso;
    
END IF;
END;//


DROP TRIGGER IF EXISTS suspender_usuario;

DELIMITER //
CREATE TRIGGER suspender_usuario
AFTER UPDATE
ON usuarios FOR EACH ROW
BEGIN
if(NEW.EstadoUsuario = 0) THEN

	UPDATE cursos 
		SET EstadoCurso = 0
	WHERE UsuarioCreador = NEW.IdUsuario;
    
    UPDATE mensajes 
		SET EstadoMensaje = 0
	WHERE UsuarioEnvia = NEW.IdUsuario
    OR UsuarioRecibe = NEW.IdUsuario;
    
	UPDATE calificaciones 
		SET EstadoCalificacion = 0
	WHERE UsuarioCalifico = NEW.IdUsuario;

END IF;
END;//