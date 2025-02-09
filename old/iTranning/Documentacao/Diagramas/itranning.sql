PGDMP     	    !    
            w         	   itranning    9.6.9    9.6.9 :    �	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �	           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            �	           1262    35365 	   itranning    DATABASE     g   CREATE DATABASE itranning WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';
    DROP DATABASE itranning;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            �	           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12655    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            �	           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    35368    estado_fisico    TABLE     �   CREATE TABLE public.estado_fisico (
    idestado integer NOT NULL,
    nome_avaliacao character varying(255) NOT NULL,
    valor_avaliacao character varying(255) NOT NULL,
    idusuario integer NOT NULL
);
 !   DROP TABLE public.estado_fisico;
       public         postgres    false    3            �            1259    35366    estado_fisico_idestado_seq    SEQUENCE     �   CREATE SEQUENCE public.estado_fisico_idestado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.estado_fisico_idestado_seq;
       public       postgres    false    3    186            �	           0    0    estado_fisico_idestado_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.estado_fisico_idestado_seq OWNED BY public.estado_fisico.idestado;
            public       postgres    false    185            �            1259    35379 
   exercicios    TABLE     �   CREATE TABLE public.exercicios (
    idexercicio integer NOT NULL,
    nome character varying(255) NOT NULL,
    urlvideo character varying(255),
    instrucoes character varying(2550)
);
    DROP TABLE public.exercicios;
       public         postgres    false    3            �            1259    35377    exercicios_idexercicio_seq    SEQUENCE     �   CREATE SEQUENCE public.exercicios_idexercicio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.exercicios_idexercicio_seq;
       public       postgres    false    3    188            �	           0    0    exercicios_idexercicio_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.exercicios_idexercicio_seq OWNED BY public.exercicios.idexercicio;
            public       postgres    false    187            �            1259    35390    situacao_cadastro    TABLE     z   CREATE TABLE public.situacao_cadastro (
    idsituacao integer NOT NULL,
    descricao character varying(255) NOT NULL
);
 %   DROP TABLE public.situacao_cadastro;
       public         postgres    false    3            �            1259    35388     situacao_cadastro_idsituacao_seq    SEQUENCE     �   CREATE SEQUENCE public.situacao_cadastro_idsituacao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.situacao_cadastro_idsituacao_seq;
       public       postgres    false    3    190            �	           0    0     situacao_cadastro_idsituacao_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.situacao_cadastro_idsituacao_seq OWNED BY public.situacao_cadastro.idsituacao;
            public       postgres    false    189            �            1259    35398    tipo_usuario    TABLE     q   CREATE TABLE public.tipo_usuario (
    idtipo integer NOT NULL,
    descricao character varying(255) NOT NULL
);
     DROP TABLE public.tipo_usuario;
       public         postgres    false    3            �            1259    35396    tipo_usuario_idtipo_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_usuario_idtipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tipo_usuario_idtipo_seq;
       public       postgres    false    3    192            �	           0    0    tipo_usuario_idtipo_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tipo_usuario_idtipo_seq OWNED BY public.tipo_usuario.idtipo;
            public       postgres    false    191            �            1259    35406    treinos    TABLE     �   CREATE TABLE public.treinos (
    idtreino integer NOT NULL,
    nome character varying(255) NOT NULL,
    idusuario integer NOT NULL
);
    DROP TABLE public.treinos;
       public         postgres    false    3            �            1259    35412    treinos_exercicios    TABLE     �   CREATE TABLE public.treinos_exercicios (
    idtreino integer NOT NULL,
    idexercicio integer NOT NULL,
    qnt_repeticoes integer NOT NULL,
    repeticoes integer NOT NULL
);
 &   DROP TABLE public.treinos_exercicios;
       public         postgres    false    3            �            1259    35404    treinos_idtreino_seq    SEQUENCE     }   CREATE SEQUENCE public.treinos_idtreino_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.treinos_idtreino_seq;
       public       postgres    false    194    3            �	           0    0    treinos_idtreino_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.treinos_idtreino_seq OWNED BY public.treinos.idtreino;
            public       postgres    false    193            �            1259    35417    usuarios    TABLE       CREATE TABLE public.usuarios (
    idusuario integer NOT NULL,
    nome character varying(255) NOT NULL,
    usuario character varying(255) NOT NULL,
    senha character varying(255) NOT NULL,
    idtipo integer NOT NULL,
    idsituacao integer NOT NULL
);
    DROP TABLE public.usuarios;
       public         postgres    false    3            �            1259    35415    usuarios_idusuario_seq    SEQUENCE        CREATE SEQUENCE public.usuarios_idusuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.usuarios_idusuario_seq;
       public       postgres    false    197    3            �	           0    0    usuarios_idusuario_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.usuarios_idusuario_seq OWNED BY public.usuarios.idusuario;
            public       postgres    false    196             	           2604    35371    estado_fisico idestado    DEFAULT     �   ALTER TABLE ONLY public.estado_fisico ALTER COLUMN idestado SET DEFAULT nextval('public.estado_fisico_idestado_seq'::regclass);
 E   ALTER TABLE public.estado_fisico ALTER COLUMN idestado DROP DEFAULT;
       public       postgres    false    185    186    186            	           2604    35382    exercicios idexercicio    DEFAULT     �   ALTER TABLE ONLY public.exercicios ALTER COLUMN idexercicio SET DEFAULT nextval('public.exercicios_idexercicio_seq'::regclass);
 E   ALTER TABLE public.exercicios ALTER COLUMN idexercicio DROP DEFAULT;
       public       postgres    false    187    188    188            	           2604    35393    situacao_cadastro idsituacao    DEFAULT     �   ALTER TABLE ONLY public.situacao_cadastro ALTER COLUMN idsituacao SET DEFAULT nextval('public.situacao_cadastro_idsituacao_seq'::regclass);
 K   ALTER TABLE public.situacao_cadastro ALTER COLUMN idsituacao DROP DEFAULT;
       public       postgres    false    190    189    190            	           2604    35401    tipo_usuario idtipo    DEFAULT     z   ALTER TABLE ONLY public.tipo_usuario ALTER COLUMN idtipo SET DEFAULT nextval('public.tipo_usuario_idtipo_seq'::regclass);
 B   ALTER TABLE public.tipo_usuario ALTER COLUMN idtipo DROP DEFAULT;
       public       postgres    false    191    192    192            	           2604    35409    treinos idtreino    DEFAULT     t   ALTER TABLE ONLY public.treinos ALTER COLUMN idtreino SET DEFAULT nextval('public.treinos_idtreino_seq'::regclass);
 ?   ALTER TABLE public.treinos ALTER COLUMN idtreino DROP DEFAULT;
       public       postgres    false    193    194    194            	           2604    35420    usuarios idusuario    DEFAULT     x   ALTER TABLE ONLY public.usuarios ALTER COLUMN idusuario SET DEFAULT nextval('public.usuarios_idusuario_seq'::regclass);
 A   ALTER TABLE public.usuarios ALTER COLUMN idusuario DROP DEFAULT;
       public       postgres    false    197    196    197            �	          0    35368    estado_fisico 
   TABLE DATA               ]   COPY public.estado_fisico (idestado, nome_avaliacao, valor_avaliacao, idusuario) FROM stdin;
    public       postgres    false    186   �A       �	           0    0    estado_fisico_idestado_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.estado_fisico_idestado_seq', 3, true);
            public       postgres    false    185            �	          0    35379 
   exercicios 
   TABLE DATA               M   COPY public.exercicios (idexercicio, nome, urlvideo, instrucoes) FROM stdin;
    public       postgres    false    188   B       �	           0    0    exercicios_idexercicio_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.exercicios_idexercicio_seq', 6, true);
            public       postgres    false    187            �	          0    35390    situacao_cadastro 
   TABLE DATA               B   COPY public.situacao_cadastro (idsituacao, descricao) FROM stdin;
    public       postgres    false    190    C       �	           0    0     situacao_cadastro_idsituacao_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.situacao_cadastro_idsituacao_seq', 2, true);
            public       postgres    false    189            �	          0    35398    tipo_usuario 
   TABLE DATA               9   COPY public.tipo_usuario (idtipo, descricao) FROM stdin;
    public       postgres    false    192   0C       �	           0    0    tipo_usuario_idtipo_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.tipo_usuario_idtipo_seq', 3, true);
            public       postgres    false    191            �	          0    35406    treinos 
   TABLE DATA               <   COPY public.treinos (idtreino, nome, idusuario) FROM stdin;
    public       postgres    false    194   vC       �	          0    35412    treinos_exercicios 
   TABLE DATA               _   COPY public.treinos_exercicios (idtreino, idexercicio, qnt_repeticoes, repeticoes) FROM stdin;
    public       postgres    false    195   �C       �	           0    0    treinos_idtreino_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.treinos_idtreino_seq', 3, true);
            public       postgres    false    193            �	          0    35417    usuarios 
   TABLE DATA               W   COPY public.usuarios (idusuario, nome, usuario, senha, idtipo, idsituacao) FROM stdin;
    public       postgres    false    197   �C       �	           0    0    usuarios_idusuario_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.usuarios_idusuario_seq', 3, true);
            public       postgres    false    196            	           2606    35376    estado_fisico estado_fisico_pk 
   CONSTRAINT     b   ALTER TABLE ONLY public.estado_fisico
    ADD CONSTRAINT estado_fisico_pk PRIMARY KEY (idestado);
 H   ALTER TABLE ONLY public.estado_fisico DROP CONSTRAINT estado_fisico_pk;
       public         postgres    false    186    186            		           2606    35387    exercicios exercicios_pk 
   CONSTRAINT     _   ALTER TABLE ONLY public.exercicios
    ADD CONSTRAINT exercicios_pk PRIMARY KEY (idexercicio);
 B   ALTER TABLE ONLY public.exercicios DROP CONSTRAINT exercicios_pk;
       public         postgres    false    188    188            	           2606    35395 &   situacao_cadastro situacao_cadastro_pk 
   CONSTRAINT     l   ALTER TABLE ONLY public.situacao_cadastro
    ADD CONSTRAINT situacao_cadastro_pk PRIMARY KEY (idsituacao);
 P   ALTER TABLE ONLY public.situacao_cadastro DROP CONSTRAINT situacao_cadastro_pk;
       public         postgres    false    190    190            	           2606    35403    tipo_usuario tipo_usuario_pk 
   CONSTRAINT     ^   ALTER TABLE ONLY public.tipo_usuario
    ADD CONSTRAINT tipo_usuario_pk PRIMARY KEY (idtipo);
 F   ALTER TABLE ONLY public.tipo_usuario DROP CONSTRAINT tipo_usuario_pk;
       public         postgres    false    192    192            	           2606    35411    treinos treinos_pk 
   CONSTRAINT     V   ALTER TABLE ONLY public.treinos
    ADD CONSTRAINT treinos_pk PRIMARY KEY (idtreino);
 <   ALTER TABLE ONLY public.treinos DROP CONSTRAINT treinos_pk;
       public         postgres    false    194    194            	           2606    35425    usuarios usuarios_pk 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pk PRIMARY KEY (idusuario);
 >   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pk;
       public         postgres    false    197    197            	           2606    35426 3   treinos_exercicios exercicios_treinos_exercicios_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.treinos_exercicios
    ADD CONSTRAINT exercicios_treinos_exercicios_fk FOREIGN KEY (idexercicio) REFERENCES public.exercicios(idexercicio);
 ]   ALTER TABLE ONLY public.treinos_exercicios DROP CONSTRAINT exercicios_treinos_exercicios_fk;
       public       postgres    false    2313    195    188            	           2606    35431 &   usuarios situacao_cadastro_usuarios_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT situacao_cadastro_usuarios_fk FOREIGN KEY (idsituacao) REFERENCES public.situacao_cadastro(idsituacao);
 P   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT situacao_cadastro_usuarios_fk;
       public       postgres    false    2315    197    190            	           2606    35436 !   usuarios tipo_usuario_usuarios_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT tipo_usuario_usuarios_fk FOREIGN KEY (idtipo) REFERENCES public.tipo_usuario(idtipo);
 K   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT tipo_usuario_usuarios_fk;
       public       postgres    false    192    197    2317            	           2606    35441 0   treinos_exercicios treinos_treinos_exercicios_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.treinos_exercicios
    ADD CONSTRAINT treinos_treinos_exercicios_fk FOREIGN KEY (idtreino) REFERENCES public.treinos(idtreino);
 Z   ALTER TABLE ONLY public.treinos_exercicios DROP CONSTRAINT treinos_treinos_exercicios_fk;
       public       postgres    false    194    2319    195            	           2606    35446 '   estado_fisico usuarios_estado_fisico_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.estado_fisico
    ADD CONSTRAINT usuarios_estado_fisico_fk FOREIGN KEY (idusuario) REFERENCES public.usuarios(idusuario);
 Q   ALTER TABLE ONLY public.estado_fisico DROP CONSTRAINT usuarios_estado_fisico_fk;
       public       postgres    false    186    197    2321            	           2606    35451    treinos usuarios_treinos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.treinos
    ADD CONSTRAINT usuarios_treinos_fk FOREIGN KEY (idusuario) REFERENCES public.usuarios(idusuario);
 E   ALTER TABLE ONLY public.treinos DROP CONSTRAINT usuarios_treinos_fk;
       public       postgres    false    194    2321    197            �	   Y   x�3�(J-.>�8_���$�(31���@�B��Ӑˈ�1��(� ?7�(����T��6�35H�*0FS���WRZ��in�gQ���� n�p      �	   �   x���K�0E�e]�
&�?р��qR�B��Rܓ�pc���9y�{Y����(b )�B�C)�WL�2�z�r��r;��ez��k���
q!�˙�M��9io����n8�C��d;�98���[e<B�=�!�	?�ŲQX?E��B4�Y� �|��j���6� ZJ�I� 裻�W�P��ח�5���i�f5��      �	       x�3�t���2�t�p�	�t������ C�      �	   6   x�3�t,�I-I�2�(�OK-.�/�2�t,K��LL�/Rp;��839�+F��� [Z�      �	   ,   x�3�	r���WpqUp�s�4�2Bs
r<������� �
�      �	   )   x�3�4B.#NC(m��SÐ��02������ ��      �	   k   x�3�(�OK-.�/�,������,͌�M-�M�L�$sCS�#c�$sN#NC.cNǲĜ�Ĕ�"��k�3��9a"��0a��S��&	j1j����� ��1w     