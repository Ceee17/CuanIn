PGDMP  6                    |            cuanin    16.1    16.1 z    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    49485    cuanin    DATABASE     �   CREATE DATABASE cuanin WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Indonesian_Indonesia.1252';
    DROP DATABASE cuanin;
                postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false            �           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    4            �            1259    62332    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false    4            �            1259    62331    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    4    221            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    220            �            1259    62405    member    TABLE     <  CREATE TABLE public.member (
    member_id integer NOT NULL,
    member_code character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    address text,
    phone_number character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.member;
       public         heap    postgres    false    4            �            1259    62404    member_member_id_seq    SEQUENCE     �   CREATE SEQUENCE public.member_member_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.member_member_id_seq;
       public          postgres    false    233    4            �           0    0    member_member_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.member_member_id_seq OWNED BY public.member.member_id;
          public          postgres    false    232            �            1259    62306 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false    4            �            1259    62305    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216    4            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    62324    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false    4            �            1259    62344    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false    4            �            1259    62343    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    223    4            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    222            �            1259    62356    product_category    TABLE     �   CREATE TABLE public.product_category (
    category_id integer NOT NULL,
    category_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.product_category;
       public         heap    postgres    false    4            �            1259    62355     product_category_category_id_seq    SEQUENCE     �   CREATE SEQUENCE public.product_category_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.product_category_category_id_seq;
       public          postgres    false    4    225            �           0    0     product_category_category_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.product_category_category_id_seq OWNED BY public.product_category.category_id;
          public          postgres    false    224            �            1259    62363    products    TABLE     �  CREATE TABLE public.products (
    product_id integer NOT NULL,
    category_id integer NOT NULL,
    product_code character varying(255) NOT NULL,
    product_name character varying(255) NOT NULL,
    product_brand character varying(255),
    buying_price integer NOT NULL,
    selling_price integer NOT NULL,
    discount integer DEFAULT 0 NOT NULL,
    stock integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.products;
       public         heap    postgres    false    4            �            1259    62362    products_product_id_seq    SEQUENCE     �   CREATE SEQUENCE public.products_product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.products_product_id_seq;
       public          postgres    false    227    4            �           0    0    products_product_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.products_product_id_seq OWNED BY public.products.product_id;
          public          postgres    false    226            �            1259    62423 	   purchases    TABLE     e  CREATE TABLE public.purchases (
    purchase_id integer NOT NULL,
    supplier_id integer NOT NULL,
    total_item integer NOT NULL,
    total_price integer NOT NULL,
    discount smallint DEFAULT '0'::smallint NOT NULL,
    payment integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.purchases;
       public         heap    postgres    false    4            �            1259    62432    purchases_detail    TABLE     S  CREATE TABLE public.purchases_detail (
    purchases_detail_id integer NOT NULL,
    purchase_id integer NOT NULL,
    product_id integer NOT NULL,
    buying_price integer NOT NULL,
    jumlah integer NOT NULL,
    subtotal integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.purchases_detail;
       public         heap    postgres    false    4            �            1259    62431 (   purchases_detail_purchases_detail_id_seq    SEQUENCE     �   CREATE SEQUENCE public.purchases_detail_purchases_detail_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ?   DROP SEQUENCE public.purchases_detail_purchases_detail_id_seq;
       public          postgres    false    4    239            �           0    0 (   purchases_detail_purchases_detail_id_seq    SEQUENCE OWNED BY     u   ALTER SEQUENCE public.purchases_detail_purchases_detail_id_seq OWNED BY public.purchases_detail.purchases_detail_id;
          public          postgres    false    238            �            1259    62422    purchases_purchase_id_seq    SEQUENCE     �   CREATE SEQUENCE public.purchases_purchase_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.purchases_purchase_id_seq;
       public          postgres    false    4    237            �           0    0    purchases_purchase_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.purchases_purchase_id_seq OWNED BY public.purchases.purchase_id;
          public          postgres    false    236            �            1259    62391    reports    TABLE     �   CREATE TABLE public.reports (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    type character varying(255) NOT NULL,
    data json NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.reports;
       public         heap    postgres    false    4            �            1259    62390    reports_id_seq    SEQUENCE     w   CREATE SEQUENCE public.reports_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.reports_id_seq;
       public          postgres    false    4    231            �           0    0    reports_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.reports_id_seq OWNED BY public.reports.id;
          public          postgres    false    230            �            1259    62447    sales    TABLE     �  CREATE TABLE public.sales (
    sales_id integer NOT NULL,
    member_id integer,
    total_item integer NOT NULL,
    total_price numeric(10,2) NOT NULL,
    discount smallint DEFAULT '0'::smallint NOT NULL,
    payment numeric(10,2) DEFAULT '0'::numeric NOT NULL,
    received integer DEFAULT 0 NOT NULL,
    user_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.sales;
       public         heap    postgres    false    4            �            1259    62439    sales_detail    TABLE     �  CREATE TABLE public.sales_detail (
    sales_detail_id integer NOT NULL,
    sales_id integer NOT NULL,
    product_id integer NOT NULL,
    selling_price integer NOT NULL,
    amount integer NOT NULL,
    discount smallint DEFAULT '0'::smallint NOT NULL,
    subtotal numeric(10,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.sales_detail;
       public         heap    postgres    false    4            �            1259    62438     sales_detail_sales_detail_id_seq    SEQUENCE     �   CREATE SEQUENCE public.sales_detail_sales_detail_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.sales_detail_sales_detail_id_seq;
       public          postgres    false    4    241            �           0    0     sales_detail_sales_detail_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.sales_detail_sales_detail_id_seq OWNED BY public.sales_detail.sales_detail_id;
          public          postgres    false    240            �            1259    62446    sales_sales_id_seq    SEQUENCE     �   CREATE SEQUENCE public.sales_sales_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.sales_sales_id_seq;
       public          postgres    false    243    4            �           0    0    sales_sales_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.sales_sales_id_seq OWNED BY public.sales.sales_id;
          public          postgres    false    242            �            1259    62457    setting    TABLE     �  CREATE TABLE public.setting (
    setting_id integer NOT NULL,
    company_name character varying(255) NOT NULL,
    address text,
    phone_number character varying(255) NOT NULL,
    note_type smallint NOT NULL,
    discount smallint DEFAULT '0'::smallint NOT NULL,
    logo_path character varying(255) NOT NULL,
    card_member_path character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.setting;
       public         heap    postgres    false    4            �            1259    62456    setting_setting_id_seq    SEQUENCE     �   CREATE SEQUENCE public.setting_setting_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.setting_setting_id_seq;
       public          postgres    false    4    245            �           0    0    setting_setting_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.setting_setting_id_seq OWNED BY public.setting.setting_id;
          public          postgres    false    244            �            1259    62382    spending    TABLE     �   CREATE TABLE public.spending (
    spending_id integer NOT NULL,
    description text NOT NULL,
    nominal integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.spending;
       public         heap    postgres    false    4            �            1259    62381    spending_spending_id_seq    SEQUENCE     �   CREATE SEQUENCE public.spending_spending_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.spending_spending_id_seq;
       public          postgres    false    4    229            �           0    0    spending_spending_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.spending_spending_id_seq OWNED BY public.spending.spending_id;
          public          postgres    false    228            �            1259    62414    supplier    TABLE     
  CREATE TABLE public.supplier (
    supplier_id integer NOT NULL,
    name character varying(255) NOT NULL,
    address text,
    telepon character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.supplier;
       public         heap    postgres    false    4            �            1259    62413    supplier_supplier_id_seq    SEQUENCE     �   CREATE SEQUENCE public.supplier_supplier_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.supplier_supplier_id_seq;
       public          postgres    false    235    4            �           0    0    supplier_supplier_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.supplier_supplier_id_seq OWNED BY public.supplier.supplier_id;
          public          postgres    false    234            �            1259    62313    users    TABLE     �  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    photo character varying(255),
    level smallint DEFAULT '0'::smallint NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false    4            �            1259    62312    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    4    218            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    217            �           2604    62335    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    221    221            �           2604    62408    member member_id    DEFAULT     t   ALTER TABLE ONLY public.member ALTER COLUMN member_id SET DEFAULT nextval('public.member_member_id_seq'::regclass);
 ?   ALTER TABLE public.member ALTER COLUMN member_id DROP DEFAULT;
       public          postgres    false    232    233    233            �           2604    62309    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            �           2604    62347    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    223    223            �           2604    62359    product_category category_id    DEFAULT     �   ALTER TABLE ONLY public.product_category ALTER COLUMN category_id SET DEFAULT nextval('public.product_category_category_id_seq'::regclass);
 K   ALTER TABLE public.product_category ALTER COLUMN category_id DROP DEFAULT;
       public          postgres    false    224    225    225            �           2604    62366    products product_id    DEFAULT     z   ALTER TABLE ONLY public.products ALTER COLUMN product_id SET DEFAULT nextval('public.products_product_id_seq'::regclass);
 B   ALTER TABLE public.products ALTER COLUMN product_id DROP DEFAULT;
       public          postgres    false    227    226    227            �           2604    62426    purchases purchase_id    DEFAULT     ~   ALTER TABLE ONLY public.purchases ALTER COLUMN purchase_id SET DEFAULT nextval('public.purchases_purchase_id_seq'::regclass);
 D   ALTER TABLE public.purchases ALTER COLUMN purchase_id DROP DEFAULT;
       public          postgres    false    236    237    237            �           2604    62435 $   purchases_detail purchases_detail_id    DEFAULT     �   ALTER TABLE ONLY public.purchases_detail ALTER COLUMN purchases_detail_id SET DEFAULT nextval('public.purchases_detail_purchases_detail_id_seq'::regclass);
 S   ALTER TABLE public.purchases_detail ALTER COLUMN purchases_detail_id DROP DEFAULT;
       public          postgres    false    239    238    239            �           2604    62394 
   reports id    DEFAULT     h   ALTER TABLE ONLY public.reports ALTER COLUMN id SET DEFAULT nextval('public.reports_id_seq'::regclass);
 9   ALTER TABLE public.reports ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    230    231            �           2604    62450    sales sales_id    DEFAULT     p   ALTER TABLE ONLY public.sales ALTER COLUMN sales_id SET DEFAULT nextval('public.sales_sales_id_seq'::regclass);
 =   ALTER TABLE public.sales ALTER COLUMN sales_id DROP DEFAULT;
       public          postgres    false    242    243    243            �           2604    62442    sales_detail sales_detail_id    DEFAULT     �   ALTER TABLE ONLY public.sales_detail ALTER COLUMN sales_detail_id SET DEFAULT nextval('public.sales_detail_sales_detail_id_seq'::regclass);
 K   ALTER TABLE public.sales_detail ALTER COLUMN sales_detail_id DROP DEFAULT;
       public          postgres    false    240    241    241            �           2604    62460    setting setting_id    DEFAULT     x   ALTER TABLE ONLY public.setting ALTER COLUMN setting_id SET DEFAULT nextval('public.setting_setting_id_seq'::regclass);
 A   ALTER TABLE public.setting ALTER COLUMN setting_id DROP DEFAULT;
       public          postgres    false    244    245    245            �           2604    62385    spending spending_id    DEFAULT     |   ALTER TABLE ONLY public.spending ALTER COLUMN spending_id SET DEFAULT nextval('public.spending_spending_id_seq'::regclass);
 C   ALTER TABLE public.spending ALTER COLUMN spending_id DROP DEFAULT;
       public          postgres    false    228    229    229            �           2604    62417    supplier supplier_id    DEFAULT     |   ALTER TABLE ONLY public.supplier ALTER COLUMN supplier_id SET DEFAULT nextval('public.supplier_supplier_id_seq'::regclass);
 C   ALTER TABLE public.supplier ALTER COLUMN supplier_id DROP DEFAULT;
       public          postgres    false    234    235    235            �           2604    62316    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    217    218            u          0    62332    failed_jobs 
   TABLE DATA                 public          postgres    false    221   đ       �          0    62405    member 
   TABLE DATA                 public          postgres    false    233   ޑ       p          0    62306 
   migrations 
   TABLE DATA                 public          postgres    false    216   �       s          0    62324    password_reset_tokens 
   TABLE DATA                 public          postgres    false    219   ��       w          0    62344    personal_access_tokens 
   TABLE DATA                 public          postgres    false    223   ��       y          0    62356    product_category 
   TABLE DATA                 public          postgres    false    225   ��       {          0    62363    products 
   TABLE DATA                 public          postgres    false    227   G�       �          0    62423 	   purchases 
   TABLE DATA                 public          postgres    false    237   ��       �          0    62432    purchases_detail 
   TABLE DATA                 public          postgres    false    239   J�                 0    62391    reports 
   TABLE DATA                 public          postgres    false    231   /�       �          0    62447    sales 
   TABLE DATA                 public          postgres    false    243   I�       �          0    62439    sales_detail 
   TABLE DATA                 public          postgres    false    241   Ҝ       �          0    62457    setting 
   TABLE DATA                 public          postgres    false    245   ��       }          0    62382    spending 
   TABLE DATA                 public          postgres    false    229   <�       �          0    62414    supplier 
   TABLE DATA                 public          postgres    false    235   [�       r          0    62313    users 
   TABLE DATA                 public          postgres    false    218   �       �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    220            �           0    0    member_member_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.member_member_id_seq', 12, true);
          public          postgres    false    232            �           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 15, true);
          public          postgres    false    215            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    222            �           0    0     product_category_category_id_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.product_category_category_id_seq', 21, true);
          public          postgres    false    224            �           0    0    products_product_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.products_product_id_seq', 23, true);
          public          postgres    false    226            �           0    0 (   purchases_detail_purchases_detail_id_seq    SEQUENCE SET     V   SELECT pg_catalog.setval('public.purchases_detail_purchases_detail_id_seq', 4, true);
          public          postgres    false    238            �           0    0    purchases_purchase_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.purchases_purchase_id_seq', 4, true);
          public          postgres    false    236            �           0    0    reports_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.reports_id_seq', 1, false);
          public          postgres    false    230            �           0    0     sales_detail_sales_detail_id_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.sales_detail_sales_detail_id_seq', 17, true);
          public          postgres    false    240            �           0    0    sales_sales_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.sales_sales_id_seq', 22, true);
          public          postgres    false    242            �           0    0    setting_setting_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.setting_setting_id_seq', 1, false);
          public          postgres    false    244            �           0    0    spending_spending_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.spending_spending_id_seq', 6, true);
          public          postgres    false    228            �           0    0    supplier_supplier_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.supplier_supplier_id_seq', 7, true);
          public          postgres    false    234            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 4, true);
          public          postgres    false    217            �           2606    62340    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    221            �           2606    62342 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    221            �           2606    62412    member member_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.member
    ADD CONSTRAINT member_pkey PRIMARY KEY (member_id);
 <   ALTER TABLE ONLY public.member DROP CONSTRAINT member_pkey;
       public            postgres    false    233            �           2606    62311    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            �           2606    62330 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    219            �           2606    62351 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    223            �           2606    62354 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    223            �           2606    62361 &   product_category product_category_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.product_category
    ADD CONSTRAINT product_category_pkey PRIMARY KEY (category_id);
 P   ALTER TABLE ONLY public.product_category DROP CONSTRAINT product_category_pkey;
       public            postgres    false    225            �           2606    62371    products products_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (product_id);
 @   ALTER TABLE ONLY public.products DROP CONSTRAINT products_pkey;
       public            postgres    false    227            �           2606    62378 %   products products_product_code_unique 
   CONSTRAINT     h   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_product_code_unique UNIQUE (product_code);
 O   ALTER TABLE ONLY public.products DROP CONSTRAINT products_product_code_unique;
       public            postgres    false    227            �           2606    62380 %   products products_product_name_unique 
   CONSTRAINT     h   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_product_name_unique UNIQUE (product_name);
 O   ALTER TABLE ONLY public.products DROP CONSTRAINT products_product_name_unique;
       public            postgres    false    227            �           2606    62437 &   purchases_detail purchases_detail_pkey 
   CONSTRAINT     u   ALTER TABLE ONLY public.purchases_detail
    ADD CONSTRAINT purchases_detail_pkey PRIMARY KEY (purchases_detail_id);
 P   ALTER TABLE ONLY public.purchases_detail DROP CONSTRAINT purchases_detail_pkey;
       public            postgres    false    239            �           2606    62430    purchases purchases_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.purchases
    ADD CONSTRAINT purchases_pkey PRIMARY KEY (purchase_id);
 B   ALTER TABLE ONLY public.purchases DROP CONSTRAINT purchases_pkey;
       public            postgres    false    237            �           2606    62398    reports reports_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.reports DROP CONSTRAINT reports_pkey;
       public            postgres    false    231            �           2606    62445    sales_detail sales_detail_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.sales_detail
    ADD CONSTRAINT sales_detail_pkey PRIMARY KEY (sales_detail_id);
 H   ALTER TABLE ONLY public.sales_detail DROP CONSTRAINT sales_detail_pkey;
       public            postgres    false    241            �           2606    62455    sales sales_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (sales_id);
 :   ALTER TABLE ONLY public.sales DROP CONSTRAINT sales_pkey;
       public            postgres    false    243            �           2606    62465    setting setting_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.setting
    ADD CONSTRAINT setting_pkey PRIMARY KEY (setting_id);
 >   ALTER TABLE ONLY public.setting DROP CONSTRAINT setting_pkey;
       public            postgres    false    245            �           2606    62389    spending spending_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.spending
    ADD CONSTRAINT spending_pkey PRIMARY KEY (spending_id);
 @   ALTER TABLE ONLY public.spending DROP CONSTRAINT spending_pkey;
       public            postgres    false    229            �           2606    62421    supplier supplier_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.supplier
    ADD CONSTRAINT supplier_pkey PRIMARY KEY (supplier_id);
 @   ALTER TABLE ONLY public.supplier DROP CONSTRAINT supplier_pkey;
       public            postgres    false    235            �           2606    62323    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    218            �           2606    62321    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    218            �           1259    62352 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    223    223            �           2606    62372 %   products products_category_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.product_category(category_id) ON UPDATE RESTRICT ON DELETE RESTRICT;
 O   ALTER TABLE ONLY public.products DROP CONSTRAINT products_category_id_foreign;
       public          postgres    false    227    4805    225            �           2606    62399    reports reports_user_id_foreign    FK CONSTRAINT     ~   ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);
 I   ALTER TABLE ONLY public.reports DROP CONSTRAINT reports_user_id_foreign;
       public          postgres    false    218    231    4792            u   
   x���          �     x�Ւ�n�0�w��nI$�l��SDhJ@*�+2�T� ���5)X+���9G��?]GI��%y
�T�M��/� �߽h�
��:�T��J(���B_w�b�O�P���dTa���y<��-v$�Iw��S�f�u.���֣��ݷXrʹl�q=4{馆lۀm�2|Sߊ�&���9
r8����[��>+�c�+���12ތ��$�-�s�c͆��sͶL����%�xE7���
& �ɍ�fN�HKĄ��l��uˡ�8�9������x�YQ~ ʑ�I      p   n  x���Ak�0�{Enm��h��4�n���v1f��5�D����v�Zw��CHn�|a�Y=' ��TuZ��f�o%չ(�����3�R�vS�z�~Ym���9�%�!���jNjť"��� ��8�8zX���� ���0z���!�.vU�SȌH��&Z|��>	�Hq|r�;�7�<#�"�q�!���lL;����q��
�;���x�MD؇m_Rd5ӄ��V�/���fA���qp���ɢ�X�~�P/���ZW�=���F!y%� Qtx6/�����K��\!Q�G]UE>��m�J-َ*n����GƵ�m�9����ԴC�)n�bFm�b����5p��8;F�o$Bu�      s   
   x���          w   
   x���          y   x  x�ՖKo�0���
�H0Qec'`<:A;�nW����u�~	�v�m;�f��/���Q�����i�}ϕ��4eV����/����*k�OR�]����0-�U�7�m�z�m���>�QM��ǺK��n��	�A��h���~+7!�a���U4M�1�8I�Q�x�E��uHӜ�A�{>�=���a\U��DF-�;�	�#�CJ�8tH���a�<�S�"7��	
k.|����*Ȩ��wHOx�\3jv�qLs�Ke�f���{r!t���Ě�H3����rm�J2b��\�Iqrd�%��vJ"l��<+z��g4�ë�)?���XQ�^8a��a��҅&��W��F�D�B3��M�8a���%:���T��^���'��?�      {   .  x�ݗM��0�����+�
���n6٥��*i�Q(�J!"������#�*r,Q,�`$K�ޙw��t�u��x��s���ùm�>�.�NE�2�Qv�SӾ��z�5y1f�᧖�C����>��m��ᥨ*-��K��u]���[����xԟsߣ��o��a��JSG����>�ԅHŵ�B,߁���E���.r��Ӑ����P���1�%1Z%�f�v�)Aq�{��珋��"GlDFrD'��Ռ�!$�Q不z9��C�و��Nn����	B�б�耝;�	���j�tri�V�#�g=	̓%J��n�FfT��!�@��z�� �JoL���h0p�Ï�Î��t�}�ڃ��P�Ú�mNހ�nذ�ueV�g�KrX����r�̈�k�e�E��U�V�#Ju�Z���鲣����k�9װ���nc	��\�@Ȧ���dF�J[���^�B���V:���!��N �����l�qc��(W굺�䷂���8,����y�%�A�7\�<�v#���ϕ�l�$�����b�?�/gP      �   �   x�eȽ
�0 �Oq[-Di�V�N�oA��Zb0�jh�������+�a�/Q�R��sc���N]d�{~�LM�{k���p7'��8��l;�4Amzu�WG`��/�NK��J>�m�u��|w\0H	&cJ��Y�
A�,MY�Y!�Y:��C��Nr��	��4�4� 8��wŢ�R��r[��,��6D      �   �   x�͏1o�0F���oHŉM�*J[KȖ �F�mWi�{�oJa��sO�ӻ�=!��M	!K�6֍7�6v�{�W���~��[���y���&������j;o�[|o􁠏u8�����l�Al���?�w�-F#n�}�.<@�g9�d�I^��-h�`<��9K�PK%��bY�QA��E���D��lv��ÞK9%�9��������I��˒_         
   x���          �   y  x�՗Mo�@������H������S��-2RBzE�`	�G����l��I�SV�䙱|xޝ�fO�1�&c�޿,��`;[ڭ�)^�|��]��Ma�^w��4��Ui�7��Fb�o��߻H�gW�;�����o���7v�����}ޯG�V��:z~x72��h	p� ��p_��� ������Ĩ����L܏����D|�l<�9�~|�?4:2O�	LQ”��њ� I"A �.@j[H�J�� 9>I@)'΅&��z�[4�Ƞ4�<	�0�`4Pe�Krf� p��'GB�DF�.L*�j�c�.�B�еp(�����Á��V.��%�!
��qqQ���P�8F����]�G������ae$��_Mwg8f���ĝ
�F�����(�5X9�R��sMLZh�I*k S(��U���Qw�ƶW�9�eG���+�A+�
���]�� \J�Au��2�z!ԝ�U����kC͂�c���G6R�;��P�C�5�%�)�e��_������ʠtS�j�p@�0���oJ�X�u��a
h�ۅ��66�9}�I�@��B
���]�NW�*��t�o�A�:�9��ӆ�|����
�AjQ�m	�A��{��S      �     x�ݗAo�0�����J4�����vw�*��l��Bb�(���cHHL��֕p���˼y����qŒt��m����r�7�~]Vm^7�j|Zץ��춻M���VMS��YowuQ�,���^[����v��ݴy�bW�mU�sR�my�_��o������q>�t����(7�n�b\�<�zVYz�,K�]��xH�V�{��l�+I�.�����5������Ұ�	�f b���d��=8�f�k�A��AG��������m�B +�0���$��-ti<��wC��K��)9
��b �&s���N/u$�� Գ��N?��X�i����f��e@��i��d�Z=<pz}dy�`�>�W^Fn�G���倮�L����M�;�nR�˳��w�N���(������郾�+��"o�R���HKǒ�;=)=�n�Y��k���?�{�Hc��;7��~�>Qw�`�ҫKx��Xԛ��7\�����M��?p�O2:6�r��t�5�4�����wl�1Q����G������^�/� M��      �   0  x�M�Oo�@��~���	*�֞UˆBU�S/d�-BaY�%��]��2y��7����]���k��cA��X
����D��*9am�HI5 IRS!4්ш5���J�H�\I&�aR��J��yS!�N��v�SS"i6<y�!��a����A�isY_)L
� ��X�,}n��̴���Zn*�{)&��]W�M��ũ�߬)b����r*�]��iC[9�y�E�k'&�3��|t����e_�jj�`����5��uWu���?x��@:��tk��`�d,��B���k�uBx	��W��<�z�_�y�      }     x�Ւ�N�0E���٥�\��y�YA	)8Rc�Vnb�jkGq���q�R!A�!�Y]������fr�Kh��J�'���Q�	F�i���u��^�@���b����e3=��mvy�}V�(D�s)�P�~��]�0��d$�SJN��JӒ]���U	��9�9��?f'��2����$T�b�á�ǣmN�	m[������VZ��C�.�x0�ڼ������1�"�����9${�;��Y��'}�R����u����} U@      �   �  x���]O�@�����NM`3�@٫nmӅ�e�^�Q&J��#��ށ�5��Ƙ0��	s�>�ś�:E�	����~4]U��q|����vځʲZ7��V�*���Z�Vg7�u�Uٸ?��l�g��1sp�9�L��=K��[�{kU6��{�����0%���52\ߓ��l83K<�z ~(yȃ��'Hb̓x���)N�Iz�g?'��W�Z�>��_u���zr�=�����Ab)�;.����xYvu�Rư(vÌ�ˮi�V�|�
!�q�o��6Ӆ����Iey�r[`�w��U��H@Y`?�쥂q

�Q�+q�ʹ̍�V��0H��v��]��_�����X��寤�6S���4�\��qVZ���07�?��QP?�v@oqc��7�<�;��      r   N  x�ՔMS�@����9X�Bd��-�H�H&�X$���3@$�~Id�,]��螦筞����O��Xx怢Z�����!�AF8@� N��&4~�I��(�v9m3�(/s��&m*%�V�>��3�r`MIPvo�"��s�_��p
� z%ae�;��k�)��yvА���|e (�$�z�OQs
ѩz�7�Y���B{�G�ۚ����JKw�YQ���R�	�ę�.=�=�f��D�t��+VND��CJ7wk����y��^7l<���}�8�=����;*:Ru{����p��m30p nmX��ǉ�-&�6��,��~fе�!gJ)�I�N�:����m�ᛁ����SO�|���hjz���p��U�D��.i:��=A��m,�	������W��1u'���]?�ǫ�T�|N��I��5A������7&�û՝�sw������vK_�8�,Cjh�]�]&�9
�|RVW�� ʺ���� +������7&)ˏ��=FW�?BwE��I�	Y�h���֍QѪ���:�gTU�C�V�G�D*�Fx9Ծl��]���3xC5]�����_=9�	c��{     