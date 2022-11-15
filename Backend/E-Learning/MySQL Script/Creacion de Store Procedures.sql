USE e_learning_db;


DROP procedure IF EXISTS sp_usuarios;
DELIMITER $$
CREATE PROCEDURE sp_usuarios (
	IN p_Opc						varchar(30),
	IN p_IdUsuario 					bigint,
	IN p_NombreUsuario 				varchar(30),
	IN p_ApellidoPaternoUsuario 	varchar(30),
	IN p_ApellidoMaternoUsuario 	varchar(30),
    IN p_GeneroUsuario 				varchar(30),
	IN p_FechaNacimientoUsuario 	date,
	IN p_ImagenPerfilUsuario 		mediumblob,
	IN p_CorreoUsuario 				varchar(60),
	IN p_PasswordUsuario 			varchar(30),
	IN p_FechaCreacionUsuario 		datetime,
	IN p_EstadoUsuario 				tinyint(1),
	IN p_IdRol						int
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO usuarios(	NombreUsuario, ApellidoPaternoUsuario, ApellidoMaternoUsuario, GeneroUsuario, 
								FechaNacimientoUsuario, ImagenPerfilUsuario, CorreoUsuario, PasswordUsuario)
			VALUES(		p_NombreUsuario, p_ApellidoPaternoUsuario, p_ApellidoMaternoUsuario, p_GeneroUsuario,
					p_FechaNacimientoUsuario, p_ImagenPerfilUsuario, p_CorreoUsuario, p_PasswordUsuario);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE usuarios
			SET NombreUsuario = IF(p_NombreUsuario IS NULL,NombreUsuario,p_NombreUsuario),
				ApellidoPaternoUsuario = IF(p_ApellidoPaternoUsuario IS NULL,ApellidoPaternoUsuario,p_ApellidoPaternoUsuario),				
                ApellidoMaternoUsuario =IF(p_ApellidoMaternoUsuario IS NULL,ApellidoMaternoUsuario,p_ApellidoMaternoUsuario),
                GeneroUsuario = IF(p_GeneroUsuario IS NULL,GeneroUsuario,p_GeneroUsuario),
				FechaNacimientoUsuario =  IF(p_FechaNacimientoUsuario IS NULL,FechaNacimientoUsuario,p_FechaNacimientoUsuario),
				ImagenPerfilUsuario= IF(p_ImagenPerfilUsuario is null, ImagenPerfilUsuario, p_ImagenPerfilUsuario), 
                CorreoUsuario =IF(p_CorreoUsuario IS NULL,CorreoUsuario,p_CorreoUsuario),
				PasswordUsuario = IF(p_PasswordUsuario IS NULL, PasswordUsuario, p_PasswordUsuario)
			WHERE IdUsuario = p_IdUsuario;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM usuarios
		WHERE IdUsuario = p_IdUsuario;	
	END IF;
    
    IF p_Opc = 'SuspenderUsuario'
	THEN
		UPDATE usuarios
			SET 
				EstadoUsuario = 0
			WHERE IdUsuario = p_IdUsuario;
	END IF;

	IF p_Opc = 'S'
	THEN
		SELECT IdUsuario, NombreUsuario, ApellidoPaternoUsuario, ApellidoMaternoUsuario, GeneroUsuario,
				FechaNacimientoUsuario, ImagenPerfilUsuario, CorreoUsuario, PasswordUsuario, 
                FechaCreacionUsuario, EstadoUsuario
			FROM usuarios
		WHERE IdUsuario = p_IdUsuario;
	END IF;
    
	IF p_Opc = 'UsuarioByIdUsuario'
	THEN
     SELECT vUR.IdUsuario, vUR.NombreUsuario, vUR.ApellidoPaternoUsuario, vUR.ApellidoMaternoUsuario, vUR.GeneroUsuario,
				vUR.FechaNacimientoUsuario, vUR.ImagenPerfilUsuario, vUR.CorreoUsuario, vUR.PasswordUsuario, 
                vUR.FechaCreacionUsuario, vUR.EstadoUsuario, vUR.IdRol, vUR.TipoRol
			FROM v_usuario_rol AS vUR
		WHERE vUR.IdUsuario = p_IdUsuario;
	END IF;
    
	IF p_Opc = 'UsuarioByIdUsuarioIdRol'
	THEN
    
    SELECT vUR.IdUsuario, vUR.NombreUsuario, vUR.ApellidoPaternoUsuario, vUR.ApellidoMaternoUsuario, vUR.GeneroUsuario,
				vUR.FechaNacimientoUsuario, vUR.ImagenPerfilUsuario, vUR.CorreoUsuario, vUR.PasswordUsuario, 
                vUR.FechaCreacionUsuario, vUR.EstadoUsuario, vUR.IdRol, vUR.TipoRol
			FROM v_usuario_rol AS vUR
		
		WHERE vUR.IdUsuario = p_IdUsuario
        AND vUR.IdRol = p_IdRol;
	END IF;

	IF p_Opc = 'UsuarioByCorreoPw'
	THEN
		SELECT IdUsuario, NombreUsuario, ApellidoPaternoUsuario, ApellidoMaternoUsuario, GeneroUsuario,
				FechaNacimientoUsuario, ImagenPerfilUsuario, CorreoUsuario, PasswordUsuario, 
                FechaCreacionUsuario, EstadoUsuario
			FROM usuarios 
		WHERE BINARY  CorreoUsuario = BINARY p_CorreoUsuario
        AND BINARY PasswordUsuario = BINARY p_PasswordUsuario;
	END IF;
	IF p_Opc = 'UsuarioByCorreoPwFacebook'
	THEN
		SELECT IdUsuario, NombreUsuario, ApellidoPaternoUsuario, ApellidoMaternoUsuario, GeneroUsuario,
				FechaNacimientoUsuario, ImagenPerfilUsuario, CorreoUsuario, PasswordUsuario, 
                FechaCreacionUsuario, EstadoUsuario
			FROM usuarios 
		WHERE BINARY  CorreoUsuario = BINARY p_CorreoUsuario
        AND PasswordUsuario is null;
	END IF;
	IF p_Opc = 'UsuarioByCorreo'
		THEN
			SELECT IdUsuario, NombreUsuario, ApellidoPaternoUsuario, ApellidoMaternoUsuario, GeneroUsuario,
					FechaNacimientoUsuario, ImagenPerfilUsuario, CorreoUsuario, PasswordUsuario, 
					FechaCreacionUsuario, EstadoUsuario
				FROM usuarios 
			WHERE BINARY  CorreoUsuario = BINARY p_CorreoUsuario;
	END IF;
	IF p_Opc = 'Login'
	THEN

	SELECT vUR.IdUsuario, vUR.NombreUsuario, vUR.ApellidoPaternoUsuario, vUR.ApellidoMaternoUsuario, vUR.GeneroUsuario,
				vUR.FechaNacimientoUsuario, vUR.ImagenPerfilUsuario, vUR.CorreoUsuario, vUR.PasswordUsuario, 
                vUR.FechaCreacionUsuario, vUR.EstadoUsuario
                #, vUR.IdRol, vUR.TipoRol
			FROM v_usuario_rol AS vUR
		WHERE BINARY  vUR.CorreoUsuario = BINARY p_CorreoUsuario
        AND BINARY vUR.PasswordUsuario = BINARY p_PasswordUsuario
        AND vUR.IdRol = p_IdRol;
	END IF;
    
	IF p_Opc = 'X'
	THEN
		SELECT IdUsuario, NombreUsuario, ApellidoPaternoUsuario, ApellidoMaternoUsuario, GeneroUsuario,
				FechaNacimientoUsuario, ImagenPerfilUsuario, CorreoUsuario, PasswordUsuario, 
                FechaCreacionUsuario, EstadoUsuario
			FROM usuarios;
		
	END IF;
    
    IF p_Opc = 'ValidarCorreoRepetido'
    THEN
		SELECT 1 as 'CorreoUsuarioEncontrado'
        FROM usuarios
        WHERE CorreoUsuario = p_CorreoUsuario;
    END IF;

	IF p_Opc = 'ValidarContrasenaCorrecta'
    THEN
		SELECT 1 as 'UsuarioEncontrado'
        FROM usuarios
        WHERE IdUsuario = p_IdUsuario AND BINARY PasswordUsuario = BINARY p_PasswordUsuario;
    END IF;
END$$

DELIMITER ;



DROP procedure IF EXISTS sp_cursos;
DELIMITER $$
CREATE PROCEDURE sp_cursos (
	IN p_Opc						varchar(30),
	IN p_IdCurso 					bigint,
	IN p_TituloCurso 				varchar(100),
	IN p_DescripcionCurso	 		varchar(800),
	IN p_ImagenCurso 				mediumblob,
    IN p_CostoCurso					decimal(19,2),
	IN p_FechaCreacionCurso	 		datetime,
	IN p_EstadoCurso 				tinyint(1),
	IN p_UsuarioCreador 			bigint,
    IN p_UsuarioComprador 			bigint,
    IN p_NombreCompletoUsuario	 	varchar(100),
    IN p_NumeroCursoPaginacion		int,
    IN p_CategoriaFiltro			int,
    IN p_FechaDesdeCreacionCurso	datetime,
    IN p_FechaHastaCreacionCurso 	datetime,
    IN p_IdRolUsuario				bigint
    
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO cursos(TituloCurso, DescripcionCurso, ImagenCurso, CostoCurso, UsuarioCreador)
			VALUES(p_TituloCurso, p_DescripcionCurso, p_ImagenCurso, p_CostoCurso, p_UsuarioCreador);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE cursos
			SET TituloCurso = p_TituloCurso,
				DescripcionCurso = p_DescripcionCurso,	
				ImagenCurso = IF(p_ImagenCurso is null, ImagenCurso, p_ImagenCurso),
                CostoCurso = p_CostoCurso
			WHERE IdCurso = p_IdCurso;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		UPDATE cursos
        SET EstadoCurso=0 
        WHERE IdCurso=p_IdCurso;
	END IF;
    
	IF p_Opc = 'S'
	THEN
		SELECT IdCurso, TituloCurso, DescripcionCurso, ImagenCurso, CostoCurso, FechaCreacionCurso, EstadoCurso, UsuarioCreador
			FROM cursos
		WHERE IdCurso = p_IdCurso;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT IdCurso, TituloCurso, DescripcionCurso, ImagenCurso, CostoCurso, FechaCreacionCurso, EstadoCurso, UsuarioCreador
			FROM cursos;
		
	END IF;
    
    IF p_Opc = 'BuscarCurso'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,vCUC.PorcentajeCalificacion
                
                ,COM.UsuarioComprador, COM.CursoComprado 
                ,COM.FechaCreacionCompra, COM.ProgresoCursoComprado
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
		
        LEFT JOIN compras AS COM
        ON vCUC.IdCurso = COM.CursoComprado 
        AND COM.UsuarioComprador = IFNULL(p_UsuarioComprador, -1)
        
		WHERE vCUC.IdCurso = p_IdCurso
        GROUP BY vCUC.IdCurso;

    END IF;
    
	IF p_Opc = 'MiCursoCreado'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
		WHERE vCUC.IdCurso = p_IdCurso
        AND vCUC.UsuarioCreador = p_UsuarioCreador;
    END IF;

	IF p_Opc = 'BusquedaAvanzada'
    THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,vCUC.PorcentajeCalificacion
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
        INNER JOIN curscat AS CC
        ON vCUC.IdCurso = CC.IdCurso
        
        WHERE IF(p_TituloCurso IS NULL, 1, vCUC.TituloCurso LIKE CONCAT('%', p_TituloCurso, '%')	)
        AND   IF(IFNULL(p_CategoriaFiltro , -1) = -1, 1, CC.IdCategoria = p_CategoriaFiltro )
        AND   IF(IFNULL(p_NombreCompletoUsuario , -1) = -1, 1, vCUC.NombreCompletoUsuarioCreador = p_NombreCompletoUsuario )
        AND   IF(p_FechaDesdeCreacionCurso is null, 1, vCUC.FechaCreacionCurso >= p_FechaDesdeCreacionCurso) 
        AND   IF(p_FechaHastaCreacionCurso is null, 1, vCUC.FechaCreacionCurso <=  DATE_ADD(p_FechaHastaCreacionCurso,INTERVAL 1 DAY))
        AND   vCUC.EstadoCurso = 1
        
        GROUP BY vCUC.IdCurso
        ORDER BY vCUC.FechaCreacionCurso DESC 
		LIMIT p_NumeroCursoPaginacion, 4;
	END IF;
    
    IF p_Opc = 'CursosByUsuarioCreador'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
		WHERE vCUC.UsuarioCreador = p_UsuarioCreador
        ORDER BY vCUC.FechaCreacionCurso DESC
        LIMIT 1;
	END IF;
    
	IF p_Opc = 'CursosMayorCalificados'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,vCUC.PorcentajeCalificacion
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
		WHERE vCUC.EstadoCurso = 1
        #AND IF(IFNULL(p_UsuarioCreador , -1) = -1, 1, vCUC.UsuarioCreador = p_UsuarioCreador )
        
        GROUP BY vCUC.IdCurso
        ORDER BY vCUC.PorcentajeCalificacion DESC
		LIMIT 0, 12;
	END IF;
    
	IF p_Opc = 'CursosMasVendidos'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,vCUC.PorcentajeCalificacion
                
                ,count(DISTINCT COM.UsuarioComprador, COM.CursoComprado) AS "CantVecesComprado"
                
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
        LEFT JOIN compras AS COM
        ON COM.CursoComprado = vCUC.IdCurso
        
		WHERE vCUC.EstadoCurso = 1
		#AND   IF(IFNULL(p_UsuarioCreador , -1) = -1, 1, vCUC.UsuarioCreador = p_UsuarioCreador )
        
        GROUP BY vCUC.IdCurso
        ORDER BY CantVecesComprado DESC
		LIMIT 0, 12;
	END IF;
    
	IF p_Opc = 'CursosMasRecientes'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,vCUC.PorcentajeCalificacion
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
		WHERE vCUC.EstadoCurso = 1
        #AND   IF(IFNULL(p_UsuarioCreador , -1) = -1, 1, vCUC.UsuarioCreador = p_UsuarioCreador )
        
        GROUP BY vCUC.IdCurso
        ORDER BY vCUC.FechaCreacionCurso DESC
        
		LIMIT 0, 12;
	END IF;
	
	IF p_Opc='IngresosPorPago'
    THEN 
       SELECT   SUM(CASE 
             WHEN FP.FormaPago = 'PayPal' THEN COM.Pago
             ELSE 0
           END) AS IngresosPayPal ,
          SUM(CASE 
             WHEN FP.FormaPago = 'Tarjeta' THEN COM.Pago
             ELSE 0
           END) AS IngresosTarjeta ,
           SUM(COM.Pago) AS TotalDeIngresos 
           
           FROM cursos as CUR 
			JOIN compras as COM 
			ON CUR.IdCurso=COM.CursoComprado
            INNER JOIN forma_pago as FP
            ON FP.IdFormaPago = COM.FormaPago
			WHERE CUR.UsuarioCreador =p_UsuarioCreador;
	END IF;
    
	IF p_Opc = 'MisCursosCreados'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                ,CAST(ifnull(AVG(COM.ProgresoCursoComprado) , 0) AS DECIMAL(10,2)) as NivelPromedio
                ,count(DISTINCT COM.UsuarioComprador, COM.CursoComprado) as CantidadDeAlumnos
                ,ifnull(COM.Pago * count(DISTINCT COM.UsuarioComprador, COM.CursoComprado), 0) AS TotalDeIngresos 
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
        
		LEFT JOIN compras AS COM
        ON vCUC.IdCurso = COM.CursoComprado
		
        WHERE vCUC.UsuarioCreador =  p_UsuarioCreador
        GROUP BY vCUC.IdCurso
		LIMIT p_NumeroCursoPaginacion, 4;
        
	END IF;   
	

	IF p_Opc = 'TodosMisCursosCreados'
	THEN
			SELECT 	 
				CUR.IdCurso
                ,CUR.TituloCurso 
				,CAST(ifnull(AVG(COM.ProgresoCursoComprado) , 0) AS DECIMAL(10,2)) as NivelPromedio
                ,count(DISTINCT COM.UsuarioComprador, COM.CursoComprado) as CantidadDeAlumnos
                ,ifnull(COM.Pago * count(DISTINCT COM.UsuarioComprador, COM.CursoComprado), 0) AS TotalDeIngresos  
			FROM cursos as CUR
		
		LEFT JOIN compras AS COM
        ON CUR.IdCurso = COM.CursoComprado
		
        WHERE CUR.UsuarioCreador = p_UsuarioCreador
        GROUP BY CUR.IdCurso;
	END IF;  

    IF p_Opc = 'StudentsByCourse'
		THEN
			SELECT f_get_full_user_name(USU.IdUsuario) as NombreCompletoUsuarioComprador , 
				COM.FechaCreacionCompra, COM.ProgresoCursoComprado, COM.Pago, FP.FormaPago 
				FROM usuarios as USU 
				JOIN compras as COM 
				ON USU.IdUsuario=COM.UsuarioComprador
                JOIN forma_pago as FP
				ON FP.IdFormaPago=COM.FormaPago
			WHERE COM.CursoComprado= p_IdCurso;
	END IF;
	

	IF p_Opc = 'MisCursosComprados'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,vCUC.PorcentajeCalificacion
                
                ,COM.UsuarioComprador, COM.CursoComprado 
                ,COM.FechaCreacionCompra, COM.ProgresoCursoComprado
                ,COM.FechaCompletado, COM.FechaUltimaVisualizacion
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
		INNER JOIN compras AS COM
        ON vCUC.IdCurso = COM.CursoComprado
        
		WHERE COM.UsuarioComprador = p_UsuarioComprador
        AND vCUC.EstadoCurso = 1
        
        GROUP BY vCUC.IdCurso
		LIMIT p_NumeroCursoPaginacion, 4;
	END IF;    
    
    IF p_Opc = 'TodosMisCursosComprados'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,vCUC.PorcentajeCalificacion
                
                ,COM.UsuarioComprador, COM.CursoComprado 
                ,COM.FechaCreacionCompra, COM.ProgresoCursoComprado
				,COM.FechaCompletado, COM.FechaUltimaVisualizacion
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
        
		INNER JOIN compras AS COM
        ON vCUC.IdCurso = COM.CursoComprado
        
		WHERE COM.UsuarioComprador = p_UsuarioComprador
		
        GROUP BY vCUC.IdCurso;
	END IF;    
    
    IF p_Opc = 'BuscarDiploma'
	THEN
		SELECT 	vCUC.IdCurso, vCUC.TituloCurso, vCUC.DescripcionCurso, vCUC.ImagenCurso, vCUC.CostoCurso
				,vCUC.FechaCreacionCurso, vCUC.EstadoCurso, vCUC.UsuarioCreador 
                
				,vCUC.NombreCompletoUsuarioCreador 
                ,vCUC.ImagenPerfilUsuarioCreador
                
                ,f_get_full_user_name(USR.IdUsuario) AS 'NombreCompletoUsuarioComprador'
                ,COM.FechaCompletado
                
			FROM v_cursos_usuariocreador_calificacion as vCUC
            
        INNER JOIN compras AS COM
        ON COM.CursoComprado = vCUC.IdCurso
        
		INNER JOIN usuarios AS USR
        ON USR.IdUsuario = COM.UsuarioComprador
        
		WHERE COM.CursoComprado = p_IdCurso
		AND COM.UsuarioComprador = p_UsuarioComprador;
	END IF;
    
END$$

DELIMITER ;




DROP procedure IF EXISTS sp_niveles;
DELIMITER $$
CREATE PROCEDURE sp_niveles (
	IN p_Opc						varchar(30),
	IN p_IdNivel 					bigint,
	IN p_TituloNivel 				varchar(100),
    
    IN p_PathVideoNivel		 		varchar(500),
    IN p_ContenidoNivel		 		mediumblob,
    IN p_PathPDFNivel		 		varchar(500),
    IN p_NivelGratis		 		tinyint(1),
    
	IN p_FechaCreacionNivel	 		datetime,
	IN p_EstadoNivel 				tinyint(1),
	IN p_CursoImpartido 			bigint
    
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO niveles(TituloNivel, PathVideoNivel, ContenidoNivel, PathPDFNivel, NivelGratis, CursoImpartido)
			VALUES(p_TituloNivel, p_PathVideoNivel, p_ContenidoNivel, p_PathPDFNivel, p_NivelGratis, p_CursoImpartido);
	END IF;
	IF p_Opc = 'U'
    THEN
        UPDATE niveles 
            SET TituloNivel = p_TituloNivel,
                PathVideoNivel =IF(p_PathVideoNivel is null,   PathVideoNivel, p_PathVideoNivel),
                ContenidoNivel = p_ContenidoNivel,
                PathPDFNivel =IF(p_PathPDFNivel is null, PathPDFNivel, p_PathPDFNivel) ,
                NivelGratis = p_NivelGratis
            WHERE IdNivel = p_IdNivel;

    END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM niveles
		WHERE IdNivel = p_IdNivel;
	END IF;
    
    
	IF p_Opc = 'S'
	THEN
		SELECT IdNivel, TituloNivel, PathVideoNivel, ContenidoNivel, PathPDFNivel, NivelGratis, FechaCreacionNivel, EstadoNivel, CursoImpartido
			FROM niveles
		WHERE IdNivel = p_IdNivel;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT IdNivel, TituloNivel, PathVideoNivel, ContenidoNivel, PathPDFNivel, NivelGratis, FechaCreacionNivel, EstadoNivel, CursoImpartido
			FROM niveles;
		
	END IF;
    
	IF p_Opc = 'NivelesDelCurso'
	THEN
		SELECT 	IdNivel, TituloNivel, PathVideoNivel, ContenidoNivel, PathPDFNivel, NivelGratis, FechaCreacionNivel, EstadoNivel, CursoImpartido
			FROM niveles 
        WHERE CursoImpartido = p_CursoImpartido;
		
	END IF;
    
	IF p_Opc = 'NivelDesplegado'
	THEN
		SELECT NIV.IdNivel, NIV.TituloNivel, NIV.PathVideoNivel, NIV.ContenidoNivel, NIV.PathPDFNivel 
				,NIV.NivelGratis, NIV.FechaCreacionNivel, EstadoNivel, NIV.CursoImpartido
                ,f_get_progreso_nivel(p_CursoImpartido, p_IdNivel) AS ProgresoNivel
			FROM niveles as NIV
		WHERE IdNivel = p_IdNivel;
	END IF;
    
    
END$$

DELIMITER ;





DROP procedure IF EXISTS sp_categorias;
DELIMITER $$
CREATE PROCEDURE sp_categorias (
    IN p_Opc                        varchar(30),
    IN p_IdCategoria                int,
    IN p_TituloCategoria             varchar(45),
    IN p_DescripcionCategoria        varchar(500),
    IN p_FechaCreacionCategoria		 datetime,
    IN p_EstadoCategoria			 tinyint(1),
    IN p_UsuarioCreador				 bigint(20),
    IN p_CursosRelacionados          bigint
)
BEGIN
    IF p_Opc = 'I'
    THEN 
        INSERT INTO categorias(TituloCategoria, DescripcionCategoria, UsuarioCreador)
            VALUES(p_TituloCategoria, p_DescripcionCategoria, p_UsuarioCreador);

            SELECT IdCategoria, TituloCategoria FROM categorias WHERE IdCategoria=last_insert_id();
    END IF;
    IF p_Opc = 'U'
    THEN
        UPDATE categorias
            SET TituloCategoria = p_TituloCategoria,
                DescripcionCategoria = p_DescripcionCategoria
            WHERE IdCategoria = p_IdCategoria;

    END IF;

    IF p_Opc = 'D'
    THEN
        DELETE
            FROM categorias
        WHERE IdCategoria = p_IdCategoria;
    END IF;

    IF p_Opc = 'S'
    THEN
        SELECT IdCategoria, TituloCategoria, DescripcionCategoria, FechaCreacionCategoria, EstadoCategoria, UsuarioCreador
            FROM categorias
        WHERE IdCategoria = p_IdCategoria;
    END IF;


    IF p_Opc = 'X'
    THEN
        SELECT IdCategoria, TituloCategoria, DescripcionCategoria, FechaCreacionCategoria, EstadoCategoria, UsuarioCreador
            FROM categorias;

    END IF;

    IF p_Opc = 'CategoriasDelCurso'
    THEN
        SELECT C.IdCategoria, C.TituloCategoria, C.DescripcionCategoria, C.FechaCreacionCategoria, C.EstadoCategoria, C.UsuarioCreador
            FROM categorias AS C
        INNER JOIN curscat AS CC
        ON CC.IdCategoria = C.IdCategoria
        INNER JOIN cursos AS CUR
        ON CUR.IdCurso = CC.IdCurso
        WHERE CUR.IdCurso = p_CursosRelacionados
        GROUP BY C.IdCategoria;

    END IF;
        IF p_Opc = 'PrimerasDiez'
    THEN 
    
		SELECT vCARCC.IdCategoria, vCARCC.TituloCategoria, vCARCC.DescripcionCategoria, vCARCC.FechaCreacionCategoria, vCARCC.EstadoCategoria, vCARCC.UsuarioCreador
			FROM v_categorias_curscat as vCARCC
		LIMIT 0, 10;
    
    END IF;

        IF p_Opc = 'Filtro'
    THEN 

		SELECT vCARCC.IdCategoria, vCARCC.TituloCategoria, vCARCC.DescripcionCategoria, vCARCC.FechaCreacionCategoria, vCARCC.EstadoCategoria, vCARCC.UsuarioCreador
			FROM v_categorias_curscat as vCARCC
		WHERE vCARCC.TituloCategoria LIKE CONCAT(p_TituloCategoria,"%");
        
    END IF;


END$$

DELIMITER ;



DROP procedure IF EXISTS sp_compras;
DELIMITER $$
CREATE PROCEDURE sp_compras(
    IN p_Opc                        varchar(30),
    IN p_UsuarioComprador           bigint,
    IN p_CursoComprado              bigint,
    IN p_FechaCreacionCompra 		datetime,
    IN p_ProgresoCursoComprado      tinyint(3),
    IN p_FormaPago                  int(11),
    IN p_Pago                       float,
    IN p_FechaUltimaVisualizacion 	datetime,
    IN p_FechaCompletado 			datetime,
    IN p_NivelCursoComprado              bigint
)
BEGIN
    IF p_Opc = 'I'
    THEN 
        INSERT INTO compras(UsuarioComprador, CursoComprado, FormaPago, Pago)
            VALUES(p_UsuarioComprador, p_CursoComprado, p_FormaPago, p_Pago);
    END IF;
    IF p_Opc = 'U'
    THEN
        UPDATE compras
            SET 
				ProgresoCursoComprado = p_ProgresoCursoComprado,
                FechaUltimaVisualizacion = p_FechaUltimaVisualizacion,
                FechaCompletado = p_FechaCompletado
            WHERE CursoComprado = p_CursoComprado
			AND UsuarioComprador = p_UsuarioComprador;

    END IF;

    IF p_Opc = 'D'
    THEN
        DELETE
            FROM compras
            WHERE CursoComprado = p_CursoComprado
			AND UsuarioComprador = p_UsuarioComprador;
    END IF;


    IF p_Opc = 'S'
    THEN
        SELECT  UsuarioComprador, CursoComprado, FechaCreacionCompra, ProgresoCursoComprado
				,FormaPago, Pago, FechaUltimaVisualizacion, FechaCompletado
            FROM compras
            WHERE CursoComprado = p_CursoComprado
			AND UsuarioComprador = p_UsuarioComprador;
    END IF;


    IF p_Opc = 'X'
    THEN
		 SELECT  UsuarioComprador, CursoComprado, FechaCreacionCompra, ProgresoCursoComprado
				,FormaPago, Pago, FechaUltimaVisualizacion, FechaCompletado
            FROM compras;

    END IF;
    
    IF p_Opc = 'UpdateFechaUltimaVisualizacion'
    THEN
			UPDATE compras as COM
				INNER JOIN cursos AS CUR
				ON CUR.IdCurso = COM.CursoComprado
        
				SET 
                    COM.FechaUltimaVisualizacion = now()
                    
				WHERE CUR.IdCurso = p_CursoComprado
				AND COM.UsuarioComprador = p_UsuarioComprador;
       
    END IF;
    
    IF p_Opc = 'UpdateProgresoComprado'
    THEN
		
        SET @progresoSiguiente = f_get_progreso_siguiente(p_UsuarioComprador, p_CursoComprado);
                      
        IF ((@progresoSiguiente >= p_ProgresoCursoComprado - 1) AND (@progresoSiguiente <= p_ProgresoCursoComprado + 1))
		THEN
			UPDATE compras as COM 	
				INNER JOIN cursos AS CUR
				ON CUR.IdCurso = COM.CursoComprado
        
				INNER JOIN niveles AS NIV
				ON NIV.CursoImpartido = CUR.IdCurso
        
				SET 
					COM.ProgresoCursoComprado = p_ProgresoCursoComprado,
                    COM.FechaCompletado = IF(p_ProgresoCursoComprado = 100, now(), COM.FechaCompletado)
                    
				WHERE NIV.IdNivel = p_NivelCursoComprado
				AND COM.UsuarioComprador = p_UsuarioComprador;
							
        END IF;
		
    END IF;
    

END$$
DELIMITER ;



DROP procedure IF EXISTS sp_curscat;
DELIMITER $$
CREATE PROCEDURE sp_curscat (
	IN p_Opc						varchar(30),
	IN p_IdCategoria	 			int,
    IN p_IdCurso					bigint
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO curscat(IdCategoria, IdCurso)
			VALUES(p_IdCategoria, p_IdCurso);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE curscat
			SET IdCategoria = p_IdCategoria,
				IdCurso = p_IdCurso
			WHERE IdCategoria = p_IdCategoria
			AND IdCurso = p_IdCurso;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM curscat
			WHERE IdCategoria = p_IdCategoria
			AND IdCurso = p_IdCurso;
	END IF;
    
    
	IF p_Opc = 'S'
	THEN
		SELECT IdCategoria, IdCurso
			FROM curscat
			WHERE IdCategoria = p_IdCategoria
			AND IdCurso = p_IdCurso;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT IdCategoria, IdCurso
			FROM curscat;
		
	END IF;
    
END$$

DELIMITER ;







DROP procedure IF EXISTS sp_comentarios;
DELIMITER $$
CREATE PROCEDURE sp_comentarios (
	IN p_Opc						varchar(30),
	IN p_IdComentario				bigint,
	IN p_UsuarioComento	 			bigint,
    IN p_CursoComentado				bigint,
    IN p_DescripcionComentario		varchar(800),
	IN p_FechaCreacionComentario	datetime,
    IN p_EstadoComentario 			tinyint(1),
    IN p_NumeroComentarioPaginacion	int
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO comentarios(UsuarioComento, CursoComentado, DescripcionComentario)
			VALUES(p_UsuarioComento, p_CursoComentado, p_DescripcionComentario);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE comentarios
			SET UsuarioComento = p_UsuarioComento,
				CursoComentado = p_CursoComentado,
                DescripcionComentario = p_DescripcionComentario
			WHERE IdComentario = p_IdComentario;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM comentarios
		WHERE IdComentario = p_IdComentario;
	END IF;
    
    
	IF p_Opc = 'S'
	THEN
		SELECT IdComentario, UsuarioComento, CursoComentado, DescripcionComentario, FechaCreacionComentario, EstadoComentario
			FROM comentarios
		WHERE IdComentario = p_IdComentario;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT IdComentario, UsuarioComento, CursoComentado, DescripcionComentario, FechaCreacionComentario, EstadoComentario
			FROM comentarios;
		
	END IF;
    
    IF p_Opc = 'ComentariosPrincipalesCurso'
	THEN
		SELECT DISTINCT v_ComUs.IdComentario, v_ComUs.UsuarioComento, v_ComUs.CursoComentado 
				,v_ComUs.DescripcionComentario, v_ComUs.FechaCreacionComentario, v_ComUs.EstadoComentario
                
				,v_ComUs.NombreCompletoUsuarioComento 
				,v_ComUs.ImagenPerfilUsuarioComento
                
			FROM v_comentario_usuariocomento as v_ComUs
		
		INNER JOIN compras AS COMP
        ON v_ComUs.UsuarioComento = COMP.UsuarioComprador
			        
        WHERE v_ComUs.CursoComentado = p_CursoComentado
        AND COMP.ProgresoCursoComprado = 100
        AND v_ComUs.EstadoComentario = 1
        AND v_ComUs.UsuarioComento != ifnull(p_UsuarioComento, -1)
        ORDER BY v_ComUs.FechaCreacionComentario DESC
		LIMIT p_NumeroComentarioPaginacion, 3;
		
	END IF;
    
	IF p_Opc = 'ComentarioReciente'
	THEN
		SELECT 	v_ComUs.IdComentario, v_ComUs.UsuarioComento, v_ComUs.CursoComentado 
				,v_ComUs.DescripcionComentario, v_ComUs.FechaCreacionComentario, v_ComUs.EstadoComentario
                
				,v_ComUs.NombreCompletoUsuarioComento 
				,v_ComUs.ImagenPerfilUsuarioComento
                
			FROM v_comentario_usuariocomento as v_ComUs
            
		WHERE v_ComUs.UsuarioComento = ifnull(p_UsuarioComento, -1)
        AND v_ComUs.CursoComentado = p_CursoComentado
        AND v_ComUs.EstadoComentario = 1
        ORDER BY v_ComUs.FechaCreacionComentario DESC
		LIMIT 1;
	END IF;

	IF p_Opc = 'EditarComentario'
	THEN
			UPDATE comentarios
				SET DescripcionComentario = p_DescripcionComentario
			WHERE IdComentario = p_IdComentario;
	END IF;

	IF p_Opc = 'BorrarComentario'
	THEN
			UPDATE comentarios
				SET EstadoComentario = p_EstadoComentario
			WHERE IdComentario = p_IdComentario;
	END IF;
    
    
END$$

DELIMITER ;







DROP procedure IF EXISTS sp_calificaciones;
DELIMITER $$
CREATE PROCEDURE sp_calificaciones (
	IN p_Opc						varchar(30),
	IN p_UsuarioCalifico	 		bigint,
    IN p_CursoCalificado			bigint,
    IN p_UtilidadCalificacion		tinyint(1),
	IN p_FechaCreacionCalificacion	datetime,
    IN p_EstadoCalificacion			tinyint(1)
    
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO calificaciones(UsuarioCalifico, CursoCalificado, UtilidadCalificacion)
			VALUES(p_UsuarioCalifico, p_CursoCalificado, p_UtilidadCalificacion);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE calificaciones
			SET UsuarioCalifico = p_UsuarioCalifico,
				CursoCalificado = p_CursoCalificado,
                UtilidadCalificacion = p_UtilidadCalificacion
		WHERE UsuarioCalifico = p_UsuarioCalifico
        AND CursoCalificado = p_CursoCalificado;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM calificaciones
		WHERE UsuarioCalifico = p_UsuarioCalifico
        AND CursoCalificado = p_CursoCalificado;
	END IF;
    
    
    IF p_Opc = 'SuspenderCalificacion'
	THEN
		UPDATE calificaciones
			SET 
				EstadoCalificacion = 0
		WHERE UsuarioCalifico = p_UsuarioCalifico
        AND CursoCalificado = p_CursoCalificado;
	END IF;
    
	IF p_Opc = 'S'
	THEN
		SELECT UsuarioCalifico, CursoCalificado, UtilidadCalificacion, FechaCreacionCalificacion, EstadoCalificacion
			FROM calificaciones
		WHERE UsuarioCalifico = p_UsuarioCalifico
        AND CursoCalificado = p_CursoCalificado;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT UsuarioCalifico, CursoCalificado, UtilidadCalificacion, FechaCreacionCalificacion, EstadoCalificacion
			FROM calificaciones;
		
	END IF;
    
    
	IF p_Opc = 'BuscarCalificacion'
	THEN
		SELECT UsuarioCalifico, CursoCalificado, UtilidadCalificacion, FechaCreacionCalificacion, EstadoCalificacion
			FROM calificaciones
		WHERE UsuarioCalifico = p_UsuarioCalifico
        AND CursoCalificado = p_CursoCalificado;
		
	END IF;
    
END$$

DELIMITER ;





DROP procedure IF EXISTS sp_mensajes;
DELIMITER $$
CREATE PROCEDURE sp_mensajes (
	IN p_Opc						varchar(30),
	IN p_IdMensaje					bigint,
	IN p_UsuarioEnvia	 			bigint,
    IN p_UsuarioRecibe				bigint,
    IN p_DescripcionMensaje			varchar(800),
	IN p_FechaCreacionMensaje		datetime,
    IN p_EstadoMensaje 				tinyint(1),
    IN p_FiltroBandeja				varchar(200)
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO mensajes(UsuarioEnvia, UsuarioRecibe, DescripcionMensaje)
			VALUES(p_UsuarioEnvia, p_UsuarioRecibe, p_DescripcionMensaje);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE mensajes
			SET UsuarioEnvia = p_UsuarioEnvia,
				UsuarioRecibe = p_UsuarioRecibe,
                DescripcionMensaje = p_DescripcionMensaje
			WHERE IdMensaje = p_IdMensaje;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM mensajes
		WHERE IdMensaje = p_IdMensaje;
	END IF;
    
    
	IF p_Opc = 'S'
	THEN
		SELECT IdMensaje, UsuarioEnvia, UsuarioRecibe, DescripcionMensaje, FechaCreacionMensaje, EstadoMensaje
			FROM mensajes
		WHERE IdMensaje = p_IdMensaje;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT IdMensaje, UsuarioEnvia, UsuarioRecibe, DescripcionMensaje, FechaCreacionMensaje, EstadoMensaje
			FROM mensajes;
		
	END IF;
    
    IF p_Opc = 'BandejaMensajes'
	THEN
    
    SELECT 	vMER.IdMensaje, vMER.UsuarioEnvia, vMER.UsuarioRecibe
			,vMER.DescripcionMensaje, vMER.FechaCreacionMensaje, vMER.EstadoMensaje
			,vMER.NombreUsuarioEnvia, vMER.ImagenUsuarioEnvia
			,vMER.NombreUsuarioRecibe, vMER.ImagenUsuarioRecibe
		FROM v_mensaje_usuarioenvia_usuariorecibe AS vMER
    
		INNER JOIN v_ultimo_mensaje_conversacion AS LAST_MSJ 
        
		ON least(vMER.UsuarioEnvia, vMER.UsuarioRecibe)=LAST_MSJ.Usuario_1
		AND greatest(vMER.UsuarioEnvia, vMER.UsuarioRecibe)=LAST_MSJ.Usuario_2
		AND vMER.FechaCreacionMensaje = LAST_MSJ.FechaCreacionMensaje
        
		WHERE vMER.UsuarioEnvia = p_UsuarioEnvia 
		OR vMER.UsuarioRecibe = p_UsuarioEnvia
        GROUP BY vMER.IdMensaje
        ORDER BY vMER.FechaCreacionMensaje DESC;
    
    
	END IF;
    
    IF p_Opc = 'MensajesConversacion'
	THEN
		SELECT 	vMER.IdMensaje, vMER.UsuarioEnvia, vMER.UsuarioRecibe
				,vMER.DescripcionMensaje, vMER.FechaCreacionMensaje, vMER.EstadoMensaje
				,vMER.NombreUsuarioEnvia, vMER.ImagenUsuarioEnvia
				,vMER.NombreUsuarioRecibe, vMER.ImagenUsuarioRecibe
			FROM v_mensaje_usuarioenvia_usuariorecibe AS vMER
    
		WHERE (vMER.UsuarioEnvia = p_UsuarioEnvia AND vMER.UsuarioRecibe = p_UsuarioRecibe) 
        OR (vMER.UsuarioEnvia = p_UsuarioRecibe AND vMER.UsuarioRecibe = p_UsuarioEnvia)
		GROUP BY vMER.IdMensaje
        ORDER BY vMER.FechaCreacionMensaje ASC;
	END IF;
    
    IF p_Opc = 'FiltroBandeja'
    THEN
	
    SELECT  vMER.IdMensaje, vMER.UsuarioEnvia, vMER.UsuarioRecibe
			,vMER.DescripcionMensaje, vMER.FechaCreacionMensaje, vMER.EstadoMensaje
            ,vMER.NombreUsuarioEnvia, vMER.ImagenUsuarioEnvia
            ,vMER.NombreUsuarioRecibe, vMER.ImagenUsuarioRecibe
        FROM v_mensaje_usuarioenvia_usuariorecibe AS vMER
        
		INNER JOIN v_ultimo_mensaje_conversacion AS LAST_MSJ 
        
		ON least(vMER.UsuarioEnvia, vMER.UsuarioRecibe)=LAST_MSJ.Usuario_1
		AND greatest(vMER.UsuarioEnvia, vMER.UsuarioRecibe)=LAST_MSJ.Usuario_2
		AND vMER.FechaCreacionMensaje = LAST_MSJ.FechaCreacionMensaje

        WHERE (vMER.UsuarioEnvia = p_UsuarioEnvia 
        OR vMER.UsuarioRecibe = p_UsuarioEnvia)
        AND (vMER.NombreUsuarioEnvia LIKE CONCAT(p_FiltroBandeja,"%") OR vMER.NombreUsuarioRecibe LIKE CONCAT(p_FiltroBandeja,"%"))
        ORDER BY vMER.FechaCreacionMensaje DESC;


    END IF;
    
END$$

DELIMITER ;






DROP procedure IF EXISTS sp_usurol;
DELIMITER $$
CREATE PROCEDURE sp_usurol (
	IN p_Opc						varchar(30),
	IN p_IdUsuario	 				bigint,
    IN p_IdRol						int
    
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO usurol(IdUsuario, IdRol)
			VALUES(p_IdUsuario, p_IdRol);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE usurol
			SET IdUsuario = p_IdUsuario,
				IdRol = p_IdRol
		WHERE IdUsuario = p_IdUsuario
        AND IdRol = p_IdRol;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM usurol
		WHERE IdUsuario = p_IdUsuario
        AND IdRol = p_IdRol;
	END IF;
    
    
	IF p_Opc = 'S'
	THEN
		SELECT IdUsuario, IdRol
			FROM usurol
		WHERE IdUsuario = p_IdUsuario
        AND IdRol = p_IdRol;
	END IF;

	IF p_Opc = 'X'
	THEN
		SELECT IdUsuario, IdRol
			FROM usurol;
		
	END IF;
    
END$$

DELIMITER ;




DROP procedure IF EXISTS sp_forma_pago;
DELIMITER $$
CREATE PROCEDURE sp_forma_pago (
	IN p_Opc						varchar(30),
	IN p_IdFormaPago				int,
	IN p_FormaPago	 				varchar(45)
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO forma_pago(FormaPago)
			VALUES(p_FormaPago);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE forma_pago
			SET FormaPago = p_FormaPago
			WHERE IdFormaPago = p_IdFormaPago;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM forma_pago
		WHERE IdFormaPago = p_IdFormaPago;
	END IF;
    
    
	IF p_Opc = 'S'
	THEN
		SELECT IdFormaPago, FormaPago
			FROM forma_pago
		WHERE IdFormaPago = p_IdFormaPago;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT IdFormaPago, FormaPago
			FROM forma_pago;
		
	END IF;
    
END$$

DELIMITER ;






DROP procedure IF EXISTS sp_roles;
DELIMITER $$
CREATE PROCEDURE sp_roles (
	IN p_Opc						varchar(30),
	IN p_IdRol						int,
	IN p_TipoRol	 				varchar(45)
)
BEGIN
	IF p_Opc = 'I'
	THEN 
		INSERT INTO roles(TipoRol)
			VALUES(p_TipoRol);
	END IF;
	IF p_Opc = 'U'
	THEN
		UPDATE roles
			SET TipoRol = p_TipoRol
			WHERE IdRol = p_IdRol;
            
	END IF;

	IF p_Opc = 'D'
	THEN
		DELETE
			FROM roles
		WHERE IdRol = p_IdRol;
	END IF;
    
    
	IF p_Opc = 'S'
	THEN
		SELECT IdRol, TipoRol
			FROM roles
		WHERE IdRol = p_IdRol;
	END IF;


	IF p_Opc = 'X'
	THEN
		SELECT IdRol, TipoRol
			FROM roles;
		
	END IF;
    
END$$

DELIMITER ;

