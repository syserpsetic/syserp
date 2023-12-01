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
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo I');
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo II');
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo III');
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo IV');
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo V');
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo VI');
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo VII');
    INSERT INTO administracion.via_capitulos(nombre) VALUES ('Capítulo VIII');

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

    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 1','Elpresente reglamento define y establece las normas y procedimientos a aplicar para el otorgamiento de Viáticos y Gastos de viaje',1);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 2','La UNAG reconocerá y pagará viáticos y gastos de viaje a sus funcionarios y empleados ',1);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 3','Toda asignación de viáticos, gastos de viaje y otros sinilares, se cargarán a la asignacion',1);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 4','Cuando se requiere los servios de personas particulares',1);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 5','Los viajes fuera del campus central y las sedes',1);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 6','se prohíve la adquisiciñon con fondos de la UNAG',1);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 7','Se limita en la Universidad Nacional de Agricultura ',1);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 8','Para los efectos de aplicación del presente reglamento,se entiende ',2);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 9','Para los efectos de este Reglamento, los viáticos y gastos',3);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 10','El superior jerárquico que solicite y autorica las misiones oficiales',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 11','Las giras dentro y fuera del país deberán programarse',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 12','Los Viáticos y gastos de Viaje dentro y fuera del país, se hara de conformida con lo que determine',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 13','Las tarifas de viáticos, gastos de viaje y otros gastos aquí estipulados, son las cantidades máximas',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 14','Las horas de salida y regreso que se tomarán para efectuar el cómputo de viáticos',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 15','La asignación diaria para viáticos se contará por cada noche que el servidor público universitario',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 16','Los viáticos y gastos de viaje dentro del país de los servidores públicos universitarios ',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 17','En los Centros Regionales, los viáticos y gastos de viaje deberán planificar conforme la disponibilidad',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 18','Cuando se trate de viajes al exterior , los viáticos y gastos de viaje de los Servidores Publicos Universitarios',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 19','Cuando un Servidor Público Universitario, previa invitación formal, asista o participe en algunas actividad',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 20','  Cuando la invitación incluya el reconocimiento de gastos en concepto de alimentación, se dotará al viajero',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 21','El servidor público universitario a quienes se le asigne un vehículo para efectuar un viaje',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 22','Si un viaje no es realizando, el viajero devolverá el valor asignado de viáticos a la Tesorería de la UNAG',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 23','Se prohíbe a los todos los Servidores Públicos Universitarios, aprobar y autorizar Viáticos',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 24','Los Servidores Públicos Universitarios al incurrir en gastos imprevistos y necesarios durente el viaje',4);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 25','Toda persona que se la haya provisto de anticipo de Viáticos y Gastos de Viaje, que concluya una misión',5);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 26','De no cumplirse con las disposiciones antes señaladas',5);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 27','En el caso que el servidor público universitario no liqude el monto otorgado en el plazo establecido',5);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 28','Para la revisión, aprobación y demás efeectos de la liquidación presentada por el servidor público universitario',5);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 29','Se prohíbe el fraccionamiento de los períodos de las misiones con el propósito de eluadir la correcta aplicación',6);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 30','A ninguna persona se le autorizará un nuevo anticipo de Viáticos y Gastos de viaje, si tuviese pendiente',6);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 31','Bajo ninguna circunstancia deberá asignarse anticipo de Viáticos y Gastos de Viaje para mayor número de días',6);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 32','Todo informe y documentación presentada por los servidores públicos universitarios que hubieren viajado',6);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 33','En ningún caso, los viáticos  y gastos de viaje se utilizarán para reconocer primas, sobresueldos',6);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 34','Todos los organos y dependencias de la UNAG deberán limitar sus viajes al exterior a lo estrictamente necesarios',6);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 35','Ninguno de los gastos comprendidos en este Reglamento padrán autorizarse para financiar becas',6);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 36','Las tarifas de viáticos especificadas en el presente reglamento, son las cantidades máximas que deben reconocerse',7);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 37','Los servidores Públicos de la UNAG que viajan a las diferentes unidades a la misma, deberán acatar',7);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 38','Los viáticos, gastos de viaje y otros, autorizados antes de la vigencia de este reglamento',8);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 39','EL presente Reglamento será revisado y modificado en cualquier momento con el propósito',8);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 40','Lo no consignado en este reglamento de Viáticos y Gastos de viaje, deberá sujetarse supletoriamente',8);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 41','Por este acto, se deroga el Reglamento de Viáticos y Gastos de viaje anterior al presente',8);
    INSERT INTO administracion.via_articulos(nombre,descripcion,id_capitulo) VALUES ('Artículo 42','El presente Reglamento entrará en vigencia después de su publicación en el Diario Oficial',8);


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
	id_firma_jefatura bigint, 
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
        ON DELETE NO ACTION,
	
	CONSTRAINT via_ordenes_viajes_fk_013 FOREIGN KEY (id_firma_jefatura)
        REFERENCES administracion.via_firmas_jefaturas (id) MATCH SIMPLE
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

create table administracion.via_firmas_jefaturas(
	id serial primary key,
	nombre text,
	descripcion text,
	created_at timestamp without time zone default now(),
	updated_at timestamp without time zone,
	deleted_at timestamp without time zone
);

INSERT INTO administracion.via_firmas_jefaturas(nombre, descripcion) VALUES ('RECTOR', 'Jefe de Rectoría');
INSERT INTO administracion.via_firmas_jefaturas(nombre, descripcion) VALUES ('VICERECTOR ACADÉMICO', 'Jefe de Vicerectoría Académica');
INSERT INTO administracion.via_firmas_jefaturas(nombre, descripcion) VALUES ('SECRETARIO GENERAL', 'Jefe de Secretaría General');
INSERT INTO administracion.via_firmas_jefaturas(nombre, descripcion) VALUES ('DECANO', 'Jefe de Decanatura');
INSERT INTO administracion.via_firmas_jefaturas(nombre, descripcion) VALUES ('FIRMA DEL JEFE DE DEPARTAMENTO', 'Jefe de Departamento');

--selecT * from information_schema.tables where table_name like 'via_%'


--selecT * from cities limit 1