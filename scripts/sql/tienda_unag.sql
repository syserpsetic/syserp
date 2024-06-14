--1. Crear esquema facturar
CREATE SCHEMA facturar
    AUTHORIZATION erpunag;

GRANT ALL ON SCHEMA facturar TO erpunag;
GRANT SELECT ON SCHEMA facturar TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;


--2. Crear tabla facturar.tnd_cai
CREATE TABLE facturar.tnd_cai
(
    id serial,
    cai text COLLATE pg_catalog."default" NOT NULL,
    establecimiento text COLLATE pg_catalog."default" NOT NULL,
    punto text COLLATE pg_catalog."default" NOT NULL,
    tipo text COLLATE pg_catalog."default" NOT NULL,
    rango1 integer NOT NULL,
    rango2 integer NOT NULL,
    fecha timestamp(0) without time zone NOT NULL,
    correlativo integer NOT NULL,
    activo boolean NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_cai_pkey PRIMARY KEY (id)
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_cai TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_cai TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_cai_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--3. Crear facturar.tnd_empaque
CREATE TABLE facturar.tnd_empaque
(
    id serial,
    empaque text COLLATE pg_catalog."default" NOT NULL,
    orden integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_empaque_pkey PRIMARY KEY (id)
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_empaque TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_empaque TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_empaque_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--4. Crear facturar.tnd_estado_factura
CREATE TABLE facturar.tnd_estado_factura
(
    id serial,
    nombre text COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default",
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_estado_factura_pkey PRIMARY KEY (id)
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_estado_factura TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_estado_factura TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_estado_factura_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

INSERT INTO facturar.tnd_estado_factura(
	nombre, descripcion, created_at)
	VALUES ('Proceso',	'Factura en proceso', now()),
			('Espera',	'Factura en espera para ser cobrada', now()),
			('Cobrada',	'Factura cobrada con éxito', now()),
			('Anulada',	'Factura anulada', now());
			
--5. Crear facturar.tnd_factura
CREATE TABLE facturar.tnd_factura
(
    id serial,
    cai bigint NOT NULL,
    correlativo integer,
    tipo_factura text COLLATE pg_catalog."default",
    tipo_cliente text COLLATE pg_catalog."default",
    ref_cliente bigint,
    ref_empleado bigint,
    suma numeric(8,2),
    descuento numeric(8,2),
    subtotal numeric(8,2),
    impuesto numeric(8,2),
    total numeric(8,2),
    pagado_efectivo numeric(8,2),
    cambio numeric(8,2),
    facturado_credito numeric(8,2),
    pagado_tc_td numeric(8,2),
    referencia_tc_td text COLLATE pg_catalog."default",
    ref_usuario bigint,
    fecha_hora timestamp(0) without time zone NOT NULL,
    anulada boolean NOT NULL,
    razon_anulacion text COLLATE pg_catalog."default",
    autorizacion_anulacion integer,
    id_estado_factura bigint NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_factura_pkey PRIMARY KEY (id),
    CONSTRAINT tnd_factura_cai_foreign FOREIGN KEY (cai)
        REFERENCES facturar.tnd_cai (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT tnd_factura_ref_usuario_foreign FOREIGN KEY (ref_usuario)
        REFERENCES users (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT tnd_id_estado_factura_foreign FOREIGN KEY (id_estado_factura)
        REFERENCES facturar.tnd_estado_factura (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_factura TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_factura TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_factura_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--6. Crear facturar.tnd_medida
CREATE TABLE facturar.tnd_medida
(
    id serial,
    medida text COLLATE pg_catalog."default" NOT NULL,
    abreviatura text COLLATE pg_catalog."default" NOT NULL,
    orden integer NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_medida_pkey PRIMARY KEY (id)
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_medida TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_medida TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_medida_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--7. Crear facturar.tnd_rubro
CREATE TABLE facturar.tnd_rubro
(
    id serial,
    sigla text COLLATE pg_catalog."default" NOT NULL,
    rubro text COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default" NOT NULL,
    estatus boolean NOT NULL,
    orden integer NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_rubro_pkey PRIMARY KEY (id)
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_rubro TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_rubro TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_rubro_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--8. Crear facturar.tnd_producto
CREATE TABLE facturar.tnd_producto
(
    id serial,
    rubro bigint NOT NULL,
    correlativo_rubro integer NOT NULL,
    producto text COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default" NOT NULL,
    etiquetas text COLLATE pg_catalog."default" NOT NULL,
    pics text COLLATE pg_catalog."default" NOT NULL,
    empaque bigint NOT NULL,
    medida bigint NOT NULL,
    cant_medida integer NOT NULL,
    activo boolean NOT NULL,
    precio_venta numeric(10,2) NOT NULL,
    impuesto integer NOT NULL,
    cant_disponible integer NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_producto_pkey PRIMARY KEY (id),
    CONSTRAINT tnd_producto_empaque_foreign FOREIGN KEY (empaque)
        REFERENCES facturar.tnd_empaque (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT tnd_producto_medida_foreign FOREIGN KEY (medida)
        REFERENCES facturar.tnd_medida (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT tnd_producto_rubro_foreign FOREIGN KEY (rubro)
        REFERENCES facturar.tnd_rubro (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_producto TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_producto TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_producto_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--9. Crear facturar.tnd_factura_filas
CREATE TABLE facturar.tnd_factura_filas
(
    id serial,
    id_factura bigint NOT NULL,
    id_producto bigint NOT NULL,
    codigo text COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default" NOT NULL,
    empaque text COLLATE pg_catalog."default" NOT NULL,
    medida_abreviatura text COLLATE pg_catalog."default" NOT NULL,
    cant_medida integer NOT NULL,
    cantidad integer NOT NULL,
    precio_venta numeric(8,2) NOT NULL,
    valor numeric(8,2) NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_factura_filas_pkey PRIMARY KEY (id),
    CONSTRAINT tnd_factura_filas_id_producto_foreign FOREIGN KEY (id_producto)
        REFERENCES facturar.tnd_producto (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_factura_filas TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_factura_filas TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_factura_filas_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--10. Crear vista facturar.view_productos_list
CREATE OR REPLACE VIEW facturar.view_productos_list
 AS
 SELECT p.id,
    p.rubro,
    r.sigla,
    p.correlativo_rubro,
    to_char(p.correlativo_rubro, '000'::text) AS correlativo_rubro_formato,
    p.producto,
    p.descripcion,
    p.etiquetas,
    p.pics,
    p.empaque,
    e.empaque AS nombre_empaque,
    p.medida,
    m.abreviatura AS medida_abreviatura,
    p.cant_medida,
    p.activo,
    to_char(p.precio_venta, 'LFM999,999,990.00'::text) AS precio_venta_formato,
    p.precio_venta,
    p.impuesto,
    p.cant_disponible
   FROM facturar.tnd_producto p
     JOIN facturar.tnd_rubro r ON p.rubro = r.id AND r.deleted_at IS NULL
     JOIN facturar.tnd_empaque e ON p.empaque = e.id AND e.deleted_at IS NULL
     JOIN facturar.tnd_medida m ON p.medida = m.id AND m.deleted_at IS NULL
  WHERE p.deleted_at IS NULL
  ORDER BY p.producto;

ALTER TABLE facturar.view_productos_list
    OWNER TO cmatute;

--10. Crear Facturar.tnd_metodo_pago
CREATE TABLE facturar.tnd_metodo_pago
(
    id serial,
    nombre text COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default",
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_metodo_pago_pkey PRIMARY KEY (id)
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_metodo_pago TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_metodo_pago TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_metodo_pago_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

INSERT INTO facturar.tnd_metodo_pago(
	nombre, descripcion, created_at)
	VALUES ('Credito',	'Pago al crédito', now()),
			('Contado',	'Pago al contado', now()),
			('Uso Interno',	'Uso interno', now());
			
--11. 
alter table facturar.tnd_factura add constraint tnd_factura_uk_001 unique(cai, correlativo);

--12. Crear facturar.tnd_cajas
CREATE TABLE facturar.tnd_cajas
(
    id serial,
    numero_caja integer NOT NULL,
    descripcion text NOT NULL,
	id_empleado integer NOT NULL,
	id_cai integer NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_cajas_pkey PRIMARY KEY (id),
	CONSTRAINT tnd_tnd_cajas_id_empleado_foreign FOREIGN KEY (id_empleado)
        REFERENCES public.per_empleado (id_empleado) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT tnd_tnd_cajas_cai_foreign FOREIGN KEY (id_cai)
        REFERENCES facturar.tnd_cai (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE facturar.tnd_cajas TO erpunag;
GRANT SELECT ON TABLE facturar.tnd_cajas TO cmatute, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON facturar.tnd_cajas_id_seq TO erpunag, reports, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

--13 Crear facturar.tnd_usuario_login
CREATE TABLE facturar.tnd_usuario_login
(
    id serial,
    usuario bigint NOT NULL,
    token text COLLATE pg_catalog."default" NOT NULL,
    device text COLLATE pg_catalog."default" NOT NULL,
    fecha_hora_inicio timestamp(0) without time zone NOT NULL,
    estatus boolean NOT NULL,
    fecha_hora_fin timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_usuario_login_pkey PRIMARY KEY (id),
    CONSTRAINT tnd_usuario_login_usuario_foreign FOREIGN KEY (usuario)
        REFERENCES public.users (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--14 Crear facturar.tnd_nivel_usuario
CREATE TABLE facturar.tnd_nivel
(
    id serial,
    nivel text COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default" NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_nivel_pkey PRIMARY KEY (id)
);

INSERT INTO facturar.tnd_nivel(
	nivel, descripcion, created_at)
	VALUES 
	('Súper administrador', 'Desarrollador', now()),
	('Administrador', 'Gerente de tienda', now()),
	('Asistente', 'Asistentes de gerente de tienda', now()),
	('Caja',	'Personal de punto de venta', now());
	
--15 Crear facturar.tnd_cliente
CREATE TABLE facturar.tnd_cliente
(
    id serial,
    nombre1 text COLLATE pg_catalog."default" NOT NULL,
    nombre2 text COLLATE pg_catalog."default" NOT NULL,
    apellido1 text COLLATE pg_catalog."default" NOT NULL,
    apellido2 text COLLATE pg_catalog."default" NOT NULL,
    pic text COLLATE pg_catalog."default" NOT NULL,
    identidad text COLLATE pg_catalog."default" NOT NULL,
    tipo text COLLATE pg_catalog."default" NOT NULL,
    num_empleado integer NOT NULL,
    cargo text COLLATE pg_catalog."default" NOT NULL,
    dependencia text COLLATE pg_catalog."default" NOT NULL,
    direccion text COLLATE pg_catalog."default" NOT NULL,
    telefono text COLLATE pg_catalog."default" NOT NULL,
    celular text COLLATE pg_catalog."default" NOT NULL,
    razon_social text COLLATE pg_catalog."default" NOT NULL,
    rtn text COLLATE pg_catalog."default" NOT NULL,
    categoria text COLLATE pg_catalog."default" NOT NULL,
    clave text COLLATE pg_catalog."default" NOT NULL,
    clave_cambiada boolean NOT NULL,
    estatus boolean NOT NULL,
    created_at timestamp(0) without time zone default now(),
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT tnd_cliente_pkey PRIMARY KEY (id)
);

insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-1-1', 'tnd_menu', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-2-1', 'tnd_facturar', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-2-2', 'tnd_facturar_enviar_caja', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-2-3', 'tnd_facturar_guardar_venta', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-3-1', 'tnd_ver_facturas_pendientes', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-4-1', 'tnd_ver_productos', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-4-2', 'tnd_escribir_productos', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-5-1', 'tnd_ver_cai', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-5-2', 'tnd_escribir_cai', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-6-1', 'tnd_ver_caja', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-6-2', 'tnd_escribir_caja', '101', false);
insert into seg_permisos_menu (id_permiso_menu, arbol_nivel, descripcion_permiso, unidad, borrado) values ((select max(id_permiso_menu)+1 from seg_permisos_menu),'101-7-1', 'tnd_reportes', '101', false);


--4
INSERT INTO facturar.tnd_medida (medida, abreviatura, orden, created_at) VALUES
('LIBRA', 'LB', 0, now()),
('UNIDAD', 'UND', 0, now()),
('METRO', 'MT', 0, now());

--5
INSERT INTO facturar.tnd_empaque (empaque, orden, created_at) VALUES
('BOLSA', 0, now()),
('CARTÓN', 0, now()),
('BOTE', 0, now());

--6
INSERT INTO facturar.tnd_rubro (sigla, rubro, descripcion, estatus, orden, created_at) VALUES
('PC', 'PLANTA CÁRNICA', '', true, 0, now()),
('PL', 'PLANTA DE LÁCTEOS', '', true, 0, now()),
('HV', 'GRANJA AVÍCOLA', '', true, 0, now()),
('CI', 'CULTIVOS INDUSTRIALES', '', true, 0, now()),
('FA', 'FINCA AGRO ECOLÓGICA', '', true, 0, now()),
('SH', 'SECCIÓN HORTALIZAS', '', true, 0, now()),
('SF', 'SECCIÓN FRUTALES', '', true, 0, now()),
('PS', 'SECCIÓN PISCICULTURA ', '', true, 0, now()),
('SE', 'SECCIÓN EXPERIMENTAL', '', true, 0, now()),
('PBALC', 'PLANTA DE BIOPROCESOS', '', true, 0, now()),
('CO', 'CENTRO OVINO', '', true, 0, now()),
('CP', 'CENTRO PORCINO', '', true, 0, now()),
('SA', 'SECCION DE AGRONOMÍA', '', true, 0, now()),
('PA', 'PLANTA DE AGUA', '', true, 0, now()),
('PH', 'PLANTA HORTOFRUTÍCOLA', '', true, 0, now()),
('CA', 'CENTRO APÍCOLA', '', true, 0, now()),
('PF', 'PASTOS Y FORRAJES', '', true, 0, now()),
('SP', 'SECCIÓN DE PROPAGACIÓN', '', true, 0, now()),
('VF', 'VIVERO FORESTAL', '', true, 0, now());

--7
INSERT INTO facturar.tnd_producto (rubro, correlativo_rubro, producto, descripcion, etiquetas, pics, empaque, medida, cant_medida, activo, precio_venta, impuesto, cant_disponible, created_at) VALUES
(4, 1, 'AJONJOLÍ', 'La fibra que posee esta valiosa semilla ayuda con la glucosa contenida en la sangre, y la limpieza  del sistema digestivo y su agilización al momento de procesar las comidas.', '["SEMILLA","SEMILLAS"]', '[]', 1, 1, 2, true, '5.00', 0, 5, now()),
(4, 2, 'CACAO EN BABA', 'Sus características son pulpa ligosa y dulce con un aroma entre ácido y amargo pero delicioso al sabor y al olfato.', '["GRANO","SEMILLA","GRANOS","SEMILLAS"]', '[]', 1, 1, 1, true, '10.00', 0, 10, now()),
(4, 3, 'ESQUEJES DE YUCA', 'Biofortificada, Manihot esculenta. Este cultivo también es conocido con el nombre de mandioca,', '["TALLO"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(4, 4, 'JENJIBRE', 'El jengibre es una planta herbácea nativa del Lejano Oriente. Cultivado en todo el cinturón tropical y subtropical', '["RAIZ","TALLO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(4, 5, 'MARAÑON', 'Fruto. La verdadera fruta del marañón es la semilla, conocida como pepa, que contiene una almendra', '["FRUTA","SEMILLA"]', '[]', 1, 1, 1, true, '15.00', 0, 15, now()),
(4, 6, 'MINIMO VERDE', 'El nombre científico Musa × paradisiaca (o Musa paradisiaca) y los nombres comunes platanera', '["FRUTO","CUILTIVO"]', '[]', 1, 2, 1, true, '20.00', 0, 20, now()),
(4, 7, 'PLATANO', 'El plátano es una aromática fruta tropical con múltiples propiedades y beneficios para la salud que procura energía para afrontar los retos diarios', '["MUSACEAS","FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(4, 8, 'YUCA', 'La yuca, del género Manihot y la especie esculenta, es el tubérculo del arbusto perenne de la familia de las Eufobiaceas.', '["TUBERCULO","VERDURA"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(4, 9, 'YUYUGA', 'Aumenta la producción de glóbulos rojos en la sangre, porque es una fruta rica en hierro, de esta forma actúa como un preventivo de la anemia', '["FRUTA"]', '[]', 1, 3, 1, true, '0.00', 0, 0, now()),
(4, 10, 'JAMAICA', 'La flor o caliz de jamaica es, como su nombre lo indica, la flor de la planta arbustiva (Hibiscus sabdariffa L.) perteneciente a la familia Malvaceae', '["FLOR","FRUTA"]', '[]', 1, 1, 3, true, '25.00', 0, 25, now()),
(5, 1, 'YUCA', 'La yuca, también conocida como mandioca o tapioca, es un tubérculo rico en almidones, una raíz comestible muy apetecida', '["VERDURA"]', '[]', 1, 1, 5, true, '30.00', 0, 30, now()),
(5, 2, 'ZAPALLO', 'Gracias a su alto nivel de fibra, el zapallo ayuda a regular la función intestinal porque se digiere con facilidad -en especial, cuando se cocina hervido', '["CALABAZA","VERDURA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(5, 3, 'CULANTRILLO', 'El culantrillo de pozo tiene diferentes usos medicinales entre las que podemos destacar propiedades antitusivas, pectoral, diurética', '["HELECHO"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(5, 4, 'LECHUGA ROMANA', 'Actúa como antioxidante.- El contenido antioxidante de la lechuga romana puede apoyar al sistema inmunológico', '["LEGUMRES"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(5, 5, 'MAIZ', 'El maíz o zea mays es un cereal, una planta gramínea americana, que se caracteriza por tener tallos largos y macizos (y no huecos como sus parientes más cercanos) al final de los cuales se dan espigas', '["GRANO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 1, 'CACAO', 'planta de hoja perenne de la familia Malvaceae. Theobroma significa, en griego, «alimento de los dioses', '["planta","Magnoliopsida"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 2, 'CAIMITO', 'El caimito (Chrysophyllum cainito) es un árbol tropical de la familia Sapotaceae, originario de las áreas de baja elevación de América Central y del Caribe.', '["PLANTA","Magnoliopsida"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 3, 'JAMAICA', 'Hibiscus sabdariffa es un hibisco de la familia de las malváceas, originario de África tropical, desde Egipto y Sudán hasta Senegal, aunque, debido a sus propiedades medicinales o a su sabor en infusi', '["FLOR","Hibiscus sabdariffa"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 4, 'PLANTA DE MANZANA', 'el manzano europeo o manzano común, es un árbol de la familia de las rosáceas, cultivado por su fruto, apreciado como alimento.', '["FRUTA","ARBOL"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 5, 'MIAMI PALMERA', 'Descripción general de la especiepalmera que puede llegar a medir 6 m de altura, posee un único tronco liso, de color grisáceo y cortos segmentos anillados', '["PALMA","COQUILLO"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 6, 'PALMA REAL', 'palma real, es una especie de palma cuya altura, elegancia y fácil cultivo', '["silueta majestuosa,"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 7, 'PALMERA', 'Las arecáceas son una familia de plantas monocotiledóneas, la única familia del orden Arecales.', '["ARBUSTO ","PLANTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 8, 'PALMERA ARECA', 'Areca, es un género de plantas con flores perteneciente a la familia de las palmeras', '["PALMERA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 9, 'PLANTA DE AGUACATE', 'Persea americana, llamado popularmente aguacate, ​​​ palto ​​ o aguacatero, ​ es una especie arbórea del género Persea perteneciente a la familia Lauraceae, cuyo fruto, el aguacate​​ o palta,', '["FRUTA","PLANTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 10, 'PLANTA ARAZA', 'El arazá nos ofrece muy buenas propiedades nutricionales, con alto contenido de azúcares, minerales, antioxidantes y vitaminas A, B1 y C.', '["Eugenia stipitata","PLANTA","FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 11, 'PLANTA DE CANELA', 'El árbol de la canela, conocido como canelo, ​ es un árbol de hoja perenne, de 10 a 15 metros de altura', '["PLANTA AROMATICA","ARBOL"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 12, 'PLANTA DE GRANADILLA', 'llamada popularmente granadilla o granada china, es una planta trepadora perteneciente a la familia Passifloraceae originaria desde el centro de México,', '["FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 13, 'PLANTA DE GUANABANA', 'a guanábana, una fruta tropical con un aspecto curioso, esconde en su interior un conjunto de vitaminas, sales minerales y antioxidantes', '["FRUTA TROPICAL"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 14, 'PLANTA DE GUAYABA', 'Las guayabas son un género de unas cien especies de árboles tropicales y árboles pequeños en la familia Myrtaceae, nativas de América. Las hojas son opuestas, simples, elípticas a ovaladas, de 5 a 15 ', '["PLANTA","FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 15, 'PLANTA DE LICHA', 'Planta: El árbol del litchi es bajo, atractivo, de 10-12 m de altura, con el tronco de ramas bajas; recto, áspero; la corteza de color café oscuro y la corona', '["FRUTA","LICHI"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 16, 'PLANTA DE MAMON', 'El Mamon es una palabra griega que quiere decir fruto redondo con miel, también quiere decir dos pares,', '["FRUTA","DULCE","Psidium guajava"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 17, 'PLANTA DE MANGO', 'Mangifera indica, comúnmente mango o melocotón de los trópicos, es una especie arbórea frutal perteneciente a la familia Anacardiaceae.', '["FRUTO","PLANTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 18, 'PLANTA DE MARACUYA', '​ Pertenece al género Passiflora y su fruto comestible, de color amarillo, anaranjado o morado, es el maracuyá', '["FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 19, 'PLANTA DE MARAÑÓN', 'El árbol del Marañón es una especie arbórea tropical de aprovechamiento integral', '["NUEZ"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 20, 'PLANTA DE MIRAMELO', 'El carambolo es un arbusto tropical perenne, perteneciente la familia oxalidaceae.​ Su fruto es la carambola, que también recibe los nombres de fruta de estrella', '["FRUTA ESTRELLA","CARAMBOLO"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 21, 'PLANTA DE NANCE', 'Nance Es un árbusto o árbol pequeño de lento crecimiento, que normalmente llega a 10 metros de altura. Sus flores son rojo-velludas y nacen en racimos', '["FRUTA AMARILLA ","FRUTO PULPOSO "]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 22, 'PLANTA DE PAPAYA', 'arica papaya es una planta herbácea del género Carica en la familia Caricaceae. Su fruto se conoce comúnmente como papaya, papayón, fruta bomba,', '["FRUTA","BONBA","PLANTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 23, 'PLANTA DE PITAYA', 'a planta pitaya — La pitaya, pitahaya o fruta del dragón, es una fruta de la familia Cactaceae que se ha popularizad', '["FRUTA DRAGON"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 24, 'PLANTA DE YUYUGA', 'La yuyuga, en pruebas biológicas, presenta un volumen 20 veces mayor de vitamina C que la manzana, además sirve como un laxante por su fibra y se ha demostrado que ataca las infecciones especialmente ', '["FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 25, 'POLIALTO', 'Polyalthia longifolia es una planta de la familia Annonaceae, a veces mal identificado, como el árbol de Ashoka debido a la cercana semejanza entre ambas especies.', '["Polyalthia longifolia","árbol de Ashoka"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 26, 'TAMARINDO', 'Tamarindus indica es un árbol tropical y la única especie del género Tamarindus, perteneciente a las Fabaceae, subfamilia Caesalpinioideae, de frutos comestibles muy apreciados en diversos países.', '["FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 27, 'FRUTA MIRAMELO', 'El carambolo es un arbusto tropical perenne, perteneciente la familia oxalidaceae.​ Su fruto es la carambola,', '["FRUTA","ESTRELLA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 28, 'FRUTA GUAYABA', 'as guayabas son un género de unas cien especies de árboles tropicales y árboles pequeños en la familia Myrtaceae, nativas de América.', '["FRUTA TROPICAL"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 29, 'FRUTA LICHA', 'El lichi o litchi es una fruta tropical que la organización 5alDía reconoce como una “excelente fuente de azúcar, proteínas, fibra, vitaminas B1, B2 y C, calcio, potasio, fósforo y magnesio.', '["FRUTA TROPICAL"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 30, 'AGUACATE', 'llamado popularmente aguacate, ​​​ palto ​​ o aguacatero, ​ es una especie arbórea del género Persea perteneciente a la familia Lauraceae, cuyo fruto, el aguacate​​ o palta,', '["FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 31, 'HUEVOS', 'Los huevos de las aves constituyen un alimento habitual en la alimentación de los humanos. Se presentan protegidos por una cáscara y son ricos en proteínas y lípidos', '["ALIMENTO NUTRITIVO","PROTEINA","BLANCO"]', '[]', 2, 2, 30, true, '0.00', 0, 0, now()),
(3, 1, 'HUEVO', 'Los huevos de las aves constituyen un alimento habitual en la alimentación de los humanos. Se presentan protegidos por una cáscara y son ricos en proteínas y lípidos', '["ALIMENTO NUTRITIVO","PROTEINA"]', '[]', 2, 2, 30, true, '0.00', 0, 0, now()),
(3, 2, 'MENUDOS DE POLLO', 'La chanfaina de menudos es un platillo tradicional de Honduras que se basa en menudos de pollo bien sazonados con especies variadas y vegetales', '["ALIMENTO","VICERAS DEL POLLO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(3, 3, 'POLLO ENTERO', 'La carne de pollo es como se denomina a los tejidos musculares y órganos procedentes del pollo. Es muy frecuente encontrarla en muchos platos', '["CARNE","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(13, 1, 'FRIJOL', 'Un frijol es la semilla de uno de los varios géneros de las plantas con flor de la familia Fabaceae, que se utilizan como hortalizas para la alimentación', '["ALIMENTO","SEMILLA","PLANTA","HORTALIZA "]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(14, 1, 'BOTELLON DE AGUA', 'El agua es una sustancia cuya molécula está compuesta por dos átomos de hidrógeno y uno de oxígeno unidos por un enlace covalente.​ El término agua, generalmente, se refiere a la sustancia en su estad', '["LIQUIDO"," hidrógeno, oxígeno "]', '[]', 3, 2, 1, true, '0.00', 0, 0, now()),
(1, 1, 'ARRACHERA DE RES', 'La arrachera es parte del diafragma de la res y fue “inventada” en México ... Antes de los setentas, la arrachera no se llamaba así y era un corte', '["CARNE","RES","ANIMAL"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 2, 'BACON', 'La panceta o tocineta es un producto cárnico que comprende la piel y las capas que se encuentran bajo la piel del cerdo o puerco,', '["CERDO","ALIMENTO","CARNE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 3, 'BASO DE RES', 'El bazo de res un órgano vascular que tiene muy poca estimación comercial, a pesar de su alto contenido en proteínas', '["CARNE","VISCERA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 4, 'BISTEC MARINADO', 'Un filete, bistec, bisté o bife es cualquier corte de carne roja que haya sido cortada en forma de filete para el consumo humano', '["RES","CARNE","PROTEINA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 5, 'BOFE DE RES', 'ulmón, es decir, con la acepción de órgano del aparato respiratorio de los vertebrados superiores, esponjoso, blando y flexible', '["VISCERA DE RES","CARNE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 6, 'CABEZA DE CERDO', 'La cabeza de cerdo es un corte del porcino, resultante de su matanza. Tras su separación del tronco suele prepararse en salazón, o asada.​ En salazón suele participar del cocido manchego', '["CORTE DEL PORCINO","CARNE"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(1, 7, 'CARNE ENDIABLADA', 'PREPERACION DE CARNE DE RES', '["CARNE "]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 8, 'CARNE ENDIABLADA', 'PREPERACION DE CARNE DE RES', '["CARNE "]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 9, 'CARNE MOLIDA ESPECIAL', 'Características. Gracias a que esta carne es finamente picada su sabor es más acentuado y le da un sabor totalmente diferente a las comidas.', '["RES","CARNE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 10, 'CARNE MOLIDA NORMAL', 'CARNE DE RES MOLIDA', '["RES","CARNE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 11, 'CARNE PARA ASAR', 'CARNE DE RES ESPECIAL', '["RES","ANIMAL","CARNE"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 12, 'CARNE DE CERDO PARA ASAR', 'TAJO DE CERDO ESPECIAL PARA ASAR', '["CERDO","ANIMAL","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 13, 'CARNE PARA ASAR MARINADA', 'CARNE DE CERDO PREPARADA CON ESPECIES', '["CERDO","CARNE","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 14, 'CARNE PARA TAPADO', 'CARNE DE RES ESPECIAL `', '["RES","CARNE","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 15, 'CHORIZO CRIOLLO EN PASTA', 'CARNE DE CERDO EN CHORIZO YA PREPARADO', '["CERDO","ALIMENTO","CARNE"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 16, 'CHORIZO CRIOLLO EN TRIPA', 'CARNE DE CERDO PREPARADO EN CHORIZO EN TRIPA', '["CERDO","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 17, 'CHORIZO DE DESAYUNO', 'CARNE DE CERDO PREPARADA PARA CHORIZO', '["CERDO","CARNE","EMBUTIDO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 18, 'CHORIZO ESPAÑOL', 'El chorizo es un embutido cárnico originario de la península ibérica,​ tradicional también ... que el chorizo ibérico se le conoce en esta región como chorizo español)', '["EMBUTIDO","CERDO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 19, 'CHORIZO EXTREMEÑO', 'El chorizo ibérico es un embutido con una larga tradición en Extremadura que se elabora a base de carne picada, grasa de cerdo y especias.', '["EMBUTIDO","CERDO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 20, 'CHULETA AHUMADA', 'La chuleta de cerdo ahumada es un filete preparado en salazón y con un toque de ahumado como su nombre indica', '["FILETE DE CERDO","ALIMENTO","CARNE"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 21, 'CHULETA FRESCA', 'Una chuleta de cerdo es un corte de carne obtenido del espinazo del puerco.', '["CERDO","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 22, 'CHULETA FRESCA RANCHERA', 'a chuleta ranchera de cerdo es ideal para asar, guisar, freír, es un rico y delicioso producto que se puede acompañar con deliciosas guarniciones al gusto.', '["CERDO","CARNE","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 23, 'COLA', 'Además de suculento, supone un alimento esencial en una dieta sana y equilibrada. Sus propiedades nutritivas son indiscutibles', '["RES","CARNE","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 24, 'COSTILLA AHUMADA', 'CORTES FRESCOS Y AHUMADOS · Descripción. La costilla ahumada de cerdo de La Única es precocida, con alrededor de 5 cm de grosor de carne', '["CERDO","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 25, 'CORAZÓN', 'Corazón de res ... Esta deliciosa carne magra tiene un sabor y una textura muy similar al bistec y se adapta bien a cualquier condimento o adobo', '["RES","ALIMENTO","CARNE"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 26, 'COSTILLA BABY BACK RIBS', 'Las costillas traseras se cortan desde donde la costilla se encuentra con la columna vertebral después de que se retira el lomo', '["CERDO","CARNE","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 27, 'COSTILLA FRESCA', 'Las costillas de cerdo es una carne sabrosa, que podemos usar en diferentes platos.', '["CERDO","CARNE","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 28, 'COSTILLA FRESCA A GRANEL', 'COSTILLA RES DEL CORRAL FRESCA GRANEL LIBRA', '["CERDO","ALIMENTO","CARNE"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 29, 'FAJITAS DE RES MARINADAS', 'CARNE DE RES EN TIRAS ESPECIAL', '["CARNE","ALIEMENTO","RES"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 30, 'FILETE DE CERDO', 'Un corte cuidadoso de la parte del lomo del cerdo, también conocido como solomillo. Es un corte magro libre de grasas casi en su totalidad.', '["LOMO DE CERDO","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 31, 'FILETE DE RES', 'Un filete, bistec, bisté o bife es cualquier corte de carne roja que haya sido cortada en forma de filete para el consumo humano.', '["CARNE ROJA","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 32, 'HIGADO', 'La carne de hígado de res es considerada como un súper alimento: es rica en proteínas, vitamina A, B y C; contiene minerales', '["VÍSCERA DE RES"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 33, 'HUESO PARA SOPA', 'Contiene muchas vitaminas y minerales: el caldo hecho con huesos es rico en minerales y ayuda a regenerar y reforzar tus huesos', '["RES","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 34, 'JAMON', 'El jamón es el nombre genérico del producto alimenticio obtenido de las patas traseras del cerdo', '["CERDO","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 35, '', 'Es un embutido pre cocido de pasta mixta, elaborado a partir de la combinación de masa emulsificada de mortadela y jamón', '["CERDO","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 36, 'LENGUA', 'La lengua de res es parte de la boca de la vaca. El consumo humano de lengua de vaca se remonta a los días del Paleolítico donde los cazadores,', '["VISCERA DE RES","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 37, 'LOMO DE CERDO', 'El lomo de cerdo es cada una de las dos piezas de la carne del cerdo que están junto al espinazo y bajo las costillas del animal.', '["CERDO","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 38, 'LOMO DE RES', 'Corte proveniente de un músculo de soporte, que se ubica en el lomo posterior a lo interno de la canal bovina (Res, now()), es de forma cónica.', '["ALIMENTO","CARNE DE RES"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 39, 'LONJA', 'El primer lonja se refiere a una tira de cuero o loncha cortada de un alimento. Este viene del francés longe', '["CERDO","ALIMENTO"]', '[]', 1, 1, 10, true, '0.00', 0, 0, now()),
(1, 40, 'MANO DE PIEDRA', 'Carne de Res Mano de Piedra. Es un corte magro de textura sólida, sus cocciones son largas y es ideal para preparar platillos como el salpicón.', '["CARNE PARA SALPICON"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 41, 'MORTADELA', 'Es un embutido escaldado —tratamiento que favorece la conservación y coagulación de proteínas— con una estructura firme. Tiene un color rosado', '["EMBUTIDO DE CERDO","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 42, 'PELLEJO', 'Se obtiene de todos los procesos que pasan las demás piezas, su tamaño es variable. Contiene la grasa que naturalmente posee y no tiene mucha carne.', '["CERDO","ALIMENTO"]', '[]', 1, 1, 10, true, '0.00', 0, 0, now()),
(1, 43, 'CHORIZO PEPERONI', 'Efectivamente, es un término inventado por los italo-americanos para denominar este producto similar al salami o al chorizo y que, posiblemente, debe su nombre al uso del pimentón. Peperoni', '["EMBUTIDO","CERDO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 44, 'PUYAZO DE RES', 'Es un corte que se encuentra en el trasero del novillo. Dependiendo de la cantidad de grasa que tiene se clasifica en diferentes calidades', '["CORTE DE RES","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 45, 'RIBEYE DE RES', 'El ojo de costilla es un filete extraído de la sección de la costilla de ternera, entre las costillas seis y la doce.', '["CORTE ESPECIAL DE RES"]', '[]', 1, 1, 1, true, '45.00', 0, 50, now()),
(1, 46, 'RIÑON', 'Los riñones constituyen una buena fuente de vitaminas, especialmente hidrosolubles del grupo B: tiamina, riboflavina, niacina, B6, B12, y ácido fólico.', '["VISCERA DE RES"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 47, 'TAJO MOLIDO ESPECIAL', 'Tajo de res molido, posee un 20% de grasa y es ideal para tortas para hamburguesa.', '["CARNE DE RES","ALIMENTO"]', '[]', 1, 1, 3, true, '0.00', 0, 0, now()),
(1, 48, 'TBONE', 'El T-bone es un filete generalmente elaborado a la parrilla y de corte típico en el que puede verse el hueso en forma de T. El grosor de este filete no debe sobrepasar los tres centímetros. El T-bone ', '["CORTE ESPECIAL DE RES"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 49, 'TESTICULOS', 'Criadillas es el nombre gastronómico que reciben los testículos de cualquier animal de matadero', '["VISCERA DE RES","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 50, 'UBRE', 'Triglicéridos: aportan glicerol y ácidos grasos de cadena larga saturados e insaturados para la síntesis de grasa. Para su metabolismo interno y la síntesis de componentes de la leche, la ubre utiliza', '["VISCERA DE RES","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(1, 51, 'GUANABANA', 'Annona muricata, la guanábana​ —nombre de origen taíno— o graviola​ es un árbol de la familia Annonaceae', '["FRUTA","Annona muricata"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(11, 1, 'OVEJO', 'a oveja ​es un mamífero cuadrúpedo ungulado doméstico, utilizado como ganado. Como todos los rumiantes, las ovejas son artiodáctilos, o animales con pezuñas. A pesar de que el término oveja se aplica ', '["ANIMAL "]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(8, 1, 'PESCADO VIVO', 'El término pescado se refiere a los peces extraídos de su hábitat para servir como alimento​. Estos peces pueden ser pescados en el agua —océanos, mares, ríos, lagos—, pero también pueden ser criados ', '["ALIMENTO","CARNE BLANCA "]', '[]', 1, 1, 5, true, '0.00', 0, 0, now()),
(8, 2, 'PESCADO LIMPIO', 'El término pescado se refiere a los peces extraídos de su hábitat para servir como alimento​. Estos peces pueden ser pescados en el agua —océanos, mares, ríos, lagos—, pero también pueden ser criados ', '["ALIMENTO","CARNE BLANCA"]', '[]', 1, 1, 5, true, '0.00', 0, 0, now()),
(2, 1, 'QUESO CHEDDAR', 'El cheddar es un queso pálido de sabor agrio, originalmente producido en la villa de Cheddar, en Somerset, Inglaterra', '["DE LA LECHE DE VACA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(2, 2, 'MANTEQUILLA ACIDA', 'es una emulsión más o menos sólida considerada apta para consumo humano, producto del batido, amasado y lavado de grasas lácteas y agua', '["DE LA LECHE DE LA VACA","GRASA DE LA LECHE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(2, 3, 'QUESO FRESCO', 'Queso Fresco o Queso Blanco o Cuajada es un tipo de queso blando; es decir, retiene gran parte del suero y no tiene proceso de maduración o refinado.', '["DE LA LECHE DE LA VACA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(2, 4, 'QUESO MOZZARELA', 'La mozzarella del italiano mozzare ‘cortar’ o de su variante regional muzzare, es un tipo de queso originario de la cocina italiana', '["DE LA LECHE DE LA VACA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(2, 5, 'MANTEQUILLA CREMA', 'La crema de mantequilla o crema de manteca es un tipo de crema usado para rellenar pasteles, recubrirlos o decorarlos. En su forma más sencilla, se hace batiendo mantequilla', '["GRASA DE LA LECHE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(2, 6, 'QUESO SEMI SECO', 'Producto Artesanal. | Cuando llega la hora de preparar platos increibles, el queso siempre será un ingrediente estrella en ellos', '["LECHE DE LA VACA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(2, 7, 'QUESO CON CHILE', 'El chili con queso es un aperitivo servido en los restaurantes de cocina que consiste en queso Velveeta mezclado con chile jalapeño.', '["LECHE DE LA VACA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(2, 8, 'CUAJADA', 'La cuajada es un producto lácteo, de textura cremosa, elaborado con leche coagulada por acción del cuajo.', '["ELABORACION CON LA LECHE DE LA VACA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(16, 1, 'MIEL DE ABEJA', 'La miel es un fluido muy dulce y viscoso producido por abejas del género Apis, principalmente la abeja doméstica, a partir del néctar de las flores o de secreciones de partes vivas de plantas o de exc', '["DULCE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(9, 1, 'ELOTE GRANDE', 'El elote, choclo o jojoto es la mazorca fresca del maíz, cuyos granos reservan humedad. Recibe distintos nombres según las zonas geográficas', '["MAIZ","MAZORCA","GRANO"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(9, 2, 'MAIZ', 'Es un alimento muy completo, que contiene muchas vitaminas y minerales que favorecen nuestro metabolismo. Fueron las civilizaciones precolombinas las que establecieron el maíz como uno de los alimento', '["PLANTA","ALIMENTO"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 32, 'PLANTA DE GARZA', 'El espatifilo es un ejemplar que florece de marzo a septiembre y que se adapta sin problemas al cultivo hidropónico, que consiste en cultivar las plantas sin sustrato', '["PLANTA DECORATIVA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 33, 'PLANTA DE GUAYABA', 'Las guayabas son un género de unas cien especies de árboles tropicales y árboles pequeños en la familia Myrtaceae', '["ARBOL","FRUTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 34, 'MANGO', 'Una porción de 3/4 de taza de mango contiene un 50% de su ración diaria de vitamina C, 8% de su ración diaria de vitamina A, y un 8% de la ración diaria de vitamina B6', '["FRUTA","DULCE"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(7, 35, 'PLANTA DE NAPOLEON', 'La bugambilia, también conocida como papelillo, Napoleón o veranera es una planta de la familia de las Nyctaginaceas', '["ARBOL","PLANTA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(7, 36, 'PLANTA DE CAFE', 'Los cafetos son un género que contiene en torno a cien taxones específicos e infraespecíficos aceptados, ​ de los casi 400 descritos de plantas de la familia de las rubiáceas', '["ARBUSTO","Coffea"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(6, 1, 'CHILE VERDE', 'El chile dulce es un vegetal de delicado sabor y de temporada caliente. Las plantas de chiles dulces requieren de temperaturas altas', '["VEGETAL"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(6, 2, 'HABICHUELAS', 'Las habichuelas son una rica fuente de vitamina C, vitamina K , vitamina A (contienen beta-caroteno) y riboflavina (vitamina B2). Tanto la beta-caroteno como la vitamina C contienen propiedades desinf', '["Phaseolus vulgaris"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(6, 3, 'PEPINO', 'Cucumis sativus, conocido popularmente como pepino, es una planta anual de la familia de las cucurbitáceas', '["Cucumis sativus","HORTALIZA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(6, 4, 'PLANTULAS DE CHILE', 'La producción de plántulas de chile en Sinaloa es común entre los productores de hortalizas en la región.', '["PLANTULAS DE CHILE"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(6, 5, 'REPOLLO', 'Brassica oleracea var. capitata, repollo, col repollo​ o col cerrada, es una planta comestible de la familia de las Brasicáceas, y una herbácea bienal, cultivada como anual, cuyas hojas lisas forman u', '["vitamina K","HORTALIZA"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(6, 6, 'SANDIA', 'Citrullus lanatus, comúnmente llamada sandía, acendría, sindria, patilla, es una especie de la familia Cucurbitaceae', '["FRUTA","DULCE"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now()),
(6, 7, 'TOMATE', 'El tomate​ o jitomate (en México)​ es el fruto de la planta Solanum lycopersicum, el cual tiene importancia culinaria y es utilizado como verdu', '["FRUTA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(6, 8, 'YUCA', 'La yuca es un alimento energético, aunque su contenido en proteínas es limitado. Asimismo, también es mínimo el aporte en grasas por lo que puede ser consumido por personas con problemas de sobrepeso.', '["Manihot esculenta"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(5, 6, 'TOMATE', 'El tomate​ o jitomate ​ es el fruto de la planta Solanum lycopersicum, el cual tiene importancia culinaria y es utilizado como verdura.', '["FRUTA"]', '[]', 1, 1, 1, true, '0.00', 0, 0, now()),
(14, 2, 'AGUA EN BOTELLON', 'El agua es una sustancia cuya molécula está compuesta por dos átomos de hidrógeno y uno de oxígeno unidos por un enlace covalente.', '["LIQUIDO","H₂O"]', '[]', 3, 2, 1, true, '0.00', 0, 0, now()),
(10, 1, 'ALCOHOL ETILICO', 'El alcohol etílico también conocido como etanol, alcohol vínico y alcohol de melazas, es un líquido incoloro y volátil de olor agradable, que puede ser obtenido por dos métodos principale', '["C2H5OH","ETANOL"]', '[]', 1, 2, 1, true, '0.00', 0, 0, now());
