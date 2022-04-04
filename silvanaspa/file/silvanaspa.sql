CREATE TABLE menu (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  padre_id BIGINT  NULL  ,
  nombre VARCHAR(255)  NULL  ,
  ruta VARCHAR(255)  NULL  ,
  icono VARCHAR(255)  NULL    ,
PRIMARY KEY(id)  ,
INDEX Menu_FKIndex1(padre_id),
  FOREIGN KEY(padre_id)
    REFERENCES menu(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE tipo_producto (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(255)  NULL  ,
  activo BOOL  NULL    ,
PRIMARY KEY(id))
ENGINE=InnoDB;

CREATE TABLE rol (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(255)  NULL  ,
  descripcion TEXT  NULL    ,
PRIMARY KEY(id))
ENGINE=InnoDB;

CREATE TABLE tipo_identificacion (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(255)  NULL    ,
PRIMARY KEY(id))
ENGINE=InnoDB;

CREATE TABLE anuncio (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  titulo VARCHAR(255)  NULL  ,
  mensaje TEXT  NULL  ,
  fecharegistro TIMESTAMP  NULL    ,
PRIMARY KEY(id))
ENGINE=InnoDB;

CREATE TABLE estado_usuario (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  nombre VARCHAR(255)  NULL    ,
PRIMARY KEY(id))
ENGINE=InnoDB;

CREATE TABLE producto (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  tipo_producto_id BIGINT  NOT NULL  ,
  nombre VARCHAR(255)  NULL  ,
  descripcion VARCHAR(255)  NULL  ,
  precio INTEGER UNSIGNED  NULL  ,
  creditos INTEGER UNSIGNED  NULL   COMMENT 'creditos que aporta el producto.' ,
  fecha_registro TIMESTAMP  NULL  ,
  imagen_producto VARCHAR(255)  NULL    ,
PRIMARY KEY(id)  ,
INDEX Producto_FKIndex1(tipo_producto_id),
  FOREIGN KEY(tipo_producto_id)
    REFERENCES tipo_producto(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE menu_rol (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  menu_id BIGINT  NOT NULL  ,
  rol_id BIGINT  NOT NULL    ,
PRIMARY KEY(id)  ,
INDEX MenuRol_FKIndex1(rol_id)  ,
INDEX MenuRol_FKIndex2(menu_id),
  FOREIGN KEY(rol_id)
    REFERENCES rol(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(menu_id)
    REFERENCES menu(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE usuario (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  estado_usuario_id BIGINT  NOT NULL  ,
  rol_id BIGINT  NOT NULL  ,
  tipo_identificacion_id BIGINT  NOT NULL  ,
  nombre VARCHAR(255)  NULL  ,
  apellido VARCHAR(255)  NULL  ,
  identificacion VARCHAR(255)  NULL  ,
  direccion VARCHAR(255)  NULL  ,
  telefono VARCHAR(255)  NULL  ,
  celular VARCHAR(10)  NULL  ,
  correo VARCHAR(255)  NULL  ,
  foto VARCHAR(255)  NULL  ,
  login VARCHAR(255)  NULL  ,
  clave VARCHAR(255)  NULL  ,
  fecha_registro TIMESTAMP  NULL  ,
  fecha_cambio_pass TIMESTAMP  NULL  ,
  activo BOOL  NULL  ,
  creditos INTEGER UNSIGNED  NULL  ,
  terminos_path VARCHAR(255)  NULL  ,
  fecha_aceptacion TIMESTAMP  NULL    ,
PRIMARY KEY(id)  ,
INDEX Usuario_FKIndex1(tipo_identificacion_id)  ,
INDEX Usuario_FKIndex2(rol_id)  ,
INDEX Usuario_FKIndex3(estado_usuario_id),
  FOREIGN KEY(tipo_identificacion_id)
    REFERENCES tipo_identificacion(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(rol_id)
    REFERENCES rol(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(estado_usuario_id)
    REFERENCES estado_usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE pagos (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  usuario_id BIGINT  NOT NULL  ,
  fecha_genera_recibo TIMESTAMP  NULL  ,
  precio INTEGER UNSIGNED  NULL  ,
  impuestos INTEGER UNSIGNED  NULL  ,
  descuentos INTEGER UNSIGNED  NULL  ,
  dias_operacion BIGINT  NULL  ,
  fecha_pago TIMESTAMP  NULL  ,
  soporte_pago VARCHAR(255)  NULL  ,
  fecha_validacion_pago TIMESTAMP  NULL  ,
  fecha_inicio TIMESTAMP  NULL  ,
  fecha_final TIMESTAMP  NULL  ,
  anulado BOOL  NULL  ,
  activo BOOL  NULL    ,
PRIMARY KEY(id)  ,
INDEX pagos_FKIndex1(usuario_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE login_log (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  usuario_id BIGINT  NOT NULL  ,
  fecha_apertura TIMESTAMP  NULL  ,
  fecha_cierre TIMESTAMP  NULL  ,
  ip VARCHAR(255)  NULL    ,
PRIMARY KEY(id)  ,
INDEX LoginLog_FKIndex1(usuario_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE venta_productos (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  usuario_id BIGINT  NOT NULL  ,
  producto_id BIGINT  NOT NULL  ,
  precio BIGINT  NULL  ,
  creditos INTEGER UNSIGNED  NULL  ,
  fecha_registro TIMESTAMP  NULL    ,
PRIMARY KEY(id)  ,
INDEX VentaProductos_FKIndex1(producto_id)  ,
INDEX venta_productos_FKIndex2(usuario_id),
  FOREIGN KEY(producto_id)
    REFERENCES producto(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(usuario_id)
    REFERENCES usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE anuncio_usuario (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  anuncio_id BIGINT  NOT NULL  ,
  usuario_id BIGINT  NOT NULL  ,
  visto BOOL  NULL  ,
  fecha_lectura TIMESTAMP  NULL    ,
PRIMARY KEY(id)  ,
INDEX Anunciousuario_FKIndex1(usuario_id)  ,
INDEX Anunciousuario_FKIndex2(anuncio_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(anuncio_id)
    REFERENCES anuncio(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;

CREATE TABLE medidas (
  id BIGINT  NOT NULL   AUTO_INCREMENT,
  staff_id BIGINT  NOT NULL  ,
  usuario_id BIGINT  NOT NULL  ,
  cuello REAL  NULL  ,
  hombro REAL  NULL  ,
  pecho REAL  NULL  ,
  brazo REAL  NULL  ,
  antebrazo REAL  NOT NULL  ,
  cintura REAL  NULL  ,
  gluteos REAL  NULL  ,
  pierna REAL  NULL  ,
  pantorrilla REAL  NULL  ,
  fecha_registro TIMESTAMP  NULL  ,
  pesokg REAL  NULL    ,
PRIMARY KEY(id)  ,
INDEX Medidas_FKIndex1(usuario_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(staff_id)
    REFERENCES usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;
