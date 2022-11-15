use e_learning_db;

select * from information_schema.table_constraints where table_schema = schema()
 and table_name = 'forma_pago';
 
 SELECT DISTINCT CONSTRAINT_NAME
    FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE CONSTRAINT_SCHEMA = 'e_learning_db';

select *
from information_schema.KEY_COLUMN_USAGE
where TABLE_NAME = 'forma_pago';

SELECT distinct
		t.table_schema AS db_name,
       t.table_name,
       (CASE WHEN t.table_type = 'BASE TABLE' THEN 'table'
             WHEN t.table_type = 'VIEW' THEN 'view'
             ELSE t.table_type
        END) AS table_type,
        c.column_name,
        c.column_type,
        c.column_default,
        c.column_key,
        c.is_nullable,
        c.extra,
        c.column_comment
FROM information_schema.tables AS t
INNER JOIN information_schema.columns AS c
ON t.table_name = c.table_name
AND t.table_schema = c.table_schema
WHERE t.table_type IN ('BASE TABLE', 'VIEW')
AND t.table_schema = 'e_learning_db'
ORDER BY
		t.table_name,
		t.table_schema,
         c.ordinal_position;

SELECT *
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA='e_learning_db' 
    #AND TABLE_NAME='film'
;
SELECT *
FROM INFORMATION_SCHEMA.TABLES 
WHERE TABLE_SCHEMA='e_learning_db';






SELECT distinct
        c.column_name,
        c.column_type,
        c.column_default,
        c.column_key,
        c.is_nullable,
        /*t.table_name,*/
        c.column_comment
FROM information_schema.tables AS t
INNER JOIN information_schema.columns AS c
	ON t.table_name = c.table_name
	AND t.table_schema = c.table_schema
WHERE t.table_type IN ('BASE TABLE')
AND t.table_schema = 'e_learning_db'
ORDER BY
		c.column_name,
		c.ordinal_position;


#--------------------------------------------------------------------------------------------------------------------
#Esto nomas aplica para nosotros para crear el diccionario, una vez lo tengamos, pondremos cada comment en la creacion de tablas


ALTER TABLE e_learning_db.usuarios 
CHANGE COLUMN IdUsuario IdUsuario BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Usuario' ,
CHANGE COLUMN NombreUsuario NombreUsuario VARCHAR(30) NOT NULL COMMENT 'Nombre del Usuario' ,
CHANGE COLUMN ApellidoPaternoUsuario ApellidoPaternoUsuario VARCHAR(30) NOT NULL COMMENT 'Apellido Paterno del Usuario' ,
CHANGE COLUMN ApellidoMaternoUsuario ApellidoMaternoUsuario VARCHAR(30) NOT NULL COMMENT 'Apellido Materno del Usuario' ,
CHANGE COLUMN GeneroUsuario GeneroUsuario VARCHAR(30) NOT NULL COMMENT 'Genero del Usuario' ,
CHANGE COLUMN FechaNacimientoUsuario FechaNacimientoUsuario DATE NOT NULL COMMENT 'Fecha en que nació el Usuario' ,
CHANGE COLUMN ImagenPerfilUsuario ImagenPerfilUsuario MEDIUMBLOB NULL DEFAULT NULL COMMENT 'Imagen de Perfil del Usuario' ,
CHANGE COLUMN CorreoUsuario CorreoUsuario VARCHAR(60) NOT NULL COMMENT 'Correo del Usuario con el cuál iniciará sesión a la página' ,
CHANGE COLUMN PasswordUsuario PasswordUsuario VARCHAR(30) NOT NULL COMMENT 'Contraseña del Usuario con la cuál iniciará sesión a la página' ,
CHANGE COLUMN FechaCreacionUsuario FechaCreacionUsuario DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó su perfil' ,
CHANGE COLUMN EstadoUsuario EstadoUsuario TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Usuario (Puede ser 1 si está Activo, 0 si fue dado de baja)' ;



ALTER TABLE e_learning_db.roles 
CHANGE COLUMN IdRol IdRol INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Rol' ,
CHANGE COLUMN TipoRol TipoRol VARCHAR(45) NOT NULL COMMENT 'Tipo de Rol (Puede ser Escuela o Estudiante)' ;


  ALTER TABLE e_learning_db.cursos 
DROP FOREIGN KEY FK_CURS_USER;
ALTER TABLE e_learning_db.cursos 
CHANGE COLUMN IdCurso IdCurso BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Curso' ,
CHANGE COLUMN TituloCurso TituloCurso VARCHAR(100) NOT NULL COMMENT 'Titulo del Curso' ,
CHANGE COLUMN DescripcionCurso DescripcionCurso VARCHAR(800) NULL DEFAULT NULL COMMENT 'Descripción del Curso' ,
CHANGE COLUMN ImagenCurso ImagenCurso MEDIUMBLOB NULL DEFAULT NULL COMMENT 'Imagen del Curso' ,
CHANGE COLUMN CostoCurso CostoCurso DECIMAL(19,2) NOT NULL COMMENT 'Costo monetario del Curso (en pesos mexicanos)' ,
CHANGE COLUMN FechaCreacionCurso FechaCreacionCurso DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó Curso' ,
CHANGE COLUMN EstadoCurso EstadoCurso TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Curso (Puede ser 1 si está Activo, 0 si fue dado de baja)' ,
CHANGE COLUMN UsuarioCreador UsuarioCreador BIGINT(20) NOT NULL COMMENT 'Id del Usuario que creó el Curso' ;
ALTER TABLE e_learning_db.cursos 
ADD CONSTRAINT FK_CURS_USER
  FOREIGN KEY (UsuarioCreador)
  REFERENCES e_learning_db.usuarios (IdUsuario);



ALTER TABLE e_learning_db.niveles 
DROP FOREIGN KEY FK_NIV_CURS;
ALTER TABLE e_learning_db.niveles 
CHANGE COLUMN IdNivel IdNivel BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Nivel' ,
CHANGE COLUMN TituloNivel TituloNivel VARCHAR(100) NOT NULL COMMENT 'Titulo del Nivel' ,
CHANGE COLUMN PathVideoNivel PathVideoNivel VARCHAR(500) NULL DEFAULT NULL COMMENT 'Path del servidor en el que se encuentra alojado el video del Nivel' ,
CHANGE COLUMN PathPDFNivel PathPDFNivel VARCHAR(500) NULL DEFAULT NULL COMMENT 'Path del servidor en el que se encuentra alojado el PDF del Nivel' ,
CHANGE COLUMN ContenidoNivel ContenidoNivel MEDIUMBLOB NULL DEFAULT NULL COMMENT 'Contenido en formato HTML del Nivel (Puede incluir Imagenes, Links y texto con formato)' ,
CHANGE COLUMN NivelGratis NivelGratis TINYINT(1) NOT NULL COMMENT 'Campo del Nivel que define si es gratis o no (0 significa que no es gratis, 1 significa que sí lo es)' ,
CHANGE COLUMN FechaCreacionNivel FechaCreacionNivel DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó el Nivel' ,
CHANGE COLUMN EstadoNivel EstadoNivel TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Nivel (Puede ser 1 si está Activo, 0 si fue dado de baja)' ,
CHANGE COLUMN CursoImpartido CursoImpartido BIGINT(20) NOT NULL COMMENT 'Id del Curso al que pertenece el Nivel' ;
ALTER TABLE e_learning_db.niveles 
ADD CONSTRAINT FK_NIV_CURS
  FOREIGN KEY (CursoImpartido)
  REFERENCES e_learning_db.cursos (IdCurso);



ALTER TABLE e_learning_db.categorias 
CHANGE COLUMN IdCategoria IdCategoria INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Categoría' ,
CHANGE COLUMN TituloCategoria TituloCategoria VARCHAR(45) NOT NULL COMMENT 'Titulo de la Categoría' ,
CHANGE COLUMN DescripcionCategoria DescripcionCategoria VARCHAR(500) NULL DEFAULT NULL COMMENT 'Descripción de la Categoría' ,
CHANGE COLUMN FechaCreacionCategoria FechaCreacionCategoria	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó la Categoria',
CHANGE COLUMN EstadoCategoria EstadoCategoria tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Estado de la Categoria (Puede ser 1 si está Activo, 0 si fue dado de baja)',
CHANGE COLUMN UsuarioCreador UsuarioCreador bigint(20) NOT NULL COMMENT 'Id del Usuario que creó la Categoria';




ALTER TABLE e_learning_db.usurol 
DROP FOREIGN KEY FK_USUROL_ROL,
DROP FOREIGN KEY FK_USUROL_USER;
ALTER TABLE e_learning_db.usurol 
CHANGE COLUMN IdUsuario IdUsuario BIGINT(20) NOT NULL COMMENT 'Identificador del Usuario' ,
CHANGE COLUMN IdRol IdRol INT(11) NOT NULL COMMENT 'Identificador del Rol' ;
ALTER TABLE e_learning_db.usurol 
ADD CONSTRAINT FK_USUROL_ROL
  FOREIGN KEY (IdRol)
  REFERENCES e_learning_db.roles (IdRol),
ADD CONSTRAINT FK_USUROL_USER
  FOREIGN KEY (IdUsuario)
  REFERENCES e_learning_db.usuarios (IdUsuario);




ALTER TABLE e_learning_db.compras 
DROP FOREIGN KEY FK_COMP_CURS,
DROP FOREIGN KEY FK_COMP_FP,
DROP FOREIGN KEY FK_COMP_USER;
ALTER TABLE e_learning_db.compras 
CHANGE COLUMN UsuarioComprador UsuarioComprador BIGINT(20) NOT NULL COMMENT 'Identificador del Usuario que compró el Curso' ,
CHANGE COLUMN CursoComprado CursoComprado BIGINT(20) NOT NULL COMMENT 'Identificador del Curso que fue comprado por el Usuario' ,
CHANGE COLUMN FechaCreacionCompra FechaCreacionCompra DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que se realizó la compra' ,
CHANGE COLUMN ProgresoCursoComprado ProgresoCursoComprado FLOAT NOT NULL DEFAULT '0' COMMENT 'Progreso que el Usuario lleva para terminar el curso' ,
CHANGE COLUMN FormaPago FormaPago INT(20) NOT NULL COMMENT 'Identificador de la Forma de Pago que usó el Usuario para comprar el Curso' ,
CHANGE COLUMN Pago Pago DECIMAL(19,2) NOT NULL COMMENT 'Cantidad de dinero que el Usuario pagó para comprar el Curso (Es el costo del curso en dicha fecha)' ,
CHANGE COLUMN FechaUltimaVisualizacion FechaUltimaVisualizacion DATETIME NULL DEFAULT NULL COMMENT 'Fecha más reciente en la que el Usuario vió cualquier Nivel del Curso' ,
CHANGE COLUMN FechaCompletado FechaCompletado DATETIME NULL DEFAULT NULL COMMENT 'Fecha en la que el Usuario acabó de ver todos los Niveles del Curso en orden' ;
ALTER TABLE e_learning_db.compras 
ADD CONSTRAINT FK_COMP_CURS
  FOREIGN KEY (CursoComprado)
  REFERENCES e_learning_db.cursos (IdCurso),
ADD CONSTRAINT FK_COMP_FP
  FOREIGN KEY (FormaPago)
  REFERENCES e_learning_db.forma_pago (IdFormaPago),
ADD CONSTRAINT FK_COMP_USER
  FOREIGN KEY (UsuarioComprador)
  REFERENCES e_learning_db.usuarios (IdUsuario);



ALTER TABLE e_learning_db.curscat 
DROP FOREIGN KEY FK_CURSCAT_CURS,
DROP FOREIGN KEY FK_CURSCAT_CURSO;
ALTER TABLE e_learning_db.curscat 
CHANGE COLUMN IdCurso IdCurso BIGINT(20) NOT NULL COMMENT 'Identificador del Curso' ,
CHANGE COLUMN IdCategoria IdCategoria INT(11) NOT NULL COMMENT 'Identificador de la Categoría' ;
ALTER TABLE e_learning_db.curscat 
ADD CONSTRAINT FK_CURSCAT_CURS
  FOREIGN KEY (IdCurso)
  REFERENCES e_learning_db.cursos (IdCurso),
ADD CONSTRAINT FK_CURSCAT_CURSO
  FOREIGN KEY (IdCategoria)
  REFERENCES e_learning_db.categorias (IdCategoria);
  
  
  


ALTER TABLE e_learning_db.comentarios 
DROP FOREIGN KEY FK_COMEN_CURS,
DROP FOREIGN KEY FK_COMEN_USER;
ALTER TABLE e_learning_db.comentarios 
CHANGE COLUMN IdComentario IdComentario BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Comentario' ,
CHANGE COLUMN UsuarioComento UsuarioComento BIGINT(20) NOT NULL COMMENT 'Id del Usuario que realizó el Comentario' ,
CHANGE COLUMN CursoComentado CursoComentado BIGINT(20) NOT NULL COMMENT 'Id del Curso que fue Comentado' ,
CHANGE COLUMN DescripcionComentario DescripcionComentario VARCHAR(800) NULL DEFAULT NULL COMMENT 'Descripción del Comentario' ,
CHANGE COLUMN FechaCreacionComentario FechaCreacionComentario DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario comentó al Curso' ,
CHANGE COLUMN EstadoComentario EstadoComentario TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Comentario (Puede ser 1 si está Activo, 0 si fue dado de baja)' ;
ALTER TABLE e_learning_db.comentarios 
ADD CONSTRAINT FK_COMEN_CURS
  FOREIGN KEY (CursoComentado)
  REFERENCES e_learning_db.cursos (IdCurso),
ADD CONSTRAINT FK_COMEN_USER
  FOREIGN KEY (UsuarioComento)
  REFERENCES e_learning_db.usuarios (IdUsuario);





ALTER TABLE e_learning_db.calificaciones 
DROP FOREIGN KEY FK_CALF_CURS,
DROP FOREIGN KEY FK_CALF_USER;
ALTER TABLE e_learning_db.calificaciones 
KEY_BLOCK_SIZE = 1 ,
CHANGE COLUMN UsuarioCalifico UsuarioCalifico BIGINT(20) NOT NULL COMMENT 'Id del Usuario que realizo la Calificación' ,
CHANGE COLUMN CursoCalificado CursoCalificado BIGINT(20) NOT NULL COMMENT 'Id del Curso que fue Calificado' ,
CHANGE COLUMN UtilidadCalificacion UtilidadCalificacion TINYINT(1) NOT NULL COMMENT 'Valor de la Calificación (Puede ser 0 como dislike, 1 como like)' ,
CHANGE COLUMN FechaCreacionCalificacion FechaCreacionCalificacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario calificó al Curso' ,
CHANGE COLUMN EstadoCalificacion EstadoCalificacion tinyint(1) NOT NULL DEFAULT 1  COMMENT 'Estado de la Calificacion (Puede ser 1 si está Activo, 0 si fue dado de baja)';
ALTER TABLE e_learning_db.calificaciones 
ADD CONSTRAINT FK_CALF_CURS
  FOREIGN KEY (CursoCalificado)
  REFERENCES e_learning_db.cursos (IdCurso),
ADD CONSTRAINT FK_CALF_USER
  FOREIGN KEY (UsuarioCalifico)
  REFERENCES e_learning_db.usuarios (IdUsuario);



  
  ALTER TABLE e_learning_db.mensajes 
DROP FOREIGN KEY FK_MSJ_USER_ENV,
DROP FOREIGN KEY FK_MSJ_USER_REC;
ALTER TABLE e_learning_db.mensajes 
CHANGE COLUMN IdMensaje IdMensaje BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Mensaje' ,
CHANGE COLUMN UsuarioEnvia UsuarioEnvia BIGINT(20) NOT NULL COMMENT 'Id del Usuario que envió el mensaje' ,
CHANGE COLUMN UsuarioRecibe UsuarioRecibe BIGINT(20) NOT NULL COMMENT 'Id del Usuario que recibió el mensaje' ,
CHANGE COLUMN DescripcionMensaje DescripcionMensaje VARCHAR(800) NULL DEFAULT NULL COMMENT 'Descripción del Mensaje' ,
CHANGE COLUMN FechaCreacionMensaje FechaCreacionMensaje DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó el Mensaje' ,
CHANGE COLUMN EstadoMensaje EstadoMensaje TINYINT(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Mensaje (Puede ser 1 si está Activo, 0 si fue dado de baja)' ;
ALTER TABLE e_learning_db.mensajes 
ADD CONSTRAINT FK_MSJ_USER_ENV
  FOREIGN KEY (UsuarioEnvia)
  REFERENCES e_learning_db.usuarios (IdUsuario),
ADD CONSTRAINT FK_MSJ_USER_REC
  FOREIGN KEY (UsuarioRecibe)
  REFERENCES e_learning_db.usuarios (IdUsuario);




ALTER TABLE e_learning_db.forma_pago 
CHANGE COLUMN IdFormaPago IdFormaPago INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Forma de Pago' ,
CHANGE COLUMN FormaPago FormaPago VARCHAR(45) NOT NULL COMMENT 'Tipo de la Forma de Pago (Puede ser Paypal, Tarjeta o Gratis si el curso fue gratis)' ;


