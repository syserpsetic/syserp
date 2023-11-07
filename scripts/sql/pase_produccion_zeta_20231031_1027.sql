--selecT * from aux_tipo_moneda


-- DROP TABLE administracion.via_zonas;

CREATE TABLE administracion.via_zonas
(
    id serial,
    nombre text not null,
	descrIpcion text,
    created_at timestamp without time zone DEFAULT now(),
    update_at timestamp without time zone,
    deleted_at timestamp without time zone,
    CONSTRAINT via_zonas_pk PRIMARY KEY (id)
)

WITH (
    OIDS = FALSE
);
GRANT UPDATE, INSERT, SELECT ON TABLE administracion.via_zonas TO erpunag;
GRANT SELECT ON TABLE administracion.via_zonas TO cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON administracion.via_zonas_id_seq TO erpunag, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

Insert into administracion.via_zonas (nombre, descripcion) values 
('ZONA I', 'D.1- VIÁTICOS Y GASTOS DE VIAJE DENTRO DEL PAÍS POR ZONAS. VALORES EN LEMPIRAS'),
('ZONA II', 'D.1- VIÁTICOS Y GASTOS DE VIAJE DENTRO DEL PAÍS POR ZONAS. VALORES EN LEMPIRAS'),
('ZONA ESPECIAL II (ISLAS DE LA BAHÍA Y GRACIAS A DIOS)', 'D.1.2- VIÁTICOS Y GASTOS DE VIAJE DENTRO DEL PAÍS PARA ZONAS ESPECIALES (ISLAS DE LA BAHÍA Y GRACIAS A DIOS). VALORES EN DOLARES AMERICANOS'),
('ZONA I', 'D.2- VIÁTICOS Y GASTOS DE VIAJE DENTRO DEL PAÍS POR ZONAS. VALORES EN DOLARES AMERICANOS'),
('ZONA II', 'D.2- VIÁTICOS Y GASTOS DE VIAJE DENTRO DEL PAÍS POR ZONAS. VALORES EN DOLARES AMERICANOS');

------------------------------------------------------------------------------------------------------------------

-- Table: administracion.via_categorias

-- DROP TABLE administracion.via_categorias;

CREATE TABLE administracion.via_categorias
(
    id serial,
    nombre text not null,
	descrIpcion text,
    created_at timestamp without time zone DEFAULT now(),
    update_at timestamp without time zone,
    deleted_at timestamp without time zone,
    CONSTRAINT via_categorias_pk PRIMARY KEY (id)
)

WITH (
    OIDS = FALSE
);
GRANT UPDATE, INSERT, SELECT ON TABLE administracion.via_categorias TO erpunag;
GRANT SELECT ON TABLE administracion.via_categorias TO cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON administracion.via_categorias_id_seq TO erpunag, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

Insert into administracion.via_categorias (nombre, descripcion) values 
('I', 'CATEGORIA I'),
('II', 'CATEGORIA II'),
('III', 'CATEGORIA III'),
('IV', 'CATEGORIA IV'),
('V', 'CATEGORIA V');

------------------------------------------------------------------------------------------------------------------
-- Table: administracion.via_zonas_categorias

-- DROP TABLE administracion.via_zonas_categorias;

CREATE TABLE administracion.via_zonas_categorias
(
    id serial,
    id_zona integer,
	id_categoria integer,
	id_tipo_moneda integer,
	hospedaje numeric,
	alimentacion numeric,
	gastos_varios numeric,
    created_at timestamp without time zone DEFAULT now(),
    update_at timestamp without time zone,
    deleted_at timestamp without time zone,
    CONSTRAINT via_zonas_categorias_pk PRIMARY KEY (id),
	CONSTRAINT via_zonas_categorias_via_zonas_fkey FOREIGN KEY (id_zona)
        REFERENCES administracion.via_zonas (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_zonas_categorias_via_categorias_fkey FOREIGN KEY (id_categoria)
        REFERENCES administracion.via_categorias (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_zonas_categorias_aux_tipo_moneda_fkey FOREIGN KEY (id_tipo_moneda)
        REFERENCES public.aux_tipo_moneda (id_tipo_moneda) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

WITH (
    OIDS = FALSE
);
GRANT UPDATE, INSERT, SELECT ON TABLE administracion.via_zonas_categorias TO erpunag;
GRANT SELECT ON TABLE administracion.via_zonas_categorias TO cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;
GRANT USAGE ON administracion.via_zonas_categorias_id_seq TO erpunag, cmatute, erpunag, oacosta, cgarcia, gardonf, gdominguez, nsandoval;

Insert into administracion.via_zonas_categorias (id_zona, id_categoria, id_tipo_moneda, hospedaje, alimentacion, gastos_varios) values 
(1,1,1,1100,700,300),
(1,2,1,1000,600,300),
(1,3,1,900,550,300),
(1,4,1,800,500,300),
(1,5,1,700,400,300),
(2,1,1,1000,600,250),
(2,2,1,900,500,250),
(2,3,1,800,450,250),
(2,4,1,700,450,250),
(2,5,1,600,450,250),
(3,1,2,90,80,30),
(3,2,2,80,70,30),
(3,3,2,70,60,30),
(3,4,2,70,60,30),
(3,5,2,70,60,30),
(4,1,2,100,100,50),
(4,2,2,90,80,40),
(4,3,2,80,70,30),
(4,4,2,70,60,30),
(4,5,2,70,50,30),
(5,1,2,150,100,50),
(5,2,2,120,90,50),
(5,3,2,100,80,50),
(5,4,2,90,70,50),
(5,5,2,80,60,50);


create table administracion.via_capitulos(
	id serial primary key,
	nombre text,
	created_at timestamp without time zone default now(),
	updated_at timestamp without time zone,
	deleted_at timestamp without time zone
);
create table administracion.via_articulos(
	id serial primary key,
	nombre text,
	descripcion text,
	id_capitulo integer,
	created_at timestamp without time zone default now(),
	updated_at timestamp without time zone,
	deleted_at timestamp without time zone,
	constraint via_articulos_fk_001 foreign key (id_capitulo) references administracion.via_articulos
);




create table administracion.via_ordenes_viajes (
id serial primary key,
vehiculo_placa text,
vehiculo_tipo text,
fecha_salida timestamp without time zone not null,
fecha_retorno timestamp without time zone not null,
numero_empleado_conductor bigint,
proposito text,
id_institucion bigint,
id_fuente bigint,
    id_gerencia_administrativa bigint,
id_programa bigint,
    id_unidad_ejecutora bigint,
    id_actividad_obra bigint,  
	created_at timestamp without time zone default now(),
	updated_at timestamp without time zone,
	deleted_at timestamp without time zone,
	CONSTRAINT via_ordenes_viajes_fk_004 FOREIGN KEY (numero_empleado_conductor)
        REFERENCES public.tbl_utic_empleados (numero_empleado) MATCH SIMPLE
	 ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_ordenes_viajes_fk_005 FOREIGN KEY (id_fuente)
        REFERENCES administracion.pre_fuentes (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT via_ordenes_viajes_fk_006 FOREIGN KEY (id_gerencia_administrativa)
        REFERENCES administracion.pre_gerencias_administrativas (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    
    CONSTRAINT via_ordenes_viajes_fk_008 FOREIGN KEY (id_institucion)
        REFERENCES administracion.pre_instituciones (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    
    CONSTRAINT via_ordenes_viajes_fk_010 FOREIGN KEY (id_unidad_ejecutora)
        REFERENCES administracion.pre_unidades_ejecutoras (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    
    CONSTRAINT via_ordenes_viajes_fk_012 FOREIGN KEY (id_actividad_obra)
        REFERENCES administracion.pre_actividades_obras (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);


create table administracion.via_itinerarios(
	id serial primary key,
	id_orden_viaje integer,
	id_country integer not null,
	id_region bigint,
	id_city bigint,
	orden integer,
    created_at timestamp without time zone default now(),
	updated_at timestamp without time zone,
	deleted_at timestamp without time zone,
	CONSTRAINT via_itinerarios_fk_001 FOREIGN KEY (id_country)
        REFERENCES public.countries (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT via_itinerarios_fk_002 FOREIGN KEY (id_region)
        REFERENCES public.regions (id) MATCH SIMPLE
	 ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_itinerarios_fk_003 FOREIGN KEY (id_city)
        REFERENCES public.cities (id) MATCH SIMPLE
	 ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_itinerarios_fk_004 FOREIGN KEY (id_orden_viaje)
        REFERENCES administracion.via_ordenes_viajes (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

create table administracion.via_ordenes_viajes_articulos(
	id serial primary key,
	id_orden_viaje integer,
	id_articulo integer,
    created_at timestamp without time zone default now(),
	updated_at timestamp without time zone,
	deleted_at timestamp without time zone,
	CONSTRAINT via_ordenes_viajes_articulos_fk_001 FOREIGN KEY (id_articulo)
        REFERENCES administracion.via_articulos (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_ordenes_viajes_articulos_fk_002 FOREIGN KEY (id_orden_viaje)
        REFERENCES administracion.via_ordenes_viajes (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);


create table administracion.via_ordenes_viajes_empleados(
	id serial primary key,
	id_orden_viaje integer,
	numero_empleado integer,
    id_cargo integer,
    id_departamento integer,
	created_at timestamp without time zone default now(),
	updated_at timestamp without time zone,
	deleted_at timestamp without time zone,

	CONSTRAINT via_ordenes_viajes_empleados_fk_001 FOREIGN KEY (id_orden_viaje)
        REFERENCES administracion.via_ordenes_viajes (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_ordenes_viajes_empleados_fk_002 FOREIGN KEY (numero_empleado)
        REFERENCES public.tbl_utic_empleados (numero_empleado) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,    CONSTRAINT via_ordenes_viajes_fk_002 FOREIGN KEY (id_departamento)
    REFERENCES public.tbl_utic_departamentos (id_departamento) MATCH SIMPLE
	 ON UPDATE NO ACTION
        ON DELETE NO ACTION,
	CONSTRAINT via_ordenes_viajes_fk_003 FOREIGN KEY (id_cargo)
        REFERENCES public.per_cargo (id_cargo) MATCH SIMPLE
	 ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

--selecT * from information_schema.tables where table_name like 'via_%'


--selecT * from cities limit 1