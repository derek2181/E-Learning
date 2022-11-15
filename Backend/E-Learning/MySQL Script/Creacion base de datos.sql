create database e_learning_db;
use e_learning_db;

CREATE TABLE usuarios (
  IdUsuario 					bigint NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Usuario',
  NombreUsuario 				varchar(30) NOT NULL COMMENT 'Nombre del Usuario' ,
  ApellidoPaternoUsuario 		varchar(30) NOT NULL COMMENT 'Apellido Paterno del Usuario' ,
  ApellidoMaternoUsuario 		varchar(30) NOT NULL COMMENT 'Apellido Materno del Usuario',
  GeneroUsuario 				varchar(30) NOT NULL COMMENT 'Genero del Usuario' ,
  FechaNacimientoUsuario 		date NOT NULL COMMENT 'Fecha en que nació el Usuario' ,
  ImagenPerfilUsuario 			mediumblob NOT NULL COMMENT 'Imagen de Perfil del Usuario' ,
  CorreoUsuario 				varchar(60) NOT NULL COMMENT 'Correo del Usuario con el cuál iniciará sesión a la página' ,
  PasswordUsuario 				varchar(30) NOT NULL COMMENT 'Contraseña del Usuario con la cuál iniciará sesión a la página' ,
  FechaCreacionUsuario 			datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó su perfil' ,
  EstadoUsuario	 				tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Usuario (Puede ser 1 si está Activo, 0 si fue dado de baja)' ,
  PRIMARY KEY (IdUsuario),
  UNIQUE KEY idUsuario_UNIQUE (IdUsuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE roles (
  IdRol 						int NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Rol',
  TipoRol 						varchar(45) NOT NULL COMMENT 'Tipo de Rol (Puede ser Escuela o Estudiante)',
  PRIMARY KEY (IdRol),
  UNIQUE KEY IdRol_UNIQUE (IdRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE cursos (
  IdCurso 						bigint NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Curso',
  TituloCurso 					varchar(100) NOT NULL COMMENT 'Titulo del Curso',
  DescripcionCurso 				varchar(800) NOT NULL COMMENT 'Descripción del Curso',
  ImagenCurso 					mediumblob NULL COMMENT 'Imagen del Curso',
  CostoCurso 					decimal(19,2) NOT NULL COMMENT 'Costo monetario del Curso (en pesos mexicanos)',
  FechaCreacionCurso 			datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó Curso',
  EstadoCurso 					tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Curso (Puede ser 1 si está Activo, 0 si fue dado de baja)',
  UsuarioCreador 				bigint NOT NULL COMMENT 'Id del Usuario que creó el Curso',
  PRIMARY KEY (IdCurso),
  UNIQUE KEY IdCurso_UNIQUE (IdCurso)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

 CREATE TABLE niveles (
  IdNivel 						bigint NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Nivel',
  TituloNivel 					varchar(100) NOT NULL COMMENT 'Titulo del Nivel',
  PathVideoNivel 				varchar(500) NOT NULL COMMENT 'Path del servidor en el que se encuentra alojado el video del Nivel',
  PathPDFNivel 					varchar(500) DEFAULT NULL COMMENT 'Path del servidor en el que se encuentra alojado el PDF del Nivel',
  ContenidoNivel 				mediumblob DEFAULT NULL COMMENT 'Contenido en formato HTML del Nivel (Puede incluir Imagenes, Links y texto con formato)',
  NivelGratis 					tinyint(1) NOT NULL COMMENT 'Campo del Nivel que define si es gratis o no (0 significa que no es gratis, 1 significa que sí lo es)',
  FechaCreacionNivel 			datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó el Nivel',
  EstadoNivel 					tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Nivel (Puede ser 1 si está Activo, 0 si fue dado de baja)',
  CursoImpartido 				bigint NOT NULL COMMENT 'Id del Curso al que pertenece el Nivel',
  PRIMARY KEY (IdNivel),
  UNIQUE KEY IdNivel_UNIQUE (IdNivel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categorias (
  IdCategoria 					int NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Categoría',
  TituloCategoria 				varchar(45) NOT NULL COMMENT 'Titulo de la Categoría',
  DescripcionCategoria 			varchar(500) NOT NULL COMMENT 'Descripción de la Categoría',
  FechaCreacionCategoria 		datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó la Categoria',
  EstadoCategoria 				tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Estado de la Categoria (Puede ser 1 si está Activo, 0 si fue dado de baja)',
  UsuarioCreador				bigint(20) NOT NULL COMMENT 'Id del Usuario que creó la Categoria',
  PRIMARY KEY (IdCategoria),
  UNIQUE KEY IdCategoria_UNIQUE (IdCategoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE usurol (
  IdUsuario 					bigint NOT NULL COMMENT 'Identificador del Usuario',
  IdRol 						int NOT NULL COMMENT 'Identificador del Rol',
  PRIMARY KEY (IdUsuario,IdRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE compras (
  UsuarioComprador 				bigint(20) NOT NULL COMMENT 'Identificador del Usuario que compró el Curso',
  CursoComprado 				bigint(20) NOT NULL COMMENT 'Identificador del Curso que fue comprado por el Usuario',
  FechaCreacionCompra 			datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que se realizó la compra',
  ProgresoCursoComprado 		float NOT NULL DEFAULT '0' COMMENT 'Progreso que el Usuario lleva para terminar el curso',
  FormaPago 					int(20) NOT NULL COMMENT 'Identificador de la Forma de Pago que usó el Usuario para comprar el Curso',
  Pago 							decimal(19,2) NOT NULL COMMENT 'Cantidad de dinero que el Usuario pagó para comprar el Curso (Es el costo del curso en dicha fecha)',
  FechaUltimaVisualizacion 		datetime DEFAULT NULL COMMENT 'Fecha más reciente en la que el Usuario vió cualquier Nivel del Curso',
  FechaCompletado 				datetime DEFAULT NULL COMMENT 'Fecha en la que el Usuario acabó de ver todos los niveles del Curso en orden',
  PRIMARY KEY (UsuarioComprador, CursoComprado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE curscat (
  IdCurso 						bigint NOT NULL COMMENT 'Identificador del Curso',
  IdCategoria 					int NOT NULL COMMENT 'Identificador de la Categoría',
  PRIMARY KEY (IdCurso,IdCategoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE comentarios (
  IdComentario 					bigint NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Comentario',
  UsuarioComento 				bigint NOT NULL COMMENT 'Id del Usuario que realizó el Comentario',
  CursoComentado 				bigint NOT NULL COMMENT 'Id del Curso que fue Comentado',
  DescripcionComentario 		varchar(800) NOT NULL COMMENT 'Descripción del Comentario',
  FechaCreacionComentario 		datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario comentó al Curso',
  EstadoComentario 				tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Comentario (Puede ser 1 si está Activo, 0 si fue dado de baja)',
  PRIMARY KEY (IdComentario),
  UNIQUE KEY IdComentario_UNIQUE (IdComentario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE calificaciones (
  UsuarioCalifico 				bigint NOT NULL COMMENT 'Id del Usuario que realizo la Calificación',
  CursoCalificado 				bigint NOT NULL COMMENT 'Id del Curso que fue Calificado',
  UtilidadCalificacion 			tinyint(1) NOT NULL COMMENT 'Valor de la Calificación (Puede ser 0 como dislike, 1 como like)',
  FechaCreacionCalificacion 	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario calificó al Curso',
  EstadoCalificacion		 	tinyint(1) NOT NULL DEFAULT 1  COMMENT 'Estado de la Calificacion (Puede ser 1 si está Activo, 0 si fue dado de baja)',
  PRIMARY KEY (UsuarioCalifico, CursoCalificado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE mensajes (
  IdMensaje 					bigint NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Mensaje',
  UsuarioEnvia 					bigint NOT NULL COMMENT 'Id del Usuario que envió el mensaje',
  UsuarioRecibe 				bigint NOT NULL COMMENT 'Id del Usuario que recibió el mensaje',
  DescripcionMensaje 			varchar(800) NOT NULL COMMENT 'Descripción del Mensaje',
  FechaCreacionMensaje 			datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en que el Usuario creó el Mensaje',
  EstadoMensaje 				tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del Mensaje (Puede ser 1 si está Activo, 0 si fue dado de baja)',
  PRIMARY KEY (IdMensaje),
  UNIQUE KEY IdMensaje_UNIQUE (IdMensaje)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE forma_pago (
  IdFormaPago 					int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Forma de Pago',
  FormaPago 					varchar(45) NOT NULL COMMENT 'Tipo de la Forma de Pago (Puede ser Paypal, Tarjeta o Gratis si el curso fue gratis)',
  PRIMARY KEY (IdFormaPago),
  UNIQUE INDEX IdForma_UNIQUE (IdFormaPago))
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE forma_pago 
ADD CONSTRAINT CK_FORM_PAGO
CHECK (FormaPago IN ("PayPal", "Tarjeta", "Gratis"));


ALTER TABLE usuarios 
ADD CONSTRAINT CK_USR_ESTADO
CHECK (EstadoUsuario = 0);


ALTER TABLE usurol 
ADD INDEX FK_USUROL_USER_idx (IdUsuario ASC),
ADD CONSTRAINT FK_USUROL_USER
  FOREIGN KEY (IdUsuario)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE usurol 
ADD INDEX FK_USUROL_ROL_idx (IdRol ASC),
ADD CONSTRAINT FK_USUROL_ROL
  FOREIGN KEY (IdRol)
  REFERENCES roles (IdRol)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE roles 
ADD CONSTRAINT CK_ROL_TIPO
CHECK (TipoRol IN ("Escuela", "Estudiante"));

ALTER TABLE cursos 
ADD INDEX FK_CURS_USU_idx (UsuarioCreador ASC),
ADD CONSTRAINT FK_CURS_USER
  FOREIGN KEY (UsuarioCreador)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;


ALTER TABLE cursos 
ADD CONSTRAINT CK_CURS_ESTADO
CHECK (EstadoCurso IN (0, 1));

ALTER TABLE categorias
ADD INDEX FK_CAT_USER_idx (UsuarioCreador ASC),
ADD CONSTRAINT FK_CAT_USER
  FOREIGN KEY (UsuarioCreador)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE niveles 
ADD INDEX FK_NIV_CURS_idx (CursoImpartido ASC),
ADD CONSTRAINT FK_NIV_CURS
  FOREIGN KEY (CursoImpartido)
  REFERENCES cursos (IdCurso)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE niveles 
ADD CONSTRAINT CK_NIV_GRATIS
CHECK (NivelGratis IN (0, 1));

ALTER TABLE niveles 
ADD CONSTRAINT CK_NIV_ESTADO
CHECK (EstadoNivel IN (0, 1));



ALTER TABLE compras 
ADD INDEX FK_COMP_USER_idx (UsuarioComprador ASC),
ADD CONSTRAINT FK_COMP_USER
  FOREIGN KEY (UsuarioComprador)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE compras   
ADD INDEX FK_COMP_CURS_idx (CursoComprado ASC),
ADD CONSTRAINT FK_COMP_CURS
  FOREIGN KEY (CursoComprado)
  REFERENCES cursos (IdCurso)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE compras 
ADD INDEX FK_COMP_FP_idx (FormaPago ASC),
ADD CONSTRAINT FK_COMP_FP
  FOREIGN KEY (FormaPago)
  REFERENCES forma_pago (IdFormaPago)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;



ALTER TABLE curscat 
ADD INDEX FK_CURSCAT_CURSO_idx (IdCategoria ASC),
ADD CONSTRAINT FK_CURSCAT_CURSO
  FOREIGN KEY (IdCategoria)
  REFERENCES categorias (IdCategoria)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE curscat 
ADD INDEX FK_CURSCAT_CURS_idx (IdCurso ASC),
ADD CONSTRAINT FK_CURSCAT_CURS
  FOREIGN KEY (IdCurso)
  REFERENCES cursos (IdCurso)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
  
  
ALTER TABLE comentarios 
ADD INDEX FK_COMEN_USER_idx (UsuarioComento ASC),
ADD CONSTRAINT FK_COMEN_USER
  FOREIGN KEY (UsuarioComento)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE comentarios 
ADD INDEX FK_COMEN_CURS_idx (CursoComentado ASC),
ADD CONSTRAINT FK_COMEN_CURS
  FOREIGN KEY (CursoComentado)
  REFERENCES cursos (IdCurso)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE comentarios 
ADD CONSTRAINT CK_COMEN_ESTADO
CHECK (EstadoComentario IN (0, 1));
  
  
  
  
ALTER TABLE calificaciones 
ADD INDEX FK_CALF_USER_idx (UsuarioCalifico ASC),
ADD CONSTRAINT FK_CALF_USER
  FOREIGN KEY (UsuarioCalifico)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE calificaciones 
ADD INDEX FK_CALF_CURS_idx (CursoCalificado ASC),
ADD CONSTRAINT FK_CALF_CURS
  FOREIGN KEY (CursoCalificado)
  REFERENCES cursos (IdCurso)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE calificaciones 
ADD CONSTRAINT CK_CALF_UTIL
CHECK (UtilidadCalificacion IN (0, 1));


ALTER TABLE calificaciones 
ADD CONSTRAINT CK_CALF_ESTADO
CHECK (EstadoCalificacion IN (0, 1));


ALTER TABLE mensajes 
ADD INDEX FK_MSJ_USER_idx (UsuarioEnvia ASC),
ADD CONSTRAINT FK_MSJ_USER_ENV
  FOREIGN KEY (UsuarioEnvia)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE mensajes 
ADD INDEX FK_MSJ_USER_REC_idx (UsuarioRecibe ASC),
ADD CONSTRAINT FK_MSJ_USER_REC
  FOREIGN KEY (UsuarioRecibe)
  REFERENCES usuarios (IdUsuario)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE mensajes 
ADD CONSTRAINT CK_MSJ_ESTADO
CHECK (EstadoMensaje IN (0, 1));
  
  
INSERT INTO roles (TipoRol) VALUES ('Escuela');
INSERT INTO roles (TipoRol) VALUES ('Estudiante');

INSERT INTO forma_pago (FormaPago) VALUES ('PayPal');
INSERT INTO forma_pago (FormaPago) VALUES ('Tarjeta');
INSERT INTO forma_pago (FormaPago) VALUES ('Gratis');


