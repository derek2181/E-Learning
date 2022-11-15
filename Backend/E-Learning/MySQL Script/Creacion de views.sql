USE e_learning_db;

CREATE  OR REPLACE VIEW v_usuario_rol AS

SELECT U.IdUsuario, U.NombreUsuario, U.ApellidoPaternoUsuario, U.ApellidoMaternoUsuario, U.GeneroUsuario,
				U.FechaNacimientoUsuario, U.ImagenPerfilUsuario, U.CorreoUsuario, U.PasswordUsuario, 
                U.FechaCreacionUsuario, U.EstadoUsuario, R.IdRol, R.TipoRol
			FROM usuarios AS U
		INNER JOIN usurol AS UR
        ON U.IdUsuario = UR.IdUsuario
        INNER JOIN roles AS R
        ON UR.IdRol = R.IdRol;
       

CREATE  OR REPLACE VIEW v_cursos_usuariocreador_calificacion AS
SELECT 	CUR.IdCurso, CUR.TituloCurso, CUR.DescripcionCurso, CUR.ImagenCurso, CUR.CostoCurso
				,CUR.FechaCreacionCurso, CUR.EstadoCurso, CUR.UsuarioCreador 
                
                ,f_get_full_user_name(US.IdUsuario) AS 'NombreCompletoUsuarioCreador'
                ,US.ImagenPerfilUsuario AS 'ImagenPerfilUsuarioCreador'
                ,f_get_porcentaje_calificacion(SUM(CAL.UtilidadCalificacion), count(CAL.CursoCalificado)) AS "PorcentajeCalificacion"
                
			FROM cursos AS CUR
        
		INNER JOIN usuarios AS US
        ON CUR.UsuarioCreador = US.IdUsuario

		LEFT JOIN calificaciones AS CAL
        ON CAL.CursoCalificado = CUR.IdCurso
        AND CAL.EstadoCalificacion = 1
	        
        GROUP BY CUR.IdCurso;
        
        
CREATE  OR REPLACE VIEW v_comentario_usuariocomento AS
	SELECT 	COM.IdComentario, COM.UsuarioComento, COM.CursoComentado 
				,COM.DescripcionComentario, COM.FechaCreacionComentario, COM.EstadoComentario
                
				,f_get_full_user_name(US.IdUsuario) AS 'NombreCompletoUsuarioComento' 
                ,US.ImagenPerfilUsuario AS 'ImagenPerfilUsuarioComento'
                
			FROM comentarios as COM
				
		INNER JOIN usuarios AS US
        ON COM.UsuarioComento = US.IdUsuario
        
        GROUP BY COM.IdComentario;
        
        
CREATE  OR REPLACE VIEW v_mensaje_usuarioenvia_usuariorecibe AS
    SELECT 	MSJ.IdMensaje, MSJ.UsuarioEnvia, MSJ.UsuarioRecibe, MSJ.DescripcionMensaje, MSJ.FechaCreacionMensaje, MSJ.EstadoMensaje
			,f_get_full_user_name(US_ENV.IdUsuario) AS 'NombreUsuarioEnvia' 
            ,US_ENV.ImagenPerfilUsuario AS 'ImagenUsuarioEnvia'
			,f_get_full_user_name(US_REC.IdUsuario) AS 'NombreUsuarioRecibe' 
			,US_REC.ImagenPerfilUsuario AS 'ImagenUsuarioRecibe'
		FROM mensajes AS MSJ 
	        
		INNER JOIN usuarios AS US_ENV
		ON US_ENV.IdUsuario = MSJ.UsuarioEnvia
        
		INNER JOIN usuarios AS US_REC
		ON US_REC.IdUsuario = MSJ.UsuarioRecibe
        
	GROUP BY MSJ.IdMensaje;
    
    
CREATE  OR REPLACE VIEW v_ultimo_mensaje_conversacion AS

	SELECT
			least(UsuarioEnvia, UsuarioRecibe) AS Usuario_1
			,greatest(UsuarioEnvia, UsuarioRecibe) AS Usuario_2
			,max(FechaCreacionMensaje) AS FechaCreacionMensaje
		FROM mensajes
	GROUP BY least(UsuarioEnvia, UsuarioRecibe),
			 greatest(UsuarioEnvia, UsuarioRecibe);
             
CREATE  OR REPLACE VIEW v_categorias_curscat AS

		SELECT cat.IdCategoria, cat.TituloCategoria, cat.DescripcionCategoria, cat.FechaCreacionCategoria, cat.EstadoCategoria, cat.UsuarioCreador
			FROM categorias as cat JOIN curscat as C 
		WHERE cat.IdCategoria= C.IdCategoria  
        GROUP BY IdCategoria;
	
    
