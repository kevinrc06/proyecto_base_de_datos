toc.dat                                                                                             0000600 0004000 0002000 00000062177 14342520405 0014453 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP                           z            tienda_2    14.2    14.2 M    ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false         ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false         ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false         ?           1262    33385    tienda_2    DATABASE     g   CREATE DATABASE tienda_2 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Colombia.1252';
    DROP DATABASE tienda_2;
                postgres    false                     2615    33821    tienda    SCHEMA        CREATE SCHEMA tienda;
    DROP SCHEMA tienda;
                postgres    false         ?           0    0    SCHEMA tienda    ACL     1   GRANT USAGE ON SCHEMA tienda TO usuarios_tienda;
                   postgres    false    4         ?            1255    34427    audi_producto_func()    FUNCTION     j  CREATE FUNCTION tienda.audi_producto_func() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
declare 
	BEGIN 
IF 	(TG_OP = 'UPDATE') THEN
	INSERT INTO tienda.audi_producto (consecutivo, id_producto, nombre_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_producto,OLD.nombre_producto,current_timestamp(0),current_user,'U');
	RETURN NEW;
ELSEIF (TG_OP = 'DELETE')THEN
	INSERT INTO tienda.audi_producto(consecutivo, id_producto, nombre_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_producto,OLD.nombre_producto,current_timestamp(0),current_user,'D');
	RETURN OLD;
END IF;

END;

$$;
 +   DROP FUNCTION tienda.audi_producto_func();
       tienda          postgres    false    4         ?            1255    42027    audi_suministro_func()    FUNCTION     ?  CREATE FUNCTION tienda.audi_suministro_func() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
declare 
	BEGIN 
IF 	(TG_OP = 'UPDATE') THEN
	INSERT INTO tienda.audi_suministro (consecutivo, id_suministro, cantidad_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_suministro,OLD.cantidad_producto,current_timestamp(0),current_user,'U');
	RETURN NEW;
ELSEIF (TG_OP = 'DELETE')THEN
	INSERT INTO tienda.audi_suministro(consecutivo, id_suministro, cantidad_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_suministro,OLD.cantidad_producto,current_timestamp(0),current_user,'D');
	RETURN OLD;
END IF;

END;

$$;
 -   DROP FUNCTION tienda.audi_suministro_func();
       tienda          postgres    false    4         ?            1259    34421    audi_producto    TABLE       CREATE TABLE tienda.audi_producto (
    consecutivo integer NOT NULL,
    id_producto character varying(2),
    nombre_producto character varying(30) NOT NULL,
    fecha_registro timestamp without time zone,
    usuario character varying(20),
    accion character(1)
);
 !   DROP TABLE tienda.audi_producto;
       tienda         heap    postgres    false    4         ?            1259    34420    audi_producto_consecutivo_seq    SEQUENCE     ?   CREATE SEQUENCE tienda.audi_producto_consecutivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE tienda.audi_producto_consecutivo_seq;
       tienda          postgres    false    4    240         ?           0    0    audi_producto_consecutivo_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE tienda.audi_producto_consecutivo_seq OWNED BY tienda.audi_producto.consecutivo;
          tienda          postgres    false    239         ?            1259    42021    audi_suministro    TABLE       CREATE TABLE tienda.audi_suministro (
    consecutivo integer NOT NULL,
    id_suministro character varying(2),
    cantidad_producto integer NOT NULL,
    fecha_registro timestamp without time zone,
    usuario character varying(20),
    accion character(1)
);
 #   DROP TABLE tienda.audi_suministro;
       tienda         heap    postgres    false    4         ?            1259    42020    audi_suministro_consecutivo_seq    SEQUENCE     ?   CREATE SEQUENCE tienda.audi_suministro_consecutivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE tienda.audi_suministro_consecutivo_seq;
       tienda          postgres    false    4    244         ?           0    0    audi_suministro_consecutivo_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE tienda.audi_suministro_consecutivo_seq OWNED BY tienda.audi_suministro.consecutivo;
          tienda          postgres    false    243         ?            1259    34343 	   categoria    TABLE     ?   CREATE TABLE tienda.categoria (
    id_categoria character varying(2) NOT NULL,
    nombre_categoria character varying(30),
    CONSTRAINT nn_nombre CHECK ((nombre_categoria IS NOT NULL))
);
    DROP TABLE tienda.categoria;
       tienda         heap    postgres    false    4         ?            1259    34386    detalle_entrada    TABLE       CREATE TABLE tienda.detalle_entrada (
    ordinal_entrada character varying(2) NOT NULL,
    id_producto character varying(2),
    cantidad integer,
    precio integer,
    consecutivo_entrada integer NOT NULL,
    CONSTRAINT ck_cantidad CHECK ((cantidad IS NOT NULL))
);
 #   DROP TABLE tienda.detalle_entrada;
       tienda         heap    postgres    false    4         ?            1259    34402    detalle_salida    TABLE       CREATE TABLE tienda.detalle_salida (
    ordinal_salida character varying(2) NOT NULL,
    id_producto character varying(2),
    cantidad integer,
    precio integer,
    consecutivo_salida integer NOT NULL,
    CONSTRAINT ck_cantidad CHECK ((cantidad IS NOT NULL))
);
 "   DROP TABLE tienda.detalle_salida;
       tienda         heap    postgres    false    4         ?            1259    34268    entrada    TABLE     ?   CREATE TABLE tienda.entrada (
    consecutivo_entrada integer NOT NULL,
    id_usuario character varying(2),
    fecha_entrada date,
    CONSTRAINT nn_fecha_entrada CHECK ((fecha_entrada IS NOT NULL))
);
    DROP TABLE tienda.entrada;
       tienda         heap    postgres    false    4         ?           0    0    TABLE entrada    ACL     9   GRANT SELECT ON TABLE tienda.entrada TO usuarios_tienda;
          tienda          postgres    false    231         ?            1259    34267    entrada_consecutivo_entrada_seq    SEQUENCE     ?   CREATE SEQUENCE tienda.entrada_consecutivo_entrada_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE tienda.entrada_consecutivo_entrada_seq;
       tienda          postgres    false    231    4         ?           0    0    entrada_consecutivo_entrada_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE tienda.entrada_consecutivo_entrada_seq OWNED BY tienda.entrada.consecutivo_entrada;
          tienda          postgres    false    230         ?            1259    34335    marca    TABLE     ?   CREATE TABLE tienda.marca (
    id_marca character varying(2) NOT NULL,
    nombre_marca character varying(30),
    CONSTRAINT nn_nombre CHECK ((nombre_marca IS NOT NULL))
);
    DROP TABLE tienda.marca;
       tienda         heap    postgres    false    4         ?            1259    34351    producto    TABLE     ?  CREATE TABLE tienda.producto (
    id_producto character varying(2) NOT NULL,
    id_marca character varying(2),
    id_categoria character varying(2),
    nombre_producto character varying(30),
    stock integer,
    precio_unitario integer,
    descripcion_producto character varying(100),
    CONSTRAINT ck_precio_unitario CHECK ((precio_unitario > 0)),
    CONSTRAINT nn_nombre CHECK ((nombre_producto IS NOT NULL))
);
    DROP TABLE tienda.producto;
       tienda         heap    postgres    false    4         ?            1259    34437 	   proveedor    TABLE     M  CREATE TABLE tienda.proveedor (
    id_proveedor character varying(2) NOT NULL,
    nombre_proveedor character varying(30),
    direccion character varying(50),
    telefono character varying(20),
    CONSTRAINT nn_nombre_proveedor CHECK ((nombre_proveedor IS NOT NULL)),
    CONSTRAINT nn_telefono CHECK ((telefono IS NOT NULL))
);
    DROP TABLE tienda.proveedor;
       tienda         heap    postgres    false    4         ?            1259    34297    salida    TABLE     ?   CREATE TABLE tienda.salida (
    consecutivo_salida integer NOT NULL,
    id_usuario character varying(2),
    fecha_salida date,
    CONSTRAINT nn_fecha_salida CHECK ((fecha_salida IS NOT NULL))
);
    DROP TABLE tienda.salida;
       tienda         heap    postgres    false    4         ?            1259    34296    salida_consecutivo_salida_seq    SEQUENCE     ?   CREATE SEQUENCE tienda.salida_consecutivo_salida_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE tienda.salida_consecutivo_salida_seq;
       tienda          postgres    false    233    4         ?           0    0    salida_consecutivo_salida_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE tienda.salida_consecutivo_salida_seq OWNED BY tienda.salida.consecutivo_salida;
          tienda          postgres    false    232         ?            1259    34497 
   suministro    TABLE       CREATE TABLE tienda.suministro (
    id_suministro character varying(2) NOT NULL,
    id_producto character varying(2),
    id_proveedor character varying(2),
    cantidad_producto integer,
    fecha date,
    CONSTRAINT nn_fecha CHECK ((fecha IS NOT NULL))
);
    DROP TABLE tienda.suministro;
       tienda         heap    postgres    false    4         ?            1259    34160    usuario    TABLE       CREATE TABLE tienda.usuario (
    id_usuario character varying(2) NOT NULL,
    usuario character varying(30),
    contrasena character varying(30),
    CONSTRAINT nn_contrasena CHECK ((contrasena IS NOT NULL)),
    CONSTRAINT nn_usuario CHECK ((usuario IS NOT NULL))
);
    DROP TABLE tienda.usuario;
       tienda         heap    postgres    false    4         ?           2604    34424    audi_producto consecutivo    DEFAULT     ?   ALTER TABLE ONLY tienda.audi_producto ALTER COLUMN consecutivo SET DEFAULT nextval('tienda.audi_producto_consecutivo_seq'::regclass);
 H   ALTER TABLE tienda.audi_producto ALTER COLUMN consecutivo DROP DEFAULT;
       tienda          postgres    false    240    239    240         ?           2604    42024    audi_suministro consecutivo    DEFAULT     ?   ALTER TABLE ONLY tienda.audi_suministro ALTER COLUMN consecutivo SET DEFAULT nextval('tienda.audi_suministro_consecutivo_seq'::regclass);
 J   ALTER TABLE tienda.audi_suministro ALTER COLUMN consecutivo DROP DEFAULT;
       tienda          postgres    false    244    243    244         ?           2604    34271    entrada consecutivo_entrada    DEFAULT     ?   ALTER TABLE ONLY tienda.entrada ALTER COLUMN consecutivo_entrada SET DEFAULT nextval('tienda.entrada_consecutivo_entrada_seq'::regclass);
 J   ALTER TABLE tienda.entrada ALTER COLUMN consecutivo_entrada DROP DEFAULT;
       tienda          postgres    false    230    231    231         ?           2604    34300    salida consecutivo_salida    DEFAULT     ?   ALTER TABLE ONLY tienda.salida ALTER COLUMN consecutivo_salida SET DEFAULT nextval('tienda.salida_consecutivo_salida_seq'::regclass);
 H   ALTER TABLE tienda.salida ALTER COLUMN consecutivo_salida DROP DEFAULT;
       tienda          postgres    false    232    233    233         ?          0    34421    audi_producto 
   TABLE DATA           s   COPY tienda.audi_producto (consecutivo, id_producto, nombre_producto, fecha_registro, usuario, accion) FROM stdin;
    tienda          postgres    false    240       3473.dat ?          0    42021    audi_suministro 
   TABLE DATA           y   COPY tienda.audi_suministro (consecutivo, id_suministro, cantidad_producto, fecha_registro, usuario, accion) FROM stdin;
    tienda          postgres    false    244       3477.dat ?          0    34343 	   categoria 
   TABLE DATA           C   COPY tienda.categoria (id_categoria, nombre_categoria) FROM stdin;
    tienda          postgres    false    235       3468.dat ?          0    34386    detalle_entrada 
   TABLE DATA           n   COPY tienda.detalle_entrada (ordinal_entrada, id_producto, cantidad, precio, consecutivo_entrada) FROM stdin;
    tienda          postgres    false    237       3470.dat ?          0    34402    detalle_salida 
   TABLE DATA           k   COPY tienda.detalle_salida (ordinal_salida, id_producto, cantidad, precio, consecutivo_salida) FROM stdin;
    tienda          postgres    false    238       3471.dat ?          0    34268    entrada 
   TABLE DATA           Q   COPY tienda.entrada (consecutivo_entrada, id_usuario, fecha_entrada) FROM stdin;
    tienda          postgres    false    231       3464.dat ?          0    34335    marca 
   TABLE DATA           7   COPY tienda.marca (id_marca, nombre_marca) FROM stdin;
    tienda          postgres    false    234       3467.dat ?          0    34351    producto 
   TABLE DATA           ?   COPY tienda.producto (id_producto, id_marca, id_categoria, nombre_producto, stock, precio_unitario, descripcion_producto) FROM stdin;
    tienda          postgres    false    236       3469.dat ?          0    34437 	   proveedor 
   TABLE DATA           X   COPY tienda.proveedor (id_proveedor, nombre_proveedor, direccion, telefono) FROM stdin;
    tienda          postgres    false    241       3474.dat ?          0    34297    salida 
   TABLE DATA           N   COPY tienda.salida (consecutivo_salida, id_usuario, fecha_salida) FROM stdin;
    tienda          postgres    false    233       3466.dat ?          0    34497 
   suministro 
   TABLE DATA           h   COPY tienda.suministro (id_suministro, id_producto, id_proveedor, cantidad_producto, fecha) FROM stdin;
    tienda          postgres    false    242       3475.dat ?          0    34160    usuario 
   TABLE DATA           B   COPY tienda.usuario (id_usuario, usuario, contrasena) FROM stdin;
    tienda          postgres    false    229       3462.dat ?           0    0    audi_producto_consecutivo_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('tienda.audi_producto_consecutivo_seq', 65, true);
          tienda          postgres    false    239         ?           0    0    audi_suministro_consecutivo_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('tienda.audi_suministro_consecutivo_seq', 34, true);
          tienda          postgres    false    243         ?           0    0    entrada_consecutivo_entrada_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('tienda.entrada_consecutivo_entrada_seq', 54, true);
          tienda          postgres    false    230         ?           0    0    salida_consecutivo_salida_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('tienda.salida_consecutivo_salida_seq', 44, true);
          tienda          postgres    false    232         ?           2606    34426    audi_producto pk_audi_producto 
   CONSTRAINT     e   ALTER TABLE ONLY tienda.audi_producto
    ADD CONSTRAINT pk_audi_producto PRIMARY KEY (consecutivo);
 H   ALTER TABLE ONLY tienda.audi_producto DROP CONSTRAINT pk_audi_producto;
       tienda            postgres    false    240         ?           2606    42026 "   audi_suministro pk_audi_suministro 
   CONSTRAINT     i   ALTER TABLE ONLY tienda.audi_suministro
    ADD CONSTRAINT pk_audi_suministro PRIMARY KEY (consecutivo);
 L   ALTER TABLE ONLY tienda.audi_suministro DROP CONSTRAINT pk_audi_suministro;
       tienda            postgres    false    244         ?           2606    34348    categoria pk_categoria 
   CONSTRAINT     ^   ALTER TABLE ONLY tienda.categoria
    ADD CONSTRAINT pk_categoria PRIMARY KEY (id_categoria);
 @   ALTER TABLE ONLY tienda.categoria DROP CONSTRAINT pk_categoria;
       tienda            postgres    false    235         ?           2606    34391 "   detalle_entrada pk_detalle_entrada 
   CONSTRAINT     ?   ALTER TABLE ONLY tienda.detalle_entrada
    ADD CONSTRAINT pk_detalle_entrada PRIMARY KEY (ordinal_entrada, consecutivo_entrada);
 L   ALTER TABLE ONLY tienda.detalle_entrada DROP CONSTRAINT pk_detalle_entrada;
       tienda            postgres    false    237    237         ?           2606    34407     detalle_salida pk_detalle_salida 
   CONSTRAINT     ~   ALTER TABLE ONLY tienda.detalle_salida
    ADD CONSTRAINT pk_detalle_salida PRIMARY KEY (ordinal_salida, consecutivo_salida);
 J   ALTER TABLE ONLY tienda.detalle_salida DROP CONSTRAINT pk_detalle_salida;
       tienda            postgres    false    238    238         ?           2606    34274    entrada pk_entrada 
   CONSTRAINT     a   ALTER TABLE ONLY tienda.entrada
    ADD CONSTRAINT pk_entrada PRIMARY KEY (consecutivo_entrada);
 <   ALTER TABLE ONLY tienda.entrada DROP CONSTRAINT pk_entrada;
       tienda            postgres    false    231         ?           2606    34340    marca pk_marca 
   CONSTRAINT     R   ALTER TABLE ONLY tienda.marca
    ADD CONSTRAINT pk_marca PRIMARY KEY (id_marca);
 8   ALTER TABLE ONLY tienda.marca DROP CONSTRAINT pk_marca;
       tienda            postgres    false    234         ?           2606    34357    producto pk_producto 
   CONSTRAINT     [   ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT pk_producto PRIMARY KEY (id_producto);
 >   ALTER TABLE ONLY tienda.producto DROP CONSTRAINT pk_producto;
       tienda            postgres    false    236         ?           2606    34443    proveedor pk_proveedor 
   CONSTRAINT     ^   ALTER TABLE ONLY tienda.proveedor
    ADD CONSTRAINT pk_proveedor PRIMARY KEY (id_proveedor);
 @   ALTER TABLE ONLY tienda.proveedor DROP CONSTRAINT pk_proveedor;
       tienda            postgres    false    241         ?           2606    34303    salida pk_salida 
   CONSTRAINT     ^   ALTER TABLE ONLY tienda.salida
    ADD CONSTRAINT pk_salida PRIMARY KEY (consecutivo_salida);
 :   ALTER TABLE ONLY tienda.salida DROP CONSTRAINT pk_salida;
       tienda            postgres    false    233         ?           2606    34502    suministro pk_suministro 
   CONSTRAINT     a   ALTER TABLE ONLY tienda.suministro
    ADD CONSTRAINT pk_suministro PRIMARY KEY (id_suministro);
 B   ALTER TABLE ONLY tienda.suministro DROP CONSTRAINT pk_suministro;
       tienda            postgres    false    242         ?           2606    34166    usuario pk_usuario 
   CONSTRAINT     X   ALTER TABLE ONLY tienda.usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id_usuario);
 <   ALTER TABLE ONLY tienda.usuario DROP CONSTRAINT pk_usuario;
       tienda            postgres    false    229         ?           2606    34342    marca uc_nombre 
   CONSTRAINT     R   ALTER TABLE ONLY tienda.marca
    ADD CONSTRAINT uc_nombre UNIQUE (nombre_marca);
 9   ALTER TABLE ONLY tienda.marca DROP CONSTRAINT uc_nombre;
       tienda            postgres    false    234         ?           2606    34350    categoria uc_nombre_categoria 
   CONSTRAINT     d   ALTER TABLE ONLY tienda.categoria
    ADD CONSTRAINT uc_nombre_categoria UNIQUE (nombre_categoria);
 G   ALTER TABLE ONLY tienda.categoria DROP CONSTRAINT uc_nombre_categoria;
       tienda            postgres    false    235         ?           2606    34359    producto uc_producto 
   CONSTRAINT     Z   ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT uc_producto UNIQUE (nombre_producto);
 >   ALTER TABLE ONLY tienda.producto DROP CONSTRAINT uc_producto;
       tienda            postgres    false    236         ?           2606    34168    usuario uc_usuario 
   CONSTRAINT     P   ALTER TABLE ONLY tienda.usuario
    ADD CONSTRAINT uc_usuario UNIQUE (usuario);
 <   ALTER TABLE ONLY tienda.usuario DROP CONSTRAINT uc_usuario;
       tienda            postgres    false    229         ?           2620    34428 !   producto trg_grabar_audi_producto    TRIGGER     ?   CREATE TRIGGER trg_grabar_audi_producto BEFORE DELETE OR UPDATE ON tienda.producto FOR EACH ROW EXECUTE FUNCTION tienda.audi_producto_func();
 :   DROP TRIGGER trg_grabar_audi_producto ON tienda.producto;
       tienda          postgres    false    236    246         ?           2620    42028 %   suministro trg_grabar_audi_suministro    TRIGGER     ?   CREATE TRIGGER trg_grabar_audi_suministro BEFORE DELETE OR UPDATE ON tienda.suministro FOR EACH ROW EXECUTE FUNCTION tienda.audi_suministro_func();
 >   DROP TRIGGER trg_grabar_audi_suministro ON tienda.suministro;
       tienda          postgres    false    242    247         ?           2606    34365    producto fk_categoria_producto    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT fk_categoria_producto FOREIGN KEY (id_categoria) REFERENCES tienda.categoria(id_categoria);
 H   ALTER TABLE ONLY tienda.producto DROP CONSTRAINT fk_categoria_producto;
       tienda          postgres    false    236    3292    235         ?           2606    34392 "   detalle_entrada fk_entrada_detalle    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.detalle_entrada
    ADD CONSTRAINT fk_entrada_detalle FOREIGN KEY (consecutivo_entrada) REFERENCES tienda.entrada(consecutivo_entrada);
 L   ALTER TABLE ONLY tienda.detalle_entrada DROP CONSTRAINT fk_entrada_detalle;
       tienda          postgres    false    3284    231    237         ?           2606    34360    producto fk_marca_producto    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT fk_marca_producto FOREIGN KEY (id_marca) REFERENCES tienda.marca(id_marca);
 D   ALTER TABLE ONLY tienda.producto DROP CONSTRAINT fk_marca_producto;
       tienda          postgres    false    3288    236    234         ?           2606    34397 #   detalle_entrada fk_producto_detalle    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.detalle_entrada
    ADD CONSTRAINT fk_producto_detalle FOREIGN KEY (id_producto) REFERENCES tienda.producto(id_producto);
 M   ALTER TABLE ONLY tienda.detalle_entrada DROP CONSTRAINT fk_producto_detalle;
       tienda          postgres    false    236    3296    237         ?           2606    34413 "   detalle_salida fk_producto_detalle    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.detalle_salida
    ADD CONSTRAINT fk_producto_detalle FOREIGN KEY (id_producto) REFERENCES tienda.producto(id_producto);
 L   ALTER TABLE ONLY tienda.detalle_salida DROP CONSTRAINT fk_producto_detalle;
       tienda          postgres    false    236    238    3296         ?           2606    34503 !   suministro fk_producto_suministro    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.suministro
    ADD CONSTRAINT fk_producto_suministro FOREIGN KEY (id_producto) REFERENCES tienda.producto(id_producto);
 K   ALTER TABLE ONLY tienda.suministro DROP CONSTRAINT fk_producto_suministro;
       tienda          postgres    false    242    236    3296         ?           2606    34508 "   suministro fk_proveedor_suministro    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.suministro
    ADD CONSTRAINT fk_proveedor_suministro FOREIGN KEY (id_proveedor) REFERENCES tienda.proveedor(id_proveedor);
 L   ALTER TABLE ONLY tienda.suministro DROP CONSTRAINT fk_proveedor_suministro;
       tienda          postgres    false    242    3306    241         ?           2606    34408     detalle_salida fk_salida_detalle    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.detalle_salida
    ADD CONSTRAINT fk_salida_detalle FOREIGN KEY (consecutivo_salida) REFERENCES tienda.salida(consecutivo_salida);
 J   ALTER TABLE ONLY tienda.detalle_salida DROP CONSTRAINT fk_salida_detalle;
       tienda          postgres    false    3286    233    238         ?           2606    34275    entrada fk_usuario_entrada    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.entrada
    ADD CONSTRAINT fk_usuario_entrada FOREIGN KEY (id_usuario) REFERENCES tienda.usuario(id_usuario);
 D   ALTER TABLE ONLY tienda.entrada DROP CONSTRAINT fk_usuario_entrada;
       tienda          postgres    false    231    229    3280         ?           2606    34304    salida fk_usuario_salida    FK CONSTRAINT     ?   ALTER TABLE ONLY tienda.salida
    ADD CONSTRAINT fk_usuario_salida FOREIGN KEY (id_usuario) REFERENCES tienda.usuario(id_usuario);
 B   ALTER TABLE ONLY tienda.salida DROP CONSTRAINT fk_usuario_salida;
       tienda          postgres    false    3280    229    233                                                                                                                                                                                                                                                                                                                                                                                                         3473.dat                                                                                            0000600 0004000 0002000 00000000005 14342520405 0014244 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           3477.dat                                                                                            0000600 0004000 0002000 00000000005 14342520405 0014250 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           3468.dat                                                                                            0000600 0004000 0002000 00000000203 14342520405 0014250 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	MAS VENDIDOS
2	SMARPHONE
3	CLASICOS
4	GAMA ALTA
5	GAMA MEDIA
6	BAJO COSTO
7	GAMA BAJA
8	MEJOR CAMARA
9	ALMACENAMIENTO
10	5G
\.


                                                                                                                                                                                                                                                                                                                                                                                             3470.dat                                                                                            0000600 0004000 0002000 00000000562 14342520405 0014251 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	1	3	300000	35
2	2	5	2000000	35
3	3	7	800000	37
4	4	8	5000000	38
5	5	10	800000	39
6	6	11	300000	39
7	7	12	290000	40
8	8	13	4500000	41
9	9	14	2800000	42
10	10	15	2900000	43
11	11	16	80000	44
12	12	17	250000	45
13	13	18	150000	42
14	14	19	650000	46
15	15	19	1800000	47
16	16	19	200000	48
17	17	19	450000	48
18	18	16	5500000	49
19	19	17	800000	50
20	20	16	1300000	51
\.


                                                                                                                                              3471.dat                                                                                            0000600 0004000 0002000 00000000562 14342520405 0014252 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	1	3	300000	25
2	2	5	2000000	26
3	3	7	800000	27
4	4	8	5000000	25
5	5	10	800000	26
6	6	11	300000	26
7	7	12	290000	27
8	8	13	4500000	27
9	9	14	2800000	28
10	10	15	2900000	30
11	11	16	80000	31
12	12	17	250000	32
13	13	18	150000	32
14	14	19	650000	33
15	15	19	1800000	34
16	16	19	200000	34
17	17	19	450000	38
18	18	16	5500000	39
19	19	17	800000	33
20	20	16	1300000	37
\.


                                                                                                                                              3464.dat                                                                                            0000600 0004000 0002000 00000000520 14342520405 0014246 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        35	1	2022-11-05
36	2	2020-12-05
37	3	2020-11-05
38	4	2022-11-06
39	5	2022-11-07
40	6	2022-11-08
41	7	2022-11-09
42	8	2022-11-10
43	9	2022-11-11
44	10	2022-11-12
45	11	2022-11-01
46	12	2022-11-02
47	13	2022-11-03
48	14	2022-11-04
49	15	2022-10-05
50	16	2022-09-05
51	17	2022-08-05
52	18	2022-07-05
53	19	2022-06-05
54	20	2022-07-05
\.


                                                                                                                                                                                3467.dat                                                                                            0000600 0004000 0002000 00000000714 14342520405 0014256 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	OPPO
2	REALME
3	XIAOMI
4	SAMSUNG
5	NOKIA
6	MOTOROLA
7	TECNO
8	APPLE
9	HONOR
10	ONEPLUS
11	CAT
12	LG
13	SONY
14	PIXEL
15	HTC
16	AZUMI
17	ALCATEL
18	ASUS
19	AVVIO
20	BLU
21	BLACKBERRY
22	CUBOT
23	DELL
24	DOOGGE
25	ERICSSON
26	ENERGIZER
27	GOOGLE
28	GIGABYTE
29	HUAWEI
30	HYUNDAY
31	HEXXA
32	HP
33	IPRO
34	INFINIX
35	JUMPER
36	KINGO
37	KURIO
38	LINX
39	LAVA
40	MEIZU
41	NOTHIN
42	POMP
43	QUBO
44	RAZER PHONE
45	TOSHIBA
46	TCL
47	UMI
48	VIVO
49	XIDO
50	ZTE
\.


                                                    3469.dat                                                                                            0000600 0004000 0002000 00000002162 14342520405 0014257 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	1	1	OPPO A15	10	300000	Dual SIM 32 GB mystery blue 3 GB RAM
2	2	2	REALME 6	10	2000000	Dual Sim 128 Gb Blanco Cometa 8 Gb Ram + 90hz + 30w
3	3	2	REDMI NOTE 11	20	800000	Dual SIM 128 GB gris grafito 6 GB RAM
4	4	4	S22 ULTRA	15	5000000	Dual SIM 256 GB phantom black 12 GB RAM
5	5	5	NOKIA G21	10	800000	Dual SIM 64 GB azul 3 GB RAM
6	6	6	MOTO E6 PLAY	10	300000	4G 32GB 2GB RAM
7	7	7	TECNO POP 5	10	290000	32GB-2GB RAM
8	8	8	IPHONE 14	5	4500000	128GB-6GB RAM
9	9	9	HONOR 50	10	2800000	256GB COLOR VERDE 5G
10	10	10	ONEPLUS 9	10	2900000	Dual SIM 256 GB astral black 12 GB RAM
11	20	1	BLU Z4	20	80000	2g Dual Sim Camara Radio Linterna Microsd
12	50	2	A3 LITE	10	250000	 Dual SIM 32 GB azul 1 GB RAM
13	23	3	Dell Streak Pro D43	5	150000	CAMARA 8MP 3G 8GB ROM 1 RAM
14	22	4	CUBOT MAX 3	5	650000	64GB ROM 4GB RAM NEGRO
15	24	5	S97 PRO	5	1800000	DUAL SIM 128GB 8GB RAM
16	25	6	W395	2	200000	3G DUAL SIM COLOR NEGRO
17	3	7	redmi 9a	10	450000	32gb 2gb ram Color Azul
18	27	8	google pixel 7pro	5	5500000	12 GB RAM 128GB ROM NEGRO
19	29	9	HUAWEI Y9A	10	800000	6GB RAM 128GB ROM NEGRO
20	29	10	NOVA 9 SE	10	1300000	6GB RAM 128GB ROM 108MPX CAMARA
\.


                                                                                                                                                                                                                                                                                                                                                                                                              3474.dat                                                                                            0000600 0004000 0002000 00000001263 14342520405 0014254 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	ADMIN	barrio el prado	3153268498
2	JOSE	barrio los olivos	3203863008
3	ANDRES	barrio juan 23	3203863013
4	PEDRO	barrio jardin	3203863014
5	ANA	barrio las cumbres	3128392781
6	LUIS	barrio el trebol	3132564754
7	LUCAS	barrio lucerna	3120109571
8	CAMILO	barrio fusa	3187439283
9	ERIC	comuna 3	3128392781
10	EVA	barrio soledad	6032020201
11	JUAN	barrio el retiro	3201654892
12	LEO	barrio juan 2	3235891426
13	LUZ	barrio el carbon	3204584452
14	MARIA	barrio el peñol	3204578415
15	FABIAN	barrio el retiro	3017253867
16	KAREN	barrio tejerito	3102589548
17	KEVIN	villacarolina	3142597982
18	DAVID	barrio galan	3013283887
19	LIZ	barrio galan 2	3165412153
20	LUCI	barrio el tintal	3182231674
\.


                                                                                                                                                                                                                                                                                                                                             3466.dat                                                                                            0000600 0004000 0002000 00000000520 14342520405 0014250 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        25	1	2022-11-05
26	2	2020-12-05
27	3	2020-11-05
28	4	2022-11-06
29	5	2022-11-07
30	6	2022-11-08
31	7	2022-11-09
32	8	2022-11-10
33	9	2022-11-11
34	10	2022-11-12
35	11	2022-11-01
36	12	2022-11-02
37	13	2022-11-03
38	14	2022-11-04
39	15	2022-10-05
40	16	2022-09-05
41	17	2022-08-05
42	18	2022-07-05
43	19	2022-06-05
44	20	2022-07-05
\.


                                                                                                                                                                                3475.dat                                                                                            0000600 0004000 0002000 00000000666 14342520405 0014263 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	1	1	20	2022-12-02
2	2	2	21	2022-12-02
3	3	3	22	2022-12-02
4	4	4	23	2022-12-02
5	5	5	24	2022-12-02
6	6	6	25	2022-12-02
7	7	7	26	2022-12-02
8	8	8	27	2022-12-02
9	9	9	28	2022-12-02
10	10	10	29	2022-12-02
11	11	11	30	2022-12-02
12	12	12	31	2022-12-02
13	13	13	32	2022-12-02
14	14	14	33	2022-12-02
15	15	15	34	2022-12-02
16	16	16	35	2022-12-02
17	17	17	36	2022-12-02
18	18	18	37	2022-12-02
19	19	19	38	2022-12-02
20	20	20	39	2022-12-02
\.


                                                                          3462.dat                                                                                            0000600 0004000 0002000 00000000514 14342520405 0014247 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	ADMIN	ADMIN123
2	JOSE	JOSE123
3	ANDRES	ANDRES123
4	PEDRO	PEDRO123
5	ANA	ANA123
6	LUIS	LUIS123
7	LUCAS	LUCAS123
8	CAMILO	CAMILO123
9	ERIC	ERIC123
10	EVA	EVA123
11	JUAN	JUAN123
12	LEO	LEO123
13	LUZ	LUZ123
14	MARIA	MARIA123
15	FABIAN	FABIAN123
16	KAREN	KAREN123
17	KEVIN	KEVIN123
18	DAVID	DAVID123
19	LIZ	LIZ123
20	LUCI	LUCI123
\.


                                                                                                                                                                                    restore.sql                                                                                         0000600 0004000 0002000 00000051206 14342520405 0015367 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE tienda_2;
--
-- Name: tienda_2; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE tienda_2 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Colombia.1252';


ALTER DATABASE tienda_2 OWNER TO postgres;

\connect tienda_2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: tienda; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA tienda;


ALTER SCHEMA tienda OWNER TO postgres;

--
-- Name: audi_producto_func(); Type: FUNCTION; Schema: tienda; Owner: postgres
--

CREATE FUNCTION tienda.audi_producto_func() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
declare 
	BEGIN 
IF 	(TG_OP = 'UPDATE') THEN
	INSERT INTO tienda.audi_producto (consecutivo, id_producto, nombre_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_producto,OLD.nombre_producto,current_timestamp(0),current_user,'U');
	RETURN NEW;
ELSEIF (TG_OP = 'DELETE')THEN
	INSERT INTO tienda.audi_producto(consecutivo, id_producto, nombre_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_producto,OLD.nombre_producto,current_timestamp(0),current_user,'D');
	RETURN OLD;
END IF;

END;

$$;


ALTER FUNCTION tienda.audi_producto_func() OWNER TO postgres;

--
-- Name: audi_suministro_func(); Type: FUNCTION; Schema: tienda; Owner: postgres
--

CREATE FUNCTION tienda.audi_suministro_func() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
declare 
	BEGIN 
IF 	(TG_OP = 'UPDATE') THEN
	INSERT INTO tienda.audi_suministro (consecutivo, id_suministro, cantidad_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_suministro,OLD.cantidad_producto,current_timestamp(0),current_user,'U');
	RETURN NEW;
ELSEIF (TG_OP = 'DELETE')THEN
	INSERT INTO tienda.audi_suministro(consecutivo, id_suministro, cantidad_producto, fecha_registro, usuario, accion)
	VALUES (default,OLD.id_suministro,OLD.cantidad_producto,current_timestamp(0),current_user,'D');
	RETURN OLD;
END IF;

END;

$$;


ALTER FUNCTION tienda.audi_suministro_func() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: audi_producto; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.audi_producto (
    consecutivo integer NOT NULL,
    id_producto character varying(2),
    nombre_producto character varying(30) NOT NULL,
    fecha_registro timestamp without time zone,
    usuario character varying(20),
    accion character(1)
);


ALTER TABLE tienda.audi_producto OWNER TO postgres;

--
-- Name: audi_producto_consecutivo_seq; Type: SEQUENCE; Schema: tienda; Owner: postgres
--

CREATE SEQUENCE tienda.audi_producto_consecutivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tienda.audi_producto_consecutivo_seq OWNER TO postgres;

--
-- Name: audi_producto_consecutivo_seq; Type: SEQUENCE OWNED BY; Schema: tienda; Owner: postgres
--

ALTER SEQUENCE tienda.audi_producto_consecutivo_seq OWNED BY tienda.audi_producto.consecutivo;


--
-- Name: audi_suministro; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.audi_suministro (
    consecutivo integer NOT NULL,
    id_suministro character varying(2),
    cantidad_producto integer NOT NULL,
    fecha_registro timestamp without time zone,
    usuario character varying(20),
    accion character(1)
);


ALTER TABLE tienda.audi_suministro OWNER TO postgres;

--
-- Name: audi_suministro_consecutivo_seq; Type: SEQUENCE; Schema: tienda; Owner: postgres
--

CREATE SEQUENCE tienda.audi_suministro_consecutivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tienda.audi_suministro_consecutivo_seq OWNER TO postgres;

--
-- Name: audi_suministro_consecutivo_seq; Type: SEQUENCE OWNED BY; Schema: tienda; Owner: postgres
--

ALTER SEQUENCE tienda.audi_suministro_consecutivo_seq OWNED BY tienda.audi_suministro.consecutivo;


--
-- Name: categoria; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.categoria (
    id_categoria character varying(2) NOT NULL,
    nombre_categoria character varying(30),
    CONSTRAINT nn_nombre CHECK ((nombre_categoria IS NOT NULL))
);


ALTER TABLE tienda.categoria OWNER TO postgres;

--
-- Name: detalle_entrada; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.detalle_entrada (
    ordinal_entrada character varying(2) NOT NULL,
    id_producto character varying(2),
    cantidad integer,
    precio integer,
    consecutivo_entrada integer NOT NULL,
    CONSTRAINT ck_cantidad CHECK ((cantidad IS NOT NULL))
);


ALTER TABLE tienda.detalle_entrada OWNER TO postgres;

--
-- Name: detalle_salida; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.detalle_salida (
    ordinal_salida character varying(2) NOT NULL,
    id_producto character varying(2),
    cantidad integer,
    precio integer,
    consecutivo_salida integer NOT NULL,
    CONSTRAINT ck_cantidad CHECK ((cantidad IS NOT NULL))
);


ALTER TABLE tienda.detalle_salida OWNER TO postgres;

--
-- Name: entrada; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.entrada (
    consecutivo_entrada integer NOT NULL,
    id_usuario character varying(2),
    fecha_entrada date,
    CONSTRAINT nn_fecha_entrada CHECK ((fecha_entrada IS NOT NULL))
);


ALTER TABLE tienda.entrada OWNER TO postgres;

--
-- Name: entrada_consecutivo_entrada_seq; Type: SEQUENCE; Schema: tienda; Owner: postgres
--

CREATE SEQUENCE tienda.entrada_consecutivo_entrada_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tienda.entrada_consecutivo_entrada_seq OWNER TO postgres;

--
-- Name: entrada_consecutivo_entrada_seq; Type: SEQUENCE OWNED BY; Schema: tienda; Owner: postgres
--

ALTER SEQUENCE tienda.entrada_consecutivo_entrada_seq OWNED BY tienda.entrada.consecutivo_entrada;


--
-- Name: marca; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.marca (
    id_marca character varying(2) NOT NULL,
    nombre_marca character varying(30),
    CONSTRAINT nn_nombre CHECK ((nombre_marca IS NOT NULL))
);


ALTER TABLE tienda.marca OWNER TO postgres;

--
-- Name: producto; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.producto (
    id_producto character varying(2) NOT NULL,
    id_marca character varying(2),
    id_categoria character varying(2),
    nombre_producto character varying(30),
    stock integer,
    precio_unitario integer,
    descripcion_producto character varying(100),
    CONSTRAINT ck_precio_unitario CHECK ((precio_unitario > 0)),
    CONSTRAINT nn_nombre CHECK ((nombre_producto IS NOT NULL))
);


ALTER TABLE tienda.producto OWNER TO postgres;

--
-- Name: proveedor; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.proveedor (
    id_proveedor character varying(2) NOT NULL,
    nombre_proveedor character varying(30),
    direccion character varying(50),
    telefono character varying(20),
    CONSTRAINT nn_nombre_proveedor CHECK ((nombre_proveedor IS NOT NULL)),
    CONSTRAINT nn_telefono CHECK ((telefono IS NOT NULL))
);


ALTER TABLE tienda.proveedor OWNER TO postgres;

--
-- Name: salida; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.salida (
    consecutivo_salida integer NOT NULL,
    id_usuario character varying(2),
    fecha_salida date,
    CONSTRAINT nn_fecha_salida CHECK ((fecha_salida IS NOT NULL))
);


ALTER TABLE tienda.salida OWNER TO postgres;

--
-- Name: salida_consecutivo_salida_seq; Type: SEQUENCE; Schema: tienda; Owner: postgres
--

CREATE SEQUENCE tienda.salida_consecutivo_salida_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tienda.salida_consecutivo_salida_seq OWNER TO postgres;

--
-- Name: salida_consecutivo_salida_seq; Type: SEQUENCE OWNED BY; Schema: tienda; Owner: postgres
--

ALTER SEQUENCE tienda.salida_consecutivo_salida_seq OWNED BY tienda.salida.consecutivo_salida;


--
-- Name: suministro; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.suministro (
    id_suministro character varying(2) NOT NULL,
    id_producto character varying(2),
    id_proveedor character varying(2),
    cantidad_producto integer,
    fecha date,
    CONSTRAINT nn_fecha CHECK ((fecha IS NOT NULL))
);


ALTER TABLE tienda.suministro OWNER TO postgres;

--
-- Name: usuario; Type: TABLE; Schema: tienda; Owner: postgres
--

CREATE TABLE tienda.usuario (
    id_usuario character varying(2) NOT NULL,
    usuario character varying(30),
    contrasena character varying(30),
    CONSTRAINT nn_contrasena CHECK ((contrasena IS NOT NULL)),
    CONSTRAINT nn_usuario CHECK ((usuario IS NOT NULL))
);


ALTER TABLE tienda.usuario OWNER TO postgres;

--
-- Name: audi_producto consecutivo; Type: DEFAULT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.audi_producto ALTER COLUMN consecutivo SET DEFAULT nextval('tienda.audi_producto_consecutivo_seq'::regclass);


--
-- Name: audi_suministro consecutivo; Type: DEFAULT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.audi_suministro ALTER COLUMN consecutivo SET DEFAULT nextval('tienda.audi_suministro_consecutivo_seq'::regclass);


--
-- Name: entrada consecutivo_entrada; Type: DEFAULT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.entrada ALTER COLUMN consecutivo_entrada SET DEFAULT nextval('tienda.entrada_consecutivo_entrada_seq'::regclass);


--
-- Name: salida consecutivo_salida; Type: DEFAULT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.salida ALTER COLUMN consecutivo_salida SET DEFAULT nextval('tienda.salida_consecutivo_salida_seq'::regclass);


--
-- Data for Name: audi_producto; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.audi_producto (consecutivo, id_producto, nombre_producto, fecha_registro, usuario, accion) FROM stdin;
\.
COPY tienda.audi_producto (consecutivo, id_producto, nombre_producto, fecha_registro, usuario, accion) FROM '$$PATH$$/3473.dat';

--
-- Data for Name: audi_suministro; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.audi_suministro (consecutivo, id_suministro, cantidad_producto, fecha_registro, usuario, accion) FROM stdin;
\.
COPY tienda.audi_suministro (consecutivo, id_suministro, cantidad_producto, fecha_registro, usuario, accion) FROM '$$PATH$$/3477.dat';

--
-- Data for Name: categoria; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.categoria (id_categoria, nombre_categoria) FROM stdin;
\.
COPY tienda.categoria (id_categoria, nombre_categoria) FROM '$$PATH$$/3468.dat';

--
-- Data for Name: detalle_entrada; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.detalle_entrada (ordinal_entrada, id_producto, cantidad, precio, consecutivo_entrada) FROM stdin;
\.
COPY tienda.detalle_entrada (ordinal_entrada, id_producto, cantidad, precio, consecutivo_entrada) FROM '$$PATH$$/3470.dat';

--
-- Data for Name: detalle_salida; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.detalle_salida (ordinal_salida, id_producto, cantidad, precio, consecutivo_salida) FROM stdin;
\.
COPY tienda.detalle_salida (ordinal_salida, id_producto, cantidad, precio, consecutivo_salida) FROM '$$PATH$$/3471.dat';

--
-- Data for Name: entrada; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.entrada (consecutivo_entrada, id_usuario, fecha_entrada) FROM stdin;
\.
COPY tienda.entrada (consecutivo_entrada, id_usuario, fecha_entrada) FROM '$$PATH$$/3464.dat';

--
-- Data for Name: marca; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.marca (id_marca, nombre_marca) FROM stdin;
\.
COPY tienda.marca (id_marca, nombre_marca) FROM '$$PATH$$/3467.dat';

--
-- Data for Name: producto; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.producto (id_producto, id_marca, id_categoria, nombre_producto, stock, precio_unitario, descripcion_producto) FROM stdin;
\.
COPY tienda.producto (id_producto, id_marca, id_categoria, nombre_producto, stock, precio_unitario, descripcion_producto) FROM '$$PATH$$/3469.dat';

--
-- Data for Name: proveedor; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.proveedor (id_proveedor, nombre_proveedor, direccion, telefono) FROM stdin;
\.
COPY tienda.proveedor (id_proveedor, nombre_proveedor, direccion, telefono) FROM '$$PATH$$/3474.dat';

--
-- Data for Name: salida; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.salida (consecutivo_salida, id_usuario, fecha_salida) FROM stdin;
\.
COPY tienda.salida (consecutivo_salida, id_usuario, fecha_salida) FROM '$$PATH$$/3466.dat';

--
-- Data for Name: suministro; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.suministro (id_suministro, id_producto, id_proveedor, cantidad_producto, fecha) FROM stdin;
\.
COPY tienda.suministro (id_suministro, id_producto, id_proveedor, cantidad_producto, fecha) FROM '$$PATH$$/3475.dat';

--
-- Data for Name: usuario; Type: TABLE DATA; Schema: tienda; Owner: postgres
--

COPY tienda.usuario (id_usuario, usuario, contrasena) FROM stdin;
\.
COPY tienda.usuario (id_usuario, usuario, contrasena) FROM '$$PATH$$/3462.dat';

--
-- Name: audi_producto_consecutivo_seq; Type: SEQUENCE SET; Schema: tienda; Owner: postgres
--

SELECT pg_catalog.setval('tienda.audi_producto_consecutivo_seq', 65, true);


--
-- Name: audi_suministro_consecutivo_seq; Type: SEQUENCE SET; Schema: tienda; Owner: postgres
--

SELECT pg_catalog.setval('tienda.audi_suministro_consecutivo_seq', 34, true);


--
-- Name: entrada_consecutivo_entrada_seq; Type: SEQUENCE SET; Schema: tienda; Owner: postgres
--

SELECT pg_catalog.setval('tienda.entrada_consecutivo_entrada_seq', 54, true);


--
-- Name: salida_consecutivo_salida_seq; Type: SEQUENCE SET; Schema: tienda; Owner: postgres
--

SELECT pg_catalog.setval('tienda.salida_consecutivo_salida_seq', 44, true);


--
-- Name: audi_producto pk_audi_producto; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.audi_producto
    ADD CONSTRAINT pk_audi_producto PRIMARY KEY (consecutivo);


--
-- Name: audi_suministro pk_audi_suministro; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.audi_suministro
    ADD CONSTRAINT pk_audi_suministro PRIMARY KEY (consecutivo);


--
-- Name: categoria pk_categoria; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.categoria
    ADD CONSTRAINT pk_categoria PRIMARY KEY (id_categoria);


--
-- Name: detalle_entrada pk_detalle_entrada; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.detalle_entrada
    ADD CONSTRAINT pk_detalle_entrada PRIMARY KEY (ordinal_entrada, consecutivo_entrada);


--
-- Name: detalle_salida pk_detalle_salida; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.detalle_salida
    ADD CONSTRAINT pk_detalle_salida PRIMARY KEY (ordinal_salida, consecutivo_salida);


--
-- Name: entrada pk_entrada; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.entrada
    ADD CONSTRAINT pk_entrada PRIMARY KEY (consecutivo_entrada);


--
-- Name: marca pk_marca; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.marca
    ADD CONSTRAINT pk_marca PRIMARY KEY (id_marca);


--
-- Name: producto pk_producto; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT pk_producto PRIMARY KEY (id_producto);


--
-- Name: proveedor pk_proveedor; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.proveedor
    ADD CONSTRAINT pk_proveedor PRIMARY KEY (id_proveedor);


--
-- Name: salida pk_salida; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.salida
    ADD CONSTRAINT pk_salida PRIMARY KEY (consecutivo_salida);


--
-- Name: suministro pk_suministro; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.suministro
    ADD CONSTRAINT pk_suministro PRIMARY KEY (id_suministro);


--
-- Name: usuario pk_usuario; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id_usuario);


--
-- Name: marca uc_nombre; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.marca
    ADD CONSTRAINT uc_nombre UNIQUE (nombre_marca);


--
-- Name: categoria uc_nombre_categoria; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.categoria
    ADD CONSTRAINT uc_nombre_categoria UNIQUE (nombre_categoria);


--
-- Name: producto uc_producto; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT uc_producto UNIQUE (nombre_producto);


--
-- Name: usuario uc_usuario; Type: CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.usuario
    ADD CONSTRAINT uc_usuario UNIQUE (usuario);


--
-- Name: producto trg_grabar_audi_producto; Type: TRIGGER; Schema: tienda; Owner: postgres
--

CREATE TRIGGER trg_grabar_audi_producto BEFORE DELETE OR UPDATE ON tienda.producto FOR EACH ROW EXECUTE FUNCTION tienda.audi_producto_func();


--
-- Name: suministro trg_grabar_audi_suministro; Type: TRIGGER; Schema: tienda; Owner: postgres
--

CREATE TRIGGER trg_grabar_audi_suministro BEFORE DELETE OR UPDATE ON tienda.suministro FOR EACH ROW EXECUTE FUNCTION tienda.audi_suministro_func();


--
-- Name: producto fk_categoria_producto; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT fk_categoria_producto FOREIGN KEY (id_categoria) REFERENCES tienda.categoria(id_categoria);


--
-- Name: detalle_entrada fk_entrada_detalle; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.detalle_entrada
    ADD CONSTRAINT fk_entrada_detalle FOREIGN KEY (consecutivo_entrada) REFERENCES tienda.entrada(consecutivo_entrada);


--
-- Name: producto fk_marca_producto; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.producto
    ADD CONSTRAINT fk_marca_producto FOREIGN KEY (id_marca) REFERENCES tienda.marca(id_marca);


--
-- Name: detalle_entrada fk_producto_detalle; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.detalle_entrada
    ADD CONSTRAINT fk_producto_detalle FOREIGN KEY (id_producto) REFERENCES tienda.producto(id_producto);


--
-- Name: detalle_salida fk_producto_detalle; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.detalle_salida
    ADD CONSTRAINT fk_producto_detalle FOREIGN KEY (id_producto) REFERENCES tienda.producto(id_producto);


--
-- Name: suministro fk_producto_suministro; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.suministro
    ADD CONSTRAINT fk_producto_suministro FOREIGN KEY (id_producto) REFERENCES tienda.producto(id_producto);


--
-- Name: suministro fk_proveedor_suministro; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.suministro
    ADD CONSTRAINT fk_proveedor_suministro FOREIGN KEY (id_proveedor) REFERENCES tienda.proveedor(id_proveedor);


--
-- Name: detalle_salida fk_salida_detalle; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.detalle_salida
    ADD CONSTRAINT fk_salida_detalle FOREIGN KEY (consecutivo_salida) REFERENCES tienda.salida(consecutivo_salida);


--
-- Name: entrada fk_usuario_entrada; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.entrada
    ADD CONSTRAINT fk_usuario_entrada FOREIGN KEY (id_usuario) REFERENCES tienda.usuario(id_usuario);


--
-- Name: salida fk_usuario_salida; Type: FK CONSTRAINT; Schema: tienda; Owner: postgres
--

ALTER TABLE ONLY tienda.salida
    ADD CONSTRAINT fk_usuario_salida FOREIGN KEY (id_usuario) REFERENCES tienda.usuario(id_usuario);


--
-- Name: SCHEMA tienda; Type: ACL; Schema: -; Owner: postgres
--

GRANT USAGE ON SCHEMA tienda TO usuarios_tienda;


--
-- Name: TABLE entrada; Type: ACL; Schema: tienda; Owner: postgres
--

GRANT SELECT ON TABLE tienda.entrada TO usuarios_tienda;


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          